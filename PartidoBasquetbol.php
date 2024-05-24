<?php

class PartidoBasquetbol extends Partido{
    private $cantidadInfracciones;
    private $coefPenalizacion;

    public function __construct($idpartido, $fecha,$objEquipo1,$cantGolesE1,$objEquipo2,$cantGolesE2,$cantidadInfracciones,$coefPenalizacion){
        parent :: __construct($idpartido, $fecha,$objEquipo1,$cantGolesE1,$objEquipo2,$cantGolesE2);
        $this->cantidadInfracciones=$cantidadInfracciones;
        $this->coefPenalizacion=0.75;
    }

    public function getCantidadInfracciones(){
        return $this->cantidadInfracciones;
    }

    public function setCantidadInfracciones($cantidadInfracciones){
        $this->cantidadInfracciones = $cantidadInfracciones;
    }

    public function getCoefPenalizacion(){
        return $this->coefPenalizacion;
    }

    public function setCoefPenalizacion($coefPenalizacion){
        $this->coefPenalizacion = $coefPenalizacion;
    }

    public function coeficientePartido(){
        $coeficiente= parent:: coeficientePartido();
        $coeficiente = $coeficiente - ($this->getCoefPenalizacion()*$this->getCantidadInfracciones());
    
        return $coeficiente;
    }

    public function __toString(){
        $cadena ="\n".parent::__toString()."\n";
        $cadena.="Cantidad de infracciones: ".$this->getCantidadInfracciones()."\n";
        $cadena.="Coeficiente penalizacion: ".$this->getCoefPenalizacion()."\n";

        return $cadena;
    }
}