<?php
    class Funcion{
        /* Atributos */
        /* ID para las primary Key */
        private $idFuncion;
        private $nombre;
        private $horarioDeInicio;
        private $duracion;
        private $precio;
        private $mensajeoperacion;
        private $objTeatro;

        /**
        *   constructor del objeto
        *   @param int $idFun
        *   @param string $nomb
        *   @param string $inic
        *   @param array $dura
        *   @param int $prec
        */
        public function __construct(){
            // $this -> idFuncion = 0;
            $this -> objTeatro = null;
            $this -> nombre = "";
            $this -> horarioDeInicio = "";
            $this -> duracion = "";
            $this -> precio = 0;
            $this -> idTeatro = 0;
        }

        /* cargar */
        public function cargar($datosFuncionArrAsoc){	
            // $this->setIdFuncion($datosFuncionArrAsoc["idfuncion"]);
            $this->setNombre($datosFuncionArrAsoc["nombre"]);
            $this->setHorarioDeInicio($datosFuncionArrAsoc["horariodeinicio"]);
            $this->setDuracion($datosFuncionArrAsoc["duracion"]);
            $this->setPrecio($datosFuncionArrAsoc["precio"]);
            $this->setObjTeatro($datosFuncionArrAsoc["objteatro"]);
        }

        /* GET y SET del nombre del id de la funcion */
        public function getIdFuncion(){
            return $this -> idFuncion;
        }
        public function setIdFuncion($idFun){
            $this -> idFuncion = $idFun;
        }

        /* GET y SET del nombre de la funcion */
        public function getNombre(){
            return $this -> nombre;
        }
        public function setNombre($nomb){
            $this -> nombre = $nomb;
        }

        /* GET y SET del horario de inicio de la funcion */
        public function getHorarioDeInicio(){
            return $this -> horarioDeInicio;
        }
        public function setHorarioDeInicio($inic){
            $this -> horarioDeInicio = $inic;
        }

        /* GET y SET de la duracion de la funcion */
        public function getDuracion(){
            return $this -> duracion;
        }
        public function setDuracion($dura){
            $this -> duracion = $dura;
        }

        /* GET y SET del precio de una funcion */
        public function getPrecio(){
            return $this -> precio;
        }
        public function setPrecio($prec){
            $this -> precio = $prec;
        }

        /* GET y SET del mensaje de la operacion */
        // public function getIdTeatro(){
        //     return $this -> idTeatro ;
        // }

        // public function setIdTeatro($idTeatro){
        //     $this -> idTeatro = $idTeatro;
        // }

        
        /* GET y SET del obj Teatro */
        /**
         * 
         * @return Teatro
         */
        public function getObjTeatro(){
            return $this -> objTeatro ;
        }

        public function setObjTeatro($objTeatro){
            $this -> objTeatro = $objTeatro;
        }

        /* GET y SET del mensaje de la operacion */
        public function getmensajeoperacion(){
            return $this->mensajeoperacion ;
        }

        public function setmensajeoperacion($mensajeoperacion){
            $this->mensajeoperacion=$mensajeoperacion;
        }

        /* darCosto */
        public function darCosto(){
            return $this -> getPrecio();
        }

        /* buscar */
        public function buscar($idFuncion){
            $base = new BaseDatos;
            $consultaFuncion = "SELECT * FROM funcion WHERE idFuncion = " . $idFuncion;
            $resp = false;
            if($base -> Iniciar()){
                if($base -> Ejecutar($consultaFuncion)){
                    if($row2 = $base -> Registro()){
                        $this -> setIdFuncion($idFuncion);
                        $this -> setNombre($row2['nombre']);
                        $this -> setHorarioDeInicio($row2['horariodeinicio']);
                        $this -> setDuracion($row2['duracion']);
                        $this -> setPrecio($row2['precio']);
                        // $this -> setIdTeatro($row2['idteatro']);
                        
                        $objTeatro = new Teatro();
                        $objTeatro -> buscar($row2['idteatro']);
                        $this -> setObjTeatro($objTeatro);
                        // $idTeatro = $row2["idTeatro"];
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
            $consultaFunciones="SELECT * FROM funcion ";
            if ($condicion!=""){
                $consultaFunciones .= ' WHERE '. $condicion;
            }
            $consultaFunciones.=" ORDER BY idfuncion ";
            if($base->Iniciar()){
                if($base->Ejecutar($consultaFunciones)){				
                    $arregloFunciones = array();
                    while($tupla = $base->Registro()){
                        $funcion = new Funcion();
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
            $consultaInsertar="INSERT INTO funcion(nombre, horariodeinicio, duracion, precio, idTeatro) 
                    VALUES ('" . $this->getNombre() . "','" . $this->getHorarioDeInicio() . "','" . $this->getDuracion() . "','" . $this-> getPrecio() . "','" . $this->getObjTeatro()->getIdTeatro(). "')";
            if($base->Iniciar()){
                if($id = $base->devuelveIDInsercion($consultaInsertar)){
                    $this->setIdFuncion($id);
                    $this -> __toString();
                    $resp=  true;
                }	
                else {
                        $this->setmensajeoperacion($base->getError());     
                }
            } else {
                    $this->setmensajeoperacion($base->getError());
            }
            return $resp;
        }

        /* modificar */
        public function modificar(){
            $resp =false; 
            $base=new BaseDatos();
            $consultaModifica="UPDATE funcion SET nombre='".$this->getNombre()."',horariodeinicio='".$this->getHorarioDeInicio()."', duracion='".$this->getDuracion()."', precio='".$this->getPrecio()."', idteatro=".$this->getObjTeatro()->getIdTeatro()." WHERE idfuncion =".$this->getIdFuncion();
            if($base->Iniciar()){
                if($base->Ejecutar($consultaModifica)){
                    $resp=  true;
                }else{
                    $this->setmensajeoperacion($base->getError());
                    
                }
            }else{
                    $this->setmensajeoperacion($base->getError());
                
            }
            return $resp;
        }

        /* eliminar */
        public function eliminar(){
            $base=new BaseDatos();
            $resp=false;
            if($base->Iniciar()){
                    $consultaBorra="DELETE FROM funcion WHERE idfuncion=".$this->getIdFuncion();
                    if($base->Ejecutar($consultaBorra)){
                        $resp=  true;
                    }else{
                            $this->setmensajeoperacion($base->getError());
                        
                    }
            }else{
                    $this->setmensajeoperacion($base->getError());
                
            }
            return $resp; 
        }
        /* __toString */
        public function __toString(){
            return "\nNombre de la funcion: " . $this -> getNombre() . 
            ". Precio: " . $this -> getPrecio() . ". Horario de Inicio: " . $this -> getHorarioDeInicio() . ". Duracion: " . $this -> getDuracion() . " ID Funcion: " . $this -> getIdFuncion() . " ID Teatro: " . $this->getObjTeatro()->getIdTeatro();
        }
    } 