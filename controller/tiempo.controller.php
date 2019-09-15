
<?php 
Class TiempoController{
    private  $masterModel;
    private $doizer;
    function TiempoController($masterModel,$doizer){
        $this->masterModel = $masterModel;
        $this->doizer = $doizer;
    }
    function tiempoTranscurridoFechas(){
        $fecha1 = new DateTime("2019-08-02 00:01:00");
        $fecha2 = new DateTime("2019-08-03 07:01:00");
        $fecha = $fecha1->diff($fecha2);
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
        echo json_encode($tiempo);
        return $tiempo;
    }

    function restarTiempoParcial(){
        $horaInicio = new DateTime("2019-08-03 00:01:00");
        $horaTermino = new DateTime("2019-08-03 07:01:00");

        $interval = $horaInicio->diff($horaTermino);
        // echo $interval->format('%H-%i-%s');
        echo json_encode($interval);
    }
}
?>