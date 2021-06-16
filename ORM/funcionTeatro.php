<?php
    class Funcion_Teatro extends Funcion{
        private $mensajeoperacion;
        /**
        *   constructor del objeto
        *   @param string $nom
        *   @param string $horaInicio
        *   @param array $dur
        *   @param int $prec
        */ 
        public function __construct(){
            parent::__construct();
        }

        public function cargar($datosFuncionArrAsoc){
            parent::cargar($datosFuncionArrAsoc);
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
            $consultaFuncion = "SELECT * FROM funcionteatro WHERE idFuncion = " . $idFuncion;
            $resp = false;
            /* Hace falta que este todo? O solo con tener parent ya esta? Porque llamando a buscar parent hace lit lo mismo, sumado que funcionTeatro no tiene parametros "propios" a diferencia de Estudiante */
            if($base -> Iniciar()){
                if($base -> Ejecutar($consultaFuncion)){
                    if($row2 = $base -> Registro()){
                        parent::buscar($idFuncion);
                        // $idTeatro = $row2["idTeatro"];
                        // $objTeatro = new Teatro();
                        // $objTeatro -> buscar($idTeatro);
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
            $consultaFunciones="SELECT * FROM funcionteatro ";
            $consultaFunciones.= "INNER JOIN funcion ON funcion.idfuncion = funcionteatro.idfuncion ";
            if ($condicion!=""){
                $consultaFunciones .= ' WHERE '. $condicion;
            }
            $consultaFunciones.=" ORDER BY funcionteatro.idfuncion ";
            // echo "\nCONSULTA TEATRO: " . $consultaFunciones;
            if($base->Iniciar()){
                if($base->Ejecutar($consultaFunciones)){				
                    $arregloFunciones = array();
                    while($tupla = $base->Registro()){
                        $funcion = new Funcion_Teatro();
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
                $consultaInsertar="INSERT INTO funcionteatro(idfuncion)
                    VALUES (".parent::getIdFuncion().")";
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
            return parent::modificar();
        }

        /* eliminar */
        public function eliminar(){
            $base=new BaseDatos();
            $resp=false;
            if($base->Iniciar()){
                    $consultaBorra="DELETE FROM funcionteatro WHERE idfuncion=".parent::getIdFuncion();
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
            $precioTeatro = $precio * 1.45;
            return $precioTeatro;
        }

        /* __toString */
        public function __toString(){
            return parent::__toString();
        }
    }