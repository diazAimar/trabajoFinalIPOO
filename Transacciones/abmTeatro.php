<?php
    class ABM_Teatro{
        function crearTeatroAbm($datosTeatro){
            $objTeatro = new Teatro();
            $objTeatro->cargar($datosTeatro);
            $respuesta = $objTeatro->insertar();
            return $respuesta;
        }

        function modificarNombreTeatro($objTeatro, $nombre){
            $objTeatro->setNombreTeatro($nombre);
            $objTeatro->modificar();
        }

        function modificarDireccionTeatro($objTeatro, $direccion){
            $objTeatro->setDireccionTeatro($direccion);
            $objTeatro->modificar();
        }

        function seleccionarTeatro($idTeatro){
            $objTeatro = new Teatro();
            $objTeatro->buscar($idTeatro);
            return $objTeatro;
        }

        function eliminarTeatroAbm($objTeatro){
            $colFunciones = $objTeatro->recuperarFunciones($objTeatro->getIdTeatro());
            $respuesta = false;
            $cantElim = 0;
            foreach ($colFunciones as $funciones) {
                if($funciones->eliminar()){
                    $cantElim++;
                }
            }
            if($cantElim == count($colFunciones)){
                $objTeatro->eliminar();
                $respuesta = true;
            }
            return $respuesta;
        }
    }