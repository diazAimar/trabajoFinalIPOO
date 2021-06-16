<?php
    class Funcion_Musical extends Funcion{
        /* Atributo */
        private $director;
        private $cantidadDePersonasEnEscena;

        /**
        *   constructor del objeto
        *   @param string $nom
        *   @param string $horaInicio
        *   @param array $dur
        *   @param int $prec
        *   @param string $dir
        *   @param int $cantPersEscena
        */ 
        public function __construct(){
            parent::__construct();
            $this -> director = "";
            $this -> cantidadDePersonasEnEscena = "";
        }

        public function cargar($datosFuncionArrAsoc){
            parent::cargar($datosFuncionArrAsoc);
            $this->setDirector($datosFuncionArrAsoc["director"]);
            $this->setCantidadDePersonasEnEscena($datosFuncionArrAsoc["cantpersonasescena"]);
        }

        /* GET y SET del nombre del director */
        public function getDirector(){
            return $this -> director;
        }
        public function setDirector($dir){
            $this -> director = $dir;
        }

        /* GET y SET de cantidad de personas en escena */
        public function getCantidadDePersonasEnEscena(){
            return $this -> cantidadDePersonasEnEscena;
        }
        public function setCantidadDePersonasEnEscena($cantPersEscena){
            $this -> cantidadDePersonasEnEscena = $cantPersEscena;
        }

        /* GET y SET del mensaje de la operacion */
        public function setmensajeoperacion($mensajeoperacion){
            $this->mensajeoperacion=$mensajeoperacion;
        }

        public function getmensajeoperacion(){
            return $this->mensajeoperacion ;
        }

        /* buscar */
        public function buscar($idFuncion){
            $base = new BaseDatos;
            $consultaFuncion = "SELECT * FROM funcionmusical WHERE idFuncion = " . $idFuncion;
            $resp = false;
            if($base -> Iniciar()){
                if($base -> Ejecutar($consultaFuncion)){
                    if($row2 = $base -> Registro()){
                        parent::buscar($idFuncion);
                        $this->setDirector($row2['director']);
                        $this->setCantidadDePersonasEnEscena($row2['cantpersonasescena']);
                        $resp = true;
                    }
                } 
                else {
                    $this->setmensajeoperacion($base->getError());
                }
            }
            else {
                $this->setmensajeoperacion($base->getError());
            }
            return $resp;
        }

        /* listar */
        public function listar($condicion=""){
            $arregloFunciones = [];
            $base=new BaseDatos();
            $consultaFunciones="SELECT * FROM funcionmusical ";
            $consultaFunciones.= "INNER JOIN funcion ON funcion.idfuncion = funcionmusical.idfuncion ";
            if ($condicion!=""){
                $consultaFunciones .=' WHERE '. $condicion;
            }
            $consultaFunciones.=" ORDER BY funcionmusical.idfuncion ";
            // echo "\nCONSULTA MUSICAL: " . $consultaFunciones;
            if($base->Iniciar()){
                if($base->Ejecutar($consultaFunciones)){				
                    $arregloFunciones = array();
                    while($tupla = $base->Registro()){
                        $funcion = new Funcion_Musical();
                        $funcion -> buscar($tupla['idfuncion']);
                        array_push($arregloFunciones, $funcion);
                    }
                 }	else {
                         $this->setmensajeoperacion($base->getError());
                }
             }	else {
                     $this->setmensajeoperacion($base->getError());
                 
             }	
             return $arregloFunciones;
        }	
        
        /* insertar */
        /*        
        private $idFuncion;
        private $nombre;
        private $horarioDeInicio;
        private $duracion;
        private $precio;
        private $idTeatro; */
        public function insertar(){
            $base=new BaseDatos();
            $resp= false;
            if(parent::insertar()){
                $consultaInsertar="INSERT INTO funcionmusical(idfuncion, director, cantpersonasescena)
                    VALUES (".parent::getIdFuncion(). ",'" . $this->getDirector() . "'," . $this->getCantidadDePersonasEnEscena() . ")";
                if($base->Iniciar()){
                    if($base->Ejecutar($consultaInsertar)){
                        $resp=  true;
/*                         echo "ID FUNCION MUSICAL";
                        echo $this->getIdFuncion();
                        echo "========"; */
                    }	else {
                        $this->setmensajeoperacion($base->getError());
                    }
                } else {
                    $this->setmensajeoperacion($base->getError());
                }
             }
            return $resp;
        }

        /* modificar */
        public function modificar(){
            $resp =false; 
            $base=new BaseDatos();
            if(parent::modificar()){
                $consultaModifica="UPDATE funcionmusical SET director='".$this->getDirector()."', cantpersonasescena=" . $this->getCantidadDePersonasEnEscena()." WHERE idfuncion=". parent::getIdFuncion();
                // echo $consultaModifica;
                if($base->Iniciar()){
                    if($base->Ejecutar($consultaModifica)){
                        $resp=  true;
                    }else{
                        $this->setmensajeoperacion($base->getError());
                    }
                }else{
                    $this->setmensajeoperacion($base->getError());
                    
                }
            }
            return $resp;
        }

        /* eliminar */
        public function eliminar(){
            $base=new BaseDatos();
            $resp=false;
            if($base->Iniciar()){
                    $consultaBorra="DELETE FROM funcionmusical WHERE idfuncion=".parent::getIdFuncion();
                    if($base->Ejecutar($consultaBorra)){
                        if(parent::eliminar()){
                            $resp=  true;
                        }
                    }else{
                            $this->setmensajeoperacion($base->getError());
                        
                    }
            }else{
                    $this->setmensajeoperacion($base->getError());
                
            }
            return $resp; 
        }

        /**
        * function darCosto que retorna el precio + el incremento
        */
        public function darCosto(){
            $precio = parent::darCosto();
            $precioMusical = $precio * 1.12;
            return $precioMusical;
        }

        /* __toString */
        public function __toString(){
            return parent::__toString() .
            "\nDirector: " . $this -> getDirector() .
            "\nCantidad de Personas en Escena: " . $this -> getCantidadDePersonasEnEscena() . "\n";
        }
    }
