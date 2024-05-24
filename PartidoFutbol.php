<?php

class PartidoFutbol extends Partido{
    private $coef_Menores;
    private $coef_juveniles;
    private $coef_Mayores;

    public function __construct($idpartido, $fecha,$objEquipo1,$cantGolesE1,$objEquipo2,$cantGolesE2,$coef_Menores,$coef_juveniles,$coef_Mayores){
        parent :: __construct($idpartido, $fecha,$objEquipo1,$cantGolesE1,$objEquipo2,$cantGolesE2);
        $this->$coef_Menores=0.13;
        $this->$coef_juveniles=0.19;
        $this->$coef_Mayores=0.27;
    }

    public function getCoefMenores(){
        return $this->coef_Menores;
    }

    public function setCoefMenores($coef_Menores){
        $this->coef_Menores = $coef_Menores;
    }

    public function getCoefJuveniles(){
        return $this->coef_juveniles;
    }

    public function setCoefJuveniles($coef_juveniles){
        $this->coef_juveniles = $coef_juveniles;
    }

    public function getCoefMayores(){
        return $this->coef_Mayores;
    }

    public function setCoefMayores($coef_Mayores){
        $this->coef_Mayores = $coef_Mayores;
    }

    public function coeficientePartido(){
        $coeficiente=parent::coeficientePartido();
        $categoria1 = $this->getObjEquipo1()->getObjCategoria()->getDescripcion();
        $categoria2 = $this->getObjEquipo1()->getObjCategoria()->getDescripcion();
        if ($categoria1 == "Menores" && $categoria2 == "Menores"){
            $coeficiente= $coeficiente*$this->getCoefMenores();
        }
        if ($categoria1 == "Juveniles" && $categoria2 == "Juveniles" ){
            $coeficiente = $coeficiente*$this->getCoefJuveniles();
        }
        if ($categoria1 == "Mayores" && $categoria2 == "Mayores"){
            $coeficiente = $coeficiente*$this->getCoefMayores();
        }
        return $coeficiente;
    }

    public function __toString(){
        $cadena ="\n".parent::__toString()."\n";
        $cadena.="Coeficiente menores: ".$this->getCoefMenores()."\n";
        $cadena.="Coeficiente juveniles: ".$this->getCoefJuveniles()."\n";
        $cadena.="Coeficiente mayores: ".$this->getCoefMayores()."\n";

        return $cadena;
    }
}