
<?php 
Class TiempoController{
    private  $masterModel;
    private $doizer;
    function TiempoController($masterModel,$doizer){
        $this->masterModel = $masterModel;
        $this->doizer = $doizer;
    }
    function tiempoTranscurridoFechas($fechaInicio,$fechaFin){
        $fechaInicio = new DateTime($fechaInicio);
        $fechaFin = new DateTime($fechaFin);
        $fecha = $fechaInicio->diff($fechaFin);
        $tiempo = "";
        //Dias
        if($fecha->d > 0){
            $fecha->h = $fecha->h+(24*$fecha->d);
        }
        //horas
        if($fecha->h > 0) {
            $tiempo .= str_pad($fecha->h,2, "0", STR_PAD_LEFT).":";
        }else{
            $tiempo .="00:";
        }
        //minutos
        if($fecha->i > 0){
            $tiempo .= str_pad($fecha->i,2, "0", STR_PAD_LEFT).":";
        }else{
            $tiempo .="00:";
        }
        //segundos
        if($fecha->i == 0) {
        $tiempo .= str_pad($fecha->s,2, "0", STR_PAD_LEFT);
        }else{
            $tiempo .="00";
        }
        // echo json_encode($tiempo);
        return $tiempo;
    }

    function restarTiempoParcial($fecha_hora_inicio = null,$fecha_hora_fin = null,$fecha_hora_tiempo_transcurrido= null){
        if(isset($_POST["fecha_hora_inicio"])){
            $fecha_hora_inicio= $_POST["fecha_hora_inicio"];
            $fecha_hora_fin= $_POST["fecha_hora_fin"];
            $fecha_hora_tiempo_transcurrido= $_POST["fecha_hora_tiempo_transcurrido"];
        } 
        $explode = false;
        $explodeFecha = explode(" ",$fecha_hora_tiempo_transcurrido);
        $explodeHora = explode(":",$explodeFecha[1]);
        if($explodeHora[0]>24){
            $explode = true;
            $nuevaHora= $explodeHora[0]-$explodeHora[0];
            $fecha_hora_tiempo_transcurrido = $explodeFecha[0]." ".$nuevaHora.":".$explodeHora[1].":".$explodeHora[2];
        }
        $horaInicioInterval  = new DateTime($fecha_hora_inicio);
        $horaTerminoInterval = new DateTime($fecha_hora_fin);
        $interval = $horaInicioInterval->diff($horaTerminoInterval);
        $timpoReal = new DateTime($fecha_hora_tiempo_transcurrido); 
        if($explode){
            $timpoReal->modify('+'.$explodeHora[0].' hours'); 
        }
        $timpoReal->modify('-'.$interval->h.' hours'); 
        $timpoReal->modify('-'.$interval->i.' minute' ); 
        $timpoReal->modify('-'.$interval->s.' second'); 
        // echo json_encode($timpoReal->format('H:i:s'));
        return $timpoReal->format('H:i:s');
        
    }

    function timeToMoney($id_reserva,$tiempoTrancurrido,$products){
        $datosReserva = $this->masterModel->sqlSelect("SELECT * FROM reserva_activa ra INNER JOIN habitacion  h ON ra.hab_numero = h.hab_numero INNER JOIN tipo_habitacion th ON h.id_tipo_habitacion = th.id_tipo_habitacion WHERE id_reserva = ?",array($id_reserva))[0];
        $minutosDeCortesia = intval($this->masterModel->selectAll("villa_config")[0]->conf_minutos_cortesia);
        $minutosContarHora = intval($this->masterModel->selectAll("villa_config")[0]->minutos_contar_hora);
        $precioDecoracionDB = 0;
        // $precioDecoracionDB = intval($this->masterModel->selectAll("villa_config")[0]->conf_precio_decoracion);
        $precioPerosnaAdicionalDB = intval($datosReserva->th_valor_persona_adicional);
        $notificarCortesia = false;
        $notificarPromocion = false;
        $total = 0;
        $totalProductos = 0;
        $precioDecoracionFactura = 0;
        $totalTiempo =0;
        $personaAdicional =0;
        //habitacion decorada 
        if($datosReserva->ra_habitacion_decorada==1){
            $total +=  $precioDecoracionDB;
            $precioDecoracionFactura = $precioDecoracionDB;
        }
        //persona Adicional  
        if($datosReserva->ra_numero_personas_adicionales>0){
            $total +=  $precioPerosnaAdicionalDB*intval($datosReserva->ra_numero_personas_adicionales);
            $personaAdicional = $precioPerosnaAdicionalDB*intval($datosReserva->ra_numero_personas_adicionales);
        }
        foreach($products as $product){
            $totalProductos += $product->re_det_cantidad*$product->re_det_valor_unidad;
        }
        $total += $totalProductos;
        //si es promocion
        if(isset($datosReserva->promo_id)){
            $infoPromocion = $this->masterModel->selectAllBy("promocion",array("id_promocion",$datosReserva->promo_id))[0];
            $explodePromo = explode(":",$infoPromocion->promo_tiempo);
            $supera = false;
            $valorPromocion = 0;
            $explodeHora = explode(":",$tiempoTrancurrido);
            $valorHora = intval($datosReserva->th_valor_hora_despues24);
            // if(){
            if(intval($explodeHora[0])==(intval($explodePromo[0])-1) && intval($explodeHora[1])>40 && intval($explodePromo[1])==0 || (intval($explodeHora[0])==intval($explodePromo[0]) && intval($explodeHora[1])>(intval($explodePromo[1])+20) )){
                $notificarPromocion = true;
            }
            //
            if(intval($explodeHora[0])>0 || intval($explodeHora[1])>=$minutosDeCortesia){
                $total += $infoPromocion->promo_valor;
                $valorPromocion = $infoPromocion->promo_valor;
            }
            if(intval($explodeHora[0])>intval($explodePromo[0]) && intval($explodeHora[1])>intval($explodePromo[1]) && intval($explodeHora[1])>$minutosContarHora ){
                $diferenciaHoras = intval($explodeHora[0])-intval($explodePromo[0]) ;
                $total += $valorHora*$diferenciaHoras;
            }
            $result =array("valorHora"=>$valorHora,"decoracion"=>$precioDecoracionFactura,"total"=>$total,"tiempoTranscurrido"=>$tiempoTrancurrido,"totalTiempo"=>$valorPromocion,"productos"=>$totalProductos,"notificarPromocion"=>$notificarPromocion);
        }else{
            $totalHorasCobrar = 0;
            $valorHora = intval($datosReserva->th_valor_hora_despues24);
            $hms = explode(":",$tiempoTrancurrido);
            $hmsInt=array();
            foreach($hms as $item){
                $hmsInt[] = intval($item);
            }
            //valor horas
            if($hmsInt[0]>0){
                // $total += $valorHora*$hmsInt[0];
                // $totalTiempo += $valorHora*$hmsInt[0];
                $totalHorasCobrar+=$hmsInt[0];
            }
            //valor minutos  de cortesia para la primera hora y el  tiempo  de cortesia despues de la hora
            if($hmsInt[0]<1 && $hmsInt[1]>$minutosDeCortesia || $hmsInt[1]>$minutosContarHora){
                // $total += $valorHora;
                // $totalTiempo += $valorHora;
                $totalHorasCobrar+=1;
            }
            //Notificar fin de cortesia 
            if($datosReserva->ra_tipo_cortesia!=null){
                if($hmsInt[0]==0 && $hmsInt[1]>45 || $hmsInt[0]==1 && $hmsInt[1]>45 ){
                    $notificarCortesia = true;
                }
            }

            //validar si existe una cortesia
            if($datosReserva->ra_tipo_cortesia!=null){
                $totalHorasCobrar = $totalHorasCobrar-$datosReserva->ra_tipo_cortesia;
            }
            switch ($totalHorasCobrar) {
                case 1:
                    $totalTiempo += intval($datosReserva->th_valor_hora1);
                    break;
                case 2:
                    $totalTiempo += intval($datosReserva->th_valor_hora2);
                    break;
                case 3:
                    $totalTiempo += intval($datosReserva->th_valor_hora3);
                    break;
                case 4:
                    $totalTiempo += intval($datosReserva->th_valor_hora4);
                    break;
                case 5:
                    $totalTiempo += intval($datosReserva->th_valor_hora5);
                    break;
                case 6:
                    $totalTiempo += intval($datosReserva->th_valor_hora6);
                    break;
                case 7:
                    $totalTiempo += intval($datosReserva->th_valor_hora7);
                    break;
                case 8:
                    $totalTiempo += intval($datosReserva->th_valor_hora8);
                    break;
                case 9:
                    $totalTiempo += intval($datosReserva->th_valor_hora9);
                    break;
                case 10:
                    $totalTiempo += intval($datosReserva->th_valor_hora10);
                    break;
                case 11:
                    $totalTiempo += intval($datosReserva->th_valor_hora11);
                    break;
                case 12:
                    $totalTiempo += intval($datosReserva->th_valor_hora12);
                    break;
                case 13:
                    $totalTiempo += intval($datosReserva->th_valor_hora13);
                    break;
                case 14:
                    $totalTiempo += intval($datosReserva->th_valor_hora14);
                    break;
                case 15:
                    $totalTiempo += intval($datosReserva->th_valor_hora15);
                    break;
                case 16:
                    $totalTiempo += intval($datosReserva->th_valor_hora16);
                    break;
                case 17:
                    $totalTiempo += intval($datosReserva->th_valor_hora17);
                    break;
                case 18:
                    $totalTiempo += intval($datosReserva->th_valor_hora18);
                    break;
                case 19:
                    $totalTiempo += intval($datosReserva->th_valor_hora19);
                    break;
                case 20:
                    $totalTiempo += intval($datosReserva->th_valor_hora20);
                    break;
                case 21:
                    $totalTiempo += intval($datosReserva->th_valor_hora21);
                    break;
                case 22:
                    $totalTiempo += intval($datosReserva->th_valor_hora22);
                    break;
                case 23:
                    $totalTiempo += intval($datosReserva->th_valor_hora23);
                    break;
                case 24:
                    $totalTiempo += intval($datosReserva->th_valor_hora24);
                    break;
            }
            $total+=$totalTiempo; 
            //si supera las 24 horas
            if($totalHorasCobrar>24){
                $totalTiempo += intval($datosReserva->th_valor_hora24);
                $totalTiempo += $valorHora*($totalHorasCobrar-24);
            }
            $result =array("valorHora"=>$valorHora,"decoracion"=>$precioDecoracionFactura,"totalTiempo"=>$totalTiempo,"total"=>$total,"tiempoTranscurrido"=>$tiempoTrancurrido,"productos"=>$totalProductos,"horasCobrar"=> $totalHorasCobrar,"valorPersonaAdicional"=>$personaAdicional,"notificarCortesia"=>$notificarCortesia);
        }   
        return $result;
    }
}


?>