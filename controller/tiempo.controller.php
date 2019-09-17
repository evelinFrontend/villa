
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
        $horaInicioInterval  = new DateTime($fecha_hora_inicio);
        $horaTerminoInterval = new DateTime($fecha_hora_fin);
        $interval = $horaInicioInterval->diff($horaTerminoInterval);
        $timpoReal = new DateTime($fecha_hora_tiempo_transcurrido); 
        $timpoReal->modify('-'.$interval->h.' hours'); 
        $timpoReal->modify('-'.$interval->i.' minute' ); 
        $timpoReal->modify('-'.$interval->s.' second'); 
        // echo json_encode($timpoReal->format('H:i:s'));
        return $timpoReal->format('H:i:s');
    }
    function timeToMoney($id_reserva,$tiempoTrancurrido){
        $datosReserva = $this->masterModel->sqlSelect("SELECT * FROM reserva_activa ra INNER JOIN habitacion  h ON ra.hab_numero = h.hab_numero INNER JOIN tipo_habitacion th ON h.id_tipo_habitacion = th.id_tipo_habitacion WHERE id_reserva = ?",array($id_reserva))[0];
        $minutosDeCortesia = intval($this->masterModel->selectAll("villa_config")[0]->conf_minutos_cortesia);
        $total = 0;
        if(isset($datosReserva->promo_id)){
            $result =  "precio con promo";
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
            }
            //valor minutos 
            if($hmsInt[1]>$minutosDeCortesia){
                $total += $valorHora;
            }
        }   

        return $total;
    }
}
?>