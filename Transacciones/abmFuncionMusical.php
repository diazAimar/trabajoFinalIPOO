<?php
    class ABM_Funcion_Musical extends ABM_Funcion {
        function crearFuncionMusicalAbm($datosFuncion){
            $objFuncionMusical = new Funcion_Musical();
            $objFuncionMusical->cargar($datosFuncion);
            $respuesta = $objFuncionMusical->insertar();
            return $respuesta;
        }

        function modificarDirectorMusical($objFuncionMusical, $director){
            $objFuncionMusical->setDirector($director);
            $respuesta = $objFuncionMusical->modificar();
            return $respuesta;
        }

        function modificarCantPersEscenaMusical($objFuncionMusical, $cantPersEscena){
            $objFuncionMusical->setCantidadDePersonasEnEscena($cantPersEscena);
            $respuesta = $objFuncionMusical->modificar();
            return $respuesta;
        }

        function seleccionarFuncion($idFuncion){
            $objFuncionMusical = new Funcion_Musical();
            $objFuncionMusical->buscar($idFuncion);
            return $objFuncionMusical;
        }

        function eliminarFuncionMusicalAbm($objFuncion){
            $respuesta = $objFuncion->eliminar();
            return $respuesta;
        }
    }