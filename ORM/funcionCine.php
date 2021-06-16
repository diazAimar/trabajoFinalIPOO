<?php
    class Funcion_Cine extends Funcion{
        /* Atributos */
        private $genero;
        private $paisDeOrigen;
        private $mensajeoperacion;

        /**
        *   constructor del objeto
        *   @param string $nom
        *   @param string $horaInicio
        *   @param array $dur
        *   @param int $prec
        *   @param string $gen
        *   @param string $paisOrig
        */ 
        public function __construct(){
            parent::__construct();
            $this -> genero = "";
            $this -> paisDeOrigen = "";
        }

        public function cargar($datosFuncionArrAsoc){
            parent::cargar($datosFuncionArrAsoc);
            $this->setGenero($datosFuncionArrAsoc["genero"]);
            $this->setPaisDeOrigen($datosFuncionArrAsoc["paisorigen"]);

        }
        
        /* GET y SET del genero */
        public function getGenero(){
            return $this -> genero;
        }
        public function setGenero($gen){
            $this -> genero = $gen;
        }

        /* GET y SET del pais de origen */
        public function getPaisDeOrigen(){
            return $this -> paisDeOrigen;
        }
        public function setPaisDeOrigen($paisOrig){
            $this -> paisDeOrigen = $paisOrig;
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
            $consultaFuncion = "SELECT * FROM funcioncine WHERE idFuncion = " . $idFuncion;
            $resp = false;
            if($base -> Iniciar()){
                if($base -> Ejecutar($consultaFuncion)){
                    if($row2 = $base -> Registro()){
                        parent::buscar($idFuncion);
                        $this->setGenero($row2['genero']);
                        $this->setPaisDeOrigen($row2['paisorigen']);
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
            $consultaFunciones="SELECT * FROM funcioncine ";
            $consultaFunciones.= "INNER JOIN funcion ON funcion.idfuncion = funcioncine.idfuncion ";
            if ($condicion!=""){
                $consultaFunciones .= ' WHERE '. $condicion;
            }
            $consultaFunciones.=" ORDER BY funcioncine.idfuncion ";
            // echo "\nCONSULTA CINE: " . $consultaFunciones;
            if($base->Iniciar()){
                if($base->Ejecutar($consultaFunciones)){				
                    $arregloFunciones = array();
                    while($tupla = $base->Registro()){
                        $funcion = new Funcion_Cine();
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
                $consultaInsertar="INSERT INTO funcioncine(idfuncion, genero, paisorigen)
                    VALUES (".parent::getIdFuncion(). ",'" . $this->getGenero() . "','" . $this->getPaisDeOrigen() . "')";
                if($base->Iniciar()){
                    if($base->Ejecutar($consultaInsertar)){
                        $resp=  true;
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
                $consultaModifica="UPDATE funcioncine SET genero='".$this->getGenero()."', paisorigen='" . $this->getPaisDeOrigen()."' WHERE idfuncion=". parent::getIdFuncion();
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
                    $consultaBorra="DELETE FROM funcioncine WHERE idfuncion=".parent::getIdFuncion();
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
            $precioCine = $precio * 1.65;
            return $precioCine;
        }

        /* __toString */
        public function __toString(){
            return parent::__toString() .
            "\nGenero: " . $this -> getGenero() . 
            "\nPais de origen: " . $this -> getPaisDeOrigen() . "\n";
        }

    }