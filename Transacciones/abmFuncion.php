<?php
    class ABM_Funcion{
        function crearFuncionAbm($datosFuncion){
            $objFuncion = new Funcion();
            $objFuncion->cargar($datosFuncion);
            $respuesta = $objFuncion->insertar();
            return $respuesta;
        }

        public static function modificarNombreFuncion($objFuncion, $nombre){
            $objFuncion->setNombre($nombre);
            $objFuncion->modificar();
        }

        function modificarHorarioInicioFuncion($objFuncion, $horario){
            $objFuncion->setHorarioDeInicio($horario);
            $respuesta = $objFuncion->modificar();
            return $respuesta;
        }

        function modificarDuracionFuncion($objFuncion, $duracion){
            $objFuncion->setDuracion($duracion);
            $respuesta = $objFuncion->modificar();
            return $respuesta;
        }

        function modificarPrecio($objFuncion, $precio){
            $objFuncion->setPrecio($precio);
            $objFuncion->modificar();
        }

        function eliminarFuncionAbm($objFuncion){
            $respuesta = $objFuncion->eliminar();
            return $respuesta;
        }

        function seleccionarFuncion($idFuncion){
            $objFuncion = new Funcion();
            $objFuncion->buscar($idFuncion);
            return $objFuncion;
        }
    }