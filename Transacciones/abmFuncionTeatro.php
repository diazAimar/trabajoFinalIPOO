<?php
    class ABM_Funcion_Teatro extends ABM_Funcion {
        function crearFuncionTeatroAbm($datosFuncion){
            $objFuncionTeatro = new Funcion_Teatro();
            $objFuncionTeatro->cargar($datosFuncion);
            $respuesta = $objFuncionTeatro->insertar();
            return $respuesta;
        }
        
        function seleccionarFuncion($idFuncion){
            $objFuncionTeatro = new Funcion_Teatro();
            $objFuncionTeatro->buscar($idFuncion);
            return $objFuncionTeatro;
        }
        
        function eliminarFuncionTeatroAbm($objFuncion){
            $respuesta = $objFuncion->eliminar();
            return $respuesta;
        }
    }