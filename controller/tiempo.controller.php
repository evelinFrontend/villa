
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
}
?>