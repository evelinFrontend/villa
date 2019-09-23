
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
        $precioDecoracionDB = intval($this->masterModel->selectAll("villa_config")[0]->conf_precio_decoracion);
        $total = 0;
        $totalProductos = 0;
        $precioDecoracionFactura = 0;
        $totalTiempo =0;
        //habitacion decorada 
        if($datosReserva->ra_habitacion_decorada==1){
            $total +=  $precioDecoracionDB;
            $precioDecoracionFactura = $precioDecoracionDB;
        }
        foreach($products as $product){
            $totalProductos += $product->re_det_cantidad*$product->re_det_valor_unidad;
        }
        $total += $totalProductos;
        //si es promocion
        if(isset($datosReserva->promo_id)){
            $infoPromocion = $this->masterModel->selectAllBy("promocion",array("id_promocion",$datosReserva->promo_id))[0];
            $explode = explode(":",$infoPromocion->promo_tiempo);
            $supera = false;
            $valorPromocion = 0;
            $explodeHora = explode(":",$tiempoTrancurrido);
            //
            if(intval($explodeHora[0])>0 || intval($explodeHora[1])>0){
                $total += $infoPromocion->promo_valor;
                $valorPromocion = $infoPromocion->promo_valor;
            }
            //saber si supera las 24 horas para poder formatearla en Datetime
            if($explodeHora[0]>24){
                $supera = true;
                $nuevaHora= $explodeHora[0]-$explodeHora[0];
                $tiempoTrancurrido = $nuevaHora.":".$explodeHora[1].":".$explodeHora[2];
            }
            $timpoRealTranscurrido = new DateTime(date("Y-m-d")." ".$tiempoTrancurrido); 
            //si supera las 24 horas restaurar el  tiempo transcurrido
            if($supera){
                $timpoRealTranscurrido->modify('+'.$explodeHora[0].' hours'); 
            }
            $timpoRealTranscurrido->modify('-'.$explode[0].' hours'); 
            $timpoRealTranscurrido->modify('-'.$explode[1].' minute' ); 
            $timpoRealTranscurrido->modify('-'.$explode[2].' second'); 
            $timpoRealTranscurrido =  $timpoRealTranscurrido->format('H:i:s');
            //realizar calculos 
            $valorHora = intval($datosReserva->th_valor_hora);
            $hms = explode(":",$timpoRealTranscurrido);
            $hmsInt=array();
            foreach($hms as $item){
                $hmsInt[] = intval($item);
            }
            //valor horas
            if($hmsInt[0]>0){
                $total += $valorHora*$hmsInt[0];
            }
            //valor minutos 
            if($hmsInt[1]>$minutosDeCortesia){
                $total += $valorHora;
            }
            $result =array("valorHora"=>$valorHora,"decoracion"=>$precioDecoracionFactura,"total"=>$total,"tiempoTranscurrido"=>$tiempoTrancurrido,"tiempoTranscurridoFueraPromo"=>$timpoRealTranscurrido,"valorPromocion"=>$valorPromocion,"productos"=>$totalProductos);
        }else{
            $valorHora = intval($datosReserva->th_valor_hora);
            $hms = explode(":",$tiempoTrancurrido);
            $hmsInt=array();
            foreach($hms as $item){
                $hmsInt[] = intval($item);
            }
            //valor horas
            if($hmsInt[0]>0){
                $total += $valorHora*$hmsInt[0];
                $totalTiempo += $valorHora*$hmsInt[0];
            }
            //valor minutos 
            if($hmsInt[1]>$minutosDeCortesia){
                $total += $valorHora;
                $totalTiempo += $valorHora;
            }
            $result =array("valorHora"=>$valorHora,"decoracion"=>$precioDecoracionFactura,"totalTiempo"=>$totalTiempo,"total"=>$total,"tiempoTranscurrido"=>$tiempoTrancurrido,"productos"=>$totalProductos);
        }   
        return $result;
    }
}


?>