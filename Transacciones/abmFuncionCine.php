<?php
    class ABM_Funcion_Cine extends ABM_Funcion {
        function crearFuncionCineAbm($datosFuncion){
            $objFuncionCine = new Funcion_Cine();
            $objFuncionCine->cargar($datosFuncion);
            $respuesta = $objFuncionCine->insertar();
            return $respuesta;
        }

        function modificarGenero($objFuncionCine, $genero){
            $objFuncionCine->setGenero($genero);
            $resultado = $objFuncionCine->modificar();
            return $resultado;
        }

        function modificarPaisDeOrigen($objFuncionCine, $PaisDeOrigen){
            $objFuncionCine->setPaisDeOrigen($PaisDeOrigen);
            $resultado = $objFuncionCine->modificar();
            return $resultado;
        }

        function seleccionarFuncion($idFuncion){
            $objFuncionCine = new Funcion_Teatro();
            $objFuncionCine->buscar($idFuncion);
            return $objFuncionCine;
        }

        function eliminarFuncionCineAbm($objFuncion){
            $respuesta = $objFuncion->eliminar();
            return $respuesta;
        }
    }