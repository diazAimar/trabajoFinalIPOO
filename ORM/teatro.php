<?php
    class Teatro{
        /* Atributos */
        private $idTeatro;
        private $nombre;
        private $direccion;
        private $coleccionFunciones;
        private $mensajeOperacion;

        /**
        *   constructor del objeto
        */
        /* HACER LO MISMO QUE CON FUNCION (CARGAR Y CONSTRUCT) */
        public function __construct(){
            // $this -> idTeatro = 0;
            $this -> nombre = "";
            $this -> direccion = "";
            // $this -> coleccionFunciones = [];
        }

        public function cargar($datosTeatro){	
            // $this->setIdTeatro($datosTeatro['idteatro']);
            $this->setNombreTeatro($datosTeatro['nombre']);
            $this->setDireccionTeatro($datosTeatro['direccion']);
            // $this->setColeccionFunciones($datosTeatro['coleccionfunciones']);
        }

        /* GET y SET del nombre del ID teatro */
        public function getIdTeatro(){
            return $this -> idTeatro;
        }
        public function setIdTeatro($idTeatro){
            $this -> idTeatro = $idTeatro;
        }

        /* GET y SET del nombre del teatro */
        public function getNombreTeatro(){
            return $this -> nombre;
        }
        public function setNombreTeatro($nom){
            $this -> nombre = $nom;
        }

        /* GET y SET de la direccion del teatro */
        public function getDireccionTeatro(){
            return $this -> direccion;
        }
        public function setDireccionTeatro($dir){
            $this -> direccion = $dir;
        }

        /* GET y SET de las funciones del teatro */
        public function getColeccionFunciones(){
            $coleccionFunciones = $this -> recuperarFunciones($this->getIdTeatro());
            $this->setColeccionFunciones($coleccionFunciones);
            return $this -> coleccionFunciones;
        }
        public function setColeccionFunciones($arrObjFunciones){
            $this -> coleccionFunciones = $arrObjFunciones;
        }

        /* GET y SET del mensaje de la operacion */
        public function getMensajeOperacion(){
            return $this->mensajeOperacion ;
        }

        public function setMensajeOperacion($mensajeOperacion){
            $this->mensajeOperacion=$mensajeOperacion;
        }

        /* Metodo para recuperar las funciones   */
        public function recuperarFunciones($idTeatro){
            $colFuncionesTotal = [];
            /* Condicion para que me traiga solo las funciones que pertenecen al teatro ¿actual? */
            $condicion = " idteatro = " . $idTeatro;
            /* Listo todas las funciones y las guardo (/merge) en un arreglo. */
            $objFuncionCine = new Funcion_Cine();
            $objFuncionMusical = new Funcion_Musical();
            $objFuncionTeatro = new Funcion_Teatro();
            $colFuncionCine = $objFuncionCine -> listar($condicion);
            $colFuncionMusical = $objFuncionMusical -> listar($condicion);
            $colFuncionTeatro = $objFuncionTeatro -> listar($condicion);
            $colFuncionesTotal = array_merge($colFuncionCine, $colFuncionMusical, $colFuncionTeatro);
            return $colFuncionesTotal;
        }

        /**
         * Recupera los datos de un teatro por idTeatro
         * @param int $dni
         * @return true en caso de encontrar los datos, false en caso contrario 
         */		
        public function Buscar($idTeatro){
            $base=new BaseDatos();
            $consultaTeatro="SELECT * FROM teatro WHERE idteatro=".$idTeatro;
            $resp= false;
            if($base->Iniciar()){
                if($base->Ejecutar($consultaTeatro)){
                    if($tupla=$base->Registro()){
                        $this->setIdTeatro($idTeatro);
                        $this->setNombreTeatro($tupla['nombre']);
                        $this->setDireccionTeatro($tupla['direccion']);
/*                         $colFuncionesTotal = $this -> recuperarFunciones($idTeatro);
                        $this->setColeccionFunciones($colFuncionesTotal); */
                        $resp = true;
                    }				
                }	else {
                        $this->setmensajeoperacion($base->getError());
                    
                }
            }	else {
                    $this->setmensajeoperacion($base->getError());
            }		
            return $resp;
        }

        /* listar */
        public function listar($condicion=""){
            $arregloTeatros = [];
            $base=new BaseDatos();
            $consultaTeatros="SELECT * FROM teatro ";
            if ($condicion!=""){
                $consultaTeatros.=' WHERE '.$condicion;
            }
            $consultaTeatros.=" ORDER BY idteatro ";
            if($base->Iniciar()){
                if($base->Ejecutar($consultaTeatros)){				
                    $arregloTeatros= array();
                    while($tupla=$base->Registro()){
                        $tupla["coleccionfunciones"] = $this -> getColeccionFunciones($tupla["idteatro"]);
                        $teatro = new Teatro();
                        $teatro -> buscar($tupla['idteatro']);
                        array_push($arregloTeatros,$teatro);       
                    }                
                 }	else {
                         $this->setmensajeoperacion($base->getError());                    
                }
             }	else {
                     $this->setmensajeoperacion($base->getError());
             }	
             return $arregloTeatros;
        }	

        /* insertar */
        public function insertar(){
            $base=new BaseDatos();
            $resp= false;
            $consultaInsertar="INSERT INTO teatro(nombre, direccion) 
                    VALUES ('" . $this->getNombreTeatro() . "','" . $this->getDireccionTeatro() . "')";
            if($base->Iniciar()){
                if($id = $base->devuelveIDInsercion($consultaInsertar)){
                    $this->setIdTeatro($id);
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
        /* 
        UPDATE teatro
        SET nombre='nombre', direccion='direccion'
        WHERE idteatro=id*/
        /* modificar */
        public function modificar(){
            $resp =false; 
            $base=new BaseDatos();
            $consultaModifica="UPDATE teatro SET nombre='".$this->getNombreTeatro()."',direccion='".$this->getDireccionTeatro()."' WHERE idteatro =".$this->getIdTeatro();
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
                    $consultaBorra="DELETE FROM teatro WHERE idteatro=".$this->getIdTeatro();
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

        public function darCostos(){
            $costoTotal = 0;
            $costoTeatro = 0;
            $costoCine = 0;
            $costoMusical = 0;
            $objFuncionMusical = new Funcion_Musical;
            $objFuncionCine = new Funcion_Cine;
            $objFuncionTeatro = new Funcion_Teatro;
            $funciones = $this->getColeccionFunciones();
            foreach($funciones as $funcion){
                if ($objFuncionMusical->buscar($funcion->getIdFuncion())) {
                    // echo "true para musical";
                    $costoMusical += $objFuncionMusical->getPrecio() * 1.12;
                }
                else if ($objFuncionTeatro->buscar($funcion->getIdFuncion())) {
                    $costoTeatro += $objFuncionTeatro->getPrecio() * 1.45;
                }
                else if ($objFuncionCine->buscar($funcion->getIdFuncion())) {
                    $costoCine += $objFuncionCine->getPrecio() * 1.65;
                }
            }
            $costoTotal = $costoMusical + $costoCine + $costoTeatro;
            return "\nCostos: \nCosto de alquiler de las funciones de teatro: $" . $costoTeatro .
            ".\nCosto de alquiler de las peliculas: $" . $costoCine .
            ".\nCosto de alquier de los musicales: $" . $costoMusical . 
            ".\nCosto total de alquiler del teatro: $" . ($costoTotal) . "\n";
        }
            


        /**
        *   funcion que retorna informacion del objeto en string
        *   @return string
        */
        // public function __toString(){
        //     return "El teatro se llama " . $this -> getNombreTeatro() .
        //     ", y se encuentra ubicado en " . $this -> getDireccionTeatro() . " con una id de " . $this -> getIdTeatro() . "\n";
        // }
        public function __toString() {
            $resultado =
              "\nTeatro " . $this->getNombreTeatro() .
              ". Direccion: " . $this->getDireccionTeatro() .
              ". Cantidad de funciones: " . count($this->recuperarFunciones($this->getIdTeatro())) .
              ". ID Teatro: " . $this->getIdTeatro();
/*             $colFunciones = $this->recuperarFunciones($this->getIdTeatro());
            foreach ($colFunciones as $funcion) {
                $resultado .= $funcion . "\n";
            } */
            return $resultado;
          }
    }