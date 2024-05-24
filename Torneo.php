<?php

class Torneo{
    private $colPartidos;
    private $importePremio;

    public function __construct($colPartidos,$importePremio){
        $this->colPartidos=$colPartidos;
        $this->importePremio=$importePremio;
    }

    public function getColPartidos(){
        return $this->colPartidos;
    }

    public function setColPartidos($colPartidos){
        $this->colPartidos = $colPartidos;
    }

    public function getImportePremio(){
        return $this->importePremio;
    }

    public function setImportePremio($importePremio){
        $this->importePremio = $importePremio;
    }

    public function mostrarColeccion($coleccion){
        $cadena="";
        foreach ($coleccion as $elemento){
            $cadena.=$elemento."\n";
        }
        return $cadena;
    }

    public function ingresarPartido($objEquipo1,$objEquipo2,$fecha,$tipoPartido){
        $partidos=$this->getColPartidos();
        $partido=null;
        if ($objEquipo1->getObjCategoria()->getidcategoria() == $objEquipo2->getObjCategoria()->getidcategoria()){
            if ($objEquipo1->getCantJugadores() == $objEquipo2->getCantJugadores()){
                if ($tipoPartido == "futbol" || $tipoPartido == "FUTBOL"){
                    $partido= new PartidoFutbol(count($partidos+1),$fecha,$objEquipo1,0,$objEquipo2,0);
                }
                if ($tipoPartido == "basquetbol" || $tipoPartido == "BASQUETBOL"){
                    $partido= new PartidoBasquetbol(count($partidos+1),$fecha,$objEquipo1,0,$objEquipo2,0,0);
                }
            }
        }
        return $partido;
    }

    public function darGanadores($deporte){
        $ganadores=[];
        $colPartidos=$this->getColPartidos();
        foreach ($colPartidos as $partido){
            if ($deporte == "futbol" || $deporte == "FUTBOL" && $partido instanceof PartidoFutbol){
                $ganadores[]=$partido->darEquipoGanador();
            }
            if ($deporte == "basquetbol" || $deporte =="BASQUETBOL" && $partido instanceof PartidoBasquetbol){
                $ganadores[]=$partido->darEquipoGanador();
            }
        }
        return $ganadores;
    }

    public function calcularPremioPartido($objPartido){
        $premioPartido = $objPartido->coeficientePartido()*$this->getImportePremio();
        $equipoGanador= $objPartido->darEquipoGanador();
        $arreglo=[
            "equipoGanador" => $equipoGanador,
            "premioPartido" => $premioPartido
        ];
        return $arreglo;
    }

    public function __toString(){
        $cadena ="\n----Coleccion Partidos----\n".$this->mostrarColeccion()."\n";
        $cadena.="Importe premio: ".$this->getImportePremio()."\n";

        return $cadena;
    }
}