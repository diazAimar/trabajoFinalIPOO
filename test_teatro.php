<?php
include_once './ORM/BaseDatos.php';
include_once './ORM/teatro.php';
include_once './ORM/funcion.php';
include_once './ORM/funcionteatro.php';
include_once './ORM/funcionmusical.php';
include_once './ORM/funcioncine.php';
include_once './Transacciones/abmTeatro.php';
include_once './Transacciones/abmFuncion.php';
include_once './Transacciones/abmFuncionTeatro.php';
include_once './Transacciones/abmFuncionMusical.php';
include_once './Transacciones/abmFuncionCine.php';


/**
 *   ALGORITMO PRINCIPAL
 *   
 */
do{
  $opcionSeleccionada = seleccionarOpcion();
  switch($opcionSeleccionada){
    case 1: /* Crear un nuevo Teatro */
      crearTeatro();
      break;
    case 2: /* Cambiar el nombre de un teatro */
      imprimirTeatros();
      cambiarNombreTeatro();
      break;
    case 3: /* Cambiar la direccion de un teatro */
      imprimirTeatros();
      cambiarDireccionTeatro();
      break;
    case 4: /* Crear una nueva funcion */
      imprimirTeatros();
      crearFuncion();
      break;
    case 5: /* Cambiar el nombre de una funcion */
      imprimirFunciones();
      cambiarNombreFuncion();
      break;
    case 6: /* Cambiar el precio de una funcion */
      imprimirFunciones();
      cambiarPrecioFuncion();
      break;
    case 7: /* Cambiar el horario de inicio de una funcion */
      imprimirFunciones();
      cambiarHorarioInicioFuncion();
      break;
    case 8: /* Cambiar la duracion de una funcion */
      imprimirFunciones();
      cambiarDuracionFuncion();
      break;
    case 9: /* Cambiar el director de una funcion musical */
      imprimirFuncionesMusical();
      cambiarDirectorFuncionMusical();
      break;
    case 10: /* Cambiar la cantidad de personas en escena de una funcion musical */
      imprimirFuncionesMusical();
      cambiarCantPersEscenaMusical();
      break;
    case 11: /* Cambiar el genero de una pelicula */
      imprimirFuncionesCine();
      cambiarGeneroFuncionCine();
      break;
    case 12: /* Cambiar el pais de origen de una pelicula */
      imprimirFuncionesCine();
      cambiarPaisDeOrigenFuncionCine();
      break;
    case 13: /* Eliminar un teatro */
      imprimirTeatros();
      eliminarTeatro();
      break;
    case 14: /* Eliminar una funcion */
      imprimirFunciones();
      eliminarFuncion();
      break;
    case 15: /* Ver todos los teatros */
      imprimirTeatros();
      break;
    case 16: /* Ver las funciones de un teatro especifico */
      imprimirTeatros();
      imprimirFunciones();
      break;
    case 17: /* Ver los costos */
      imprimirTeatros();
      darCostosTest();
      break;
    /* Salir del programa */

  }
} while($opcionSeleccionada != 18);


function imprimirFunciones(){
  echo "\nIngrese el ID del teatro del que desea ver las funciones: ";
  $idTeatro = trim(fgets(STDIN));
  $objTeatro = new Teatro();
  if($objTeatro->Buscar($idTeatro)){
    $colFunciones = $objTeatro->getColeccionFunciones();
    foreach($colFunciones as $funcion){
      echo $funcion;
    }
  }
}

function imprimirFuncionesMusical(){
  echo "\nIngrese el ID del teatro del que desea ver las funciones Musical: ";
  $idTeatro = trim(fgets(STDIN));
  $objTeatro = new Teatro();
  if($objTeatro->Buscar($idTeatro)){
    $colFunciones = $objTeatro->getColeccionFunciones();
    foreach($colFunciones as $funcion){
      if(is_a($funcion, "Funcion_Musical")){
        echo $funcion;
      }
    }
  }
}

function imprimirFuncionesCine(){
  echo "\nIngrese el ID del teatro del que desea ver las funciones Cine: ";
  $idTeatro = trim(fgets(STDIN));
  $objTeatro = new Teatro();
  if($objTeatro->Buscar($idTeatro)){
    $colFunciones = $objTeatro->getColeccionFunciones();
    foreach($colFunciones as $funcion){
      if(is_a($funcion, "Funcion_Cine")){
        echo $funcion;
      }
    }
  }
}

function imprimirFuncionesTeatro(){
  echo "\nIngrese el ID del teatro del que desea ver las funciones Teatro: ";
  $idTeatro = trim(fgets(STDIN));
  $objTeatro = new Teatro();
  if($objTeatro->Buscar($idTeatro)){
    $colFunciones = $objTeatro->getColeccionFunciones();
    foreach($colFunciones as $funcion){
      if(is_a($funcion, "Funcion_Teatro")){
        echo $funcion;
      }
    }
  }
}

function imprimirTeatros(){
  $objTeatro = new Teatro();
  $coleccionTeatros = $objTeatro->listar();
  if($coleccionTeatros != []){
    echo "Teatros: ";
    foreach($coleccionTeatros as $teatro){
      echo $teatro;
    }
  }
}

/**
*   muestra por pantalla un menu interactivo y retorna la eleccion realizada por el usuario.
*   @return int
*/
function seleccionarOpcion(){
  echo "\n\033[01;33m--------------------------------------------------------------\033[0m\n";
  echo "\033[01;33m---------------------------\033[0m \033[00;32mMenu\033[0m \033[01;33m-----------------------------\033[0m";
  echo "\n\n( 1 ) Crear un nuevo teatro.";
  echo "\n( 2 ) Cambiar el nombre de un teatro.";
  echo "\n( 3 ) Cambiar la direccion de un teatro.";
  echo "\n( 4 ) Crear una nueva funcion";
  echo "\n( 5 ) Cambiar el nombre de una funcion";
  echo "\n( 6 ) Cambiar el precio de una funcion";
  echo "\n( 7 ) Cambiar el horario de inicio de una funcion";
  echo "\n( 8 ) Cambiar la duracion de una funcion";
  echo "\n( 9 ) Cambiar el director de una funcion musical";
  echo "\n( 10 ) Cambiar la cantidad de personas en escena de una funcion musical";
  echo "\n( 11 ) Cambiar el genero de una pelicula";
  echo "\n( 12 ) Cambiar el pais de origen de una pelicula";
  echo "\n( 13 ) Eliminar un teatro";
  echo "\n( 14 ) Eliminar una funcion";
  echo "\n( 15 ) Ver todos los teatros";
  echo "\n( 16 ) Ver todas las funciones ";
  echo "\n( 17 ) Ver los costos";
  echo "\n( 18 ) Salir\n\n";
  echo "\033[01;33m--------------------------------------------------------------\033[0m\n";
  echo "\033[01;33m--------------------------------------------------------------\033[0m\n";
  echo "Ingrese la opcion a elegir: ";
  do {
      $opcionElegida = trim(fgets(STDIN));
  } while ($opcionElegida >= 1 && $opcionElegida <= 18 && is_int($opcionElegida));
  return $opcionElegida;
}

function crearTeatro(){
  echo "\n----------- Creacion de un nuevo teatro -----------\n";
  do{
      echo "Ingrese el nombre del teatro: ";
      $nombreTeatro = trim(fgets(STDIN));
  } while ($nombreTeatro == "");
  do {
      echo "Ingrese la direccion del teatro: ";
      $direccionTeatro = trim(fgets(STDIN));
  } while ($direccionTeatro == "");
  $datosTeatro = 
      ["nombre" => $nombreTeatro,
      "direccion" => $direccionTeatro];
  $abmTeatro = new ABM_Teatro();
  if($abmTeatro->crearTeatroAbm($datosTeatro)){
      echo "Se creo el teatro correctamente.\n";
  }
  else {
      echo "No fue posible crear el teatro.\n";
  }
}


function cambiarNombreTeatro(){
  echo "\n\n----------- Cambiar nombre de un teatro -----------\n";
  $abmTeatro = new ABM_Teatro();
  echo "Ingrese el id del teatro al que le quiere cambiar el nombre: ";
  $idTeatro = trim(fgets(STDIN));
  $obj_teatro = $abmTeatro->seleccionarTeatro($idTeatro);
  if($obj_teatro->Buscar($idTeatro)) {
    echo "Ingrese el nuevo nombre del teatro: ";
    $nuevoNombre = trim(fgets(STDIN));
    if($abmTeatro->modificarNombreTeatro($obj_teatro, $nuevoNombre)){
      "Nombre cambiado correctamente.";
    };
  } else echo "No existe el teatro seleccionado."; 
}

function cambiarDireccionTeatro(){
  echo "\n----------- Cambiar direccion de un teatro -----------\n";
  $abmTeatro = new ABM_Teatro();
  echo "Ingrese el id del teatro al que le quiere cambiar el direccion: ";
  $idTeatro = trim(fgets(STDIN));
  $obj_teatro = $abmTeatro->seleccionarTeatro($idTeatro);
  if($obj_teatro->Buscar($idTeatro)) {
    echo "Ingrese el nuevo direccion del teatro: ";
    $nuevodireccion = trim(fgets(STDIN));
    if($abmTeatro->modificardireccionTeatro($obj_teatro, $nuevodireccion)){
      "direccion cambiado correctamente.";
    };
  } else echo "No existe el teatro"; 
}

function eliminarTeatro(){
  echo "\n----------- Eliminar un teatro -----------\n";
  echo "Ingrese el id del teatro al que le quiere eliminar: ";
  $abmTeatro = new ABM_Teatro();
  $idTeatro = trim(fgets(STDIN));
  // $obj_teatro = $abmTeatro->seleccionarTeatro($idTeatro);
  $obj_teatro = new Teatro();
  if($obj_teatro->Buscar($idTeatro)) {
    if($abmTeatro->eliminarTeatroAbm($obj_teatro)){
      echo "Funciones eliminadas correctamente.\n";
      echo "Teatro eliminado correctamente";
    }
    else{
      echo "No se elimino el teatro.\n";
    }
  } else echo "No se encontro el teatro.\n"; 
}

/* FUNCIONES */
function crearFuncion(){
  echo "\n----------- Creacion de una nueva funcion -----------\n";
  $obj_teatro = new Teatro();
  $abmTeatro = new ABM_Teatro();
  $abmFuncion = new ABM_Funcion();
  $abmFuncionTeatro = new ABM_Funcion_Teatro();
  $abmFuncionMusical = new ABM_Funcion_Musical();
  $abmFuncionCine = new ABM_Funcion_Cine();
  do {
    echo "Ingrese el id del teatro donde quiere agregar la nueva funcion: ";
    $idTeatro = trim(fgets(STDIN));
  } while (!$obj_teatro = $abmTeatro->seleccionarTeatro($idTeatro));
  $objTeatro = new Teatro();
  $objTeatro->Buscar($idTeatro);
  do{
      echo "Ingrese el nombre de la funcion: ";
      $nombreFuncion = trim(fgets(STDIN));
  } while ($nombreFuncion == "");
  do{
    do{
      $formatoHorarioCorrecto = false;
      echo "Ingrese el horario de inicio de la funcion ('hh:mm'): ";
      $horarioFuncion = trim(fgets(STDIN));
      if((preg_match("/^(?:[01]\d|2[0-3]):[0-5]\d$/", $horarioFuncion))){
          $formatoHorarioCorrecto = true;
      }
      else{
          echo "Ingrese un horario con el formato 'hh:mm.";
      }
    } while (!$formatoHorarioCorrecto);
    do{
      $esNum = false;
      echo "Ingrese la duracion de la funcion (en minutos): ";
      $duracionFuncion = trim(fgets(STDIN));
      if(is_numeric($duracionFuncion)){
          $esNum = true;
      }
      else{
          echo "Ingrese una duracion en minutos\n";
      }
    } while (!$esNum && $duracionFuncion < 1);
    $esHorarioDisponible = revisarDisponibilidadHorario($horarioFuncion, $duracionFuncion, $obj_teatro, null);
  }while($esHorarioDisponible == false);
  do{
    $esNum = false;
    echo "Ingrese el precio de la funcion: $";
    $precioFuncion = trim(fgets(STDIN));
    if (is_numeric($precioFuncion)) {
        $esNum = true;
    }
    else {
        echo "\033[00;31mPor favor ingrese un numero para el precio de la funcion.\033[0m\n";
    }
  } while (!$esNum);
  do{
    $exito = false;
    echo "Ingrese el tipo de funcion (teatro, musical, cine): ";
    $tipoFuncion = trim(fgets(STDIN));
    if($tipoFuncion == "teatro" || $tipoFuncion == "musical" || $tipoFuncion == "cine") {
        $exito = true;
    }
  } while(!($exito));
  $datosFuncion = [
    "nombre" => $nombreFuncion,
    "horariodeinicio" => $horarioFuncion,
    "duracion" => $duracionFuncion,
    "precio" => $precioFuncion,
    "objteatro" => $objTeatro
  ];
  switch($tipoFuncion){
    case "teatro":
      $abmFuncionTeatro->crearFuncionTeatroAbm($datosFuncion);
      break;
    case "musical":
      do {
        echo "Ingrese el director de la funcion musical: ";
        $datosFuncion["director"] = trim(fgets(STDIN));
      } while($datosFuncion["director"] == "");
      do {
          echo "Ingrese la cantidad de personas en escena: ";
          $datosFuncion["cantpersonasescena"] = trim(fgets(STDIN));
      } while($datosFuncion["cantpersonasescena"] < 0);
      $abmFuncionMusical->crearFuncionMusicalAbm($datosFuncion);
      break;
      case "cine":
        do {
          echo "Ingrese el genero de la pelicula: ";
          $datosFuncion["genero"] = trim(fgets(STDIN));
        } while($datosFuncion["genero"] == "");
        do {
            echo "Ingrese el pais de origen de la pelicula: ";
            $datosFuncion["paisorigen"] = trim(fgets(STDIN));
        } while($datosFuncion["paisorigen"] == "");

        $abmFuncionCine->crearFuncionCineAbm($datosFuncion);
        break;        
  } 
}

function revisarDisponibilidadHorario($horarioFun, $duracionFun, $objTeatro, $idFuncion){
  list($horaIn, $minutosIn) = explode(":", $horarioFun);
  $horaIn = $horaIn * 60;
  $minutosInicioFuncion = $horaIn + $minutosIn;
  $minutosFinFuncion = $minutosInicioFuncion + $duracionFun;
  $j = 0;
  $horarioDisponible = true;
  $arregloFun = $objTeatro->recuperarFunciones($objTeatro->getIdTeatro());
  if($arregloFun!=[]){
    do{
      if($arregloFun[$j]->getIdFuncion()!=$idFuncion){
        list($horaInAnt, $minutosInAnt) = explode(":", $arregloFun[$j]->getHorarioDeInicio());
        $horaInAnt = $horaInAnt * 60;
        $minutosInicioFuncionAnt = $horaInAnt + $minutosInAnt;
        $minutosFinalFuncionAnt = $minutosInicioFuncionAnt + $arregloFun[$j]->getDuracion();
        if(($minutosInicioFuncion < $minutosInicioFuncionAnt && $minutosFinFuncion < $minutosInicioFuncionAnt) || ($minutosInicioFuncion > $minutosFinalFuncionAnt && $minutosFinFuncion < $minutosInicioFuncionAnt) || ($minutosInicioFuncion > $minutosFinalFuncionAnt && $minutosFinFuncion > $minutosInicioFuncionAnt) && !(($minutosInicioFuncion > $minutosInicioFuncionAnt && $minutosInicioFuncion < $minutosFinalFuncionAnt) || ($minutosFinFuncion > $minutosInicioFuncionAnt && $minutosFinFuncion < $minutosFinalFuncionAnt))) {
            $horarioDisponible = true;
        }
        else {
            $horarioDisponible = false;
        }
      }
        $j++;
    } while($horarioDisponible == true && $j < count($arregloFun));
  }
  else {
    $horarioDisponible = true;
  }
  return $horarioDisponible;
}

// crearFuncion();


function cambiarNombreFuncion(){
  echo "\n----------- Cambiar nombre de una funcion -----------\n";
  $abmFuncion = new ABM_Funcion();
  $objFuncionnn = new Funcion();
  do{
    echo "Ingrese el id de la funcion a la que le quiere cambiar el nombre: ";
    $idFuncion = trim(fgets(STDIN));
  } while(!$objFuncionnn->buscar($idFuncion));
  $objFuncion = $abmFuncion->seleccionarFuncion($idFuncion);
  if($objFuncion->Buscar($idFuncion)) {
    echo "Ingrese el nuevo nombre de la funcion: ";
    $nuevoNombre = trim(fgets(STDIN));
    if($abmFuncion->modificarNombreFuncion($objFuncion, $nuevoNombre)){
      "Nombre cambiado correctamente.";
    };
  } else echo "No existe esa funcion"; 
}

// cambiarNombreFuncion();

function cambiarHorarioInicioFuncion(){
  echo "\n----------- Cambiar el horario de inicio de una funcion -----------\n";
  $abmFuncion = new ABM_Funcion();
  echo "Ingrese el id de la funcion a la que le quiere cambiar el horario de inicio: ";
  $idFuncion = trim(fgets(STDIN));
  $objFuncion = $abmFuncion->seleccionarFuncion($idFuncion);
  if($objFuncion->Buscar($idFuncion)) {

    do{
      do{
        $formatoHorarioCorrecto = false;
        echo "Ingrese el horario de inicio de la funcion ('hh:mm'): ";
        $horarioFuncion = trim(fgets(STDIN));
        if((preg_match("/^(?:[01]\d|2[0-3]):[0-5]\d$/", $horarioFuncion))){
            $formatoHorarioCorrecto = true;
        }
        else{
            echo "Ingrese un horario con el formato 'hh:mm.";
        }
      } while (!$formatoHorarioCorrecto);
      $duracionFuncion = $objFuncion->getDuracion();
      $teatro = new Teatro();
      $teatro->Buscar($objFuncion->getObjTeatro()->getIdTeatro());
      $esHorarioDisponible = revisarDisponibilidadHorario($horarioFuncion, $duracionFuncion, $teatro, $idFuncion);
    } while($esHorarioDisponible == false);
    if($abmFuncion->modificarHorarioInicioFuncion($objFuncion, $horarioFuncion)){
      echo "Horario cambiado correctamente.";
    }
  }
  else {
    echo "No existe esa funcion";   
  }  
}

function cambiarDuracionFuncion(){
  echo "\n----------- Cambiar la duracion de una funcion -----------\n";
  $abmFuncion = new ABM_Funcion();
  echo "Ingrese el id de la funcion a la que le quiere cambiar la duracion: ";
  $idFuncion = trim(fgets(STDIN));
  $objFuncion = $abmFuncion->seleccionarFuncion($idFuncion);
  if($objFuncion->Buscar($idFuncion)) {
    do{
      do{
        $esNum = false;
        echo "Ingrese la duracion de la funcion (en minutos): ";
        $duracionFuncion = trim(fgets(STDIN));
        if(is_numeric($duracionFuncion)){
            $esNum = true;
        }
        else{
            echo "Por favor ingrese una duracion en minutos, y mayor a 0 (ejemplo: 60).\n";
        }
      } while (!$esNum && $duracionFuncion < 1);
      $horarioInicioFuncion = $objFuncion->getHorarioDeInicio();
      $teatro = new Teatro();
      $teatro->Buscar($objFuncion->getObjTeatro()->getIdTeatro()());
      $esHorarioDisponible = revisarDisponibilidadHorario($horarioInicioFuncion, $duracionFuncion,$teatro, $idFuncion);
    } while($esHorarioDisponible == false);
    if($abmFuncion->modificarDuracionFuncion($objFuncion, $duracionFuncion)){
      echo "Horario cambiado correctamente.";
    }
    else {
      echo "Error.";
    }
  }
  else {
    echo "No existe esa funcion";   
  }  
}

function cambiarPrecioFuncion(){
  echo "\n----------- Cambiar precio de una funcion -----------\n";
  $abmFuncion = new ABM_Funcion();
  echo "Ingrese el id de la funcion a la que le quiere cambiar el precio: ";
  $idFuncion = trim(fgets(STDIN));
  $objFuncion = $abmFuncion->seleccionarFuncion($idFuncion);
  if($objFuncion->Buscar($idFuncion)) {
    echo "Ingrese el nuevo precio de la funcion: ";
    $nuevoPrecio = trim(fgets(STDIN));
    if($abmFuncion->modificarPrecio($objFuncion, $nuevoPrecio)){
      "Nombre cambiado correctamente.";
    };
  } else echo "No existe esa funcion"; 
}

// cambiarDirectorFuncionMusical();
function cambiarDirectorFuncionMusical(){
  echo "\n----------- Cambiar director de una funcion musical -----------\n";
  $abmFuncionMusical = new ABM_Funcion_Musical();
  echo "Ingrese el id de la funcion a la que le quiere cambiar el director: ";
  $idFuncion = trim(fgets(STDIN));
  $objFuncionMusical = new Funcion_Musical();
  if($objFuncionMusical->buscar($idFuncion)){
    echo "Ingrese el nuevo director de la funcion: ";
    $nuevoDirector = trim(fgets(STDIN));
    if($abmFuncionMusical->modificarDirectorMusical($objFuncionMusical, $nuevoDirector)){
      echo "Director del musical cambiado correctamente";
    } 
  }
  else{
    echo "No existe esa funcion, o es de un tipo distinto a musical";
  } 
}

// cambiarCantPersEscenaMusical();
function cambiarCantPersEscenaMusical(){
  echo "\n----------- Cambiar cantidad de personas en escena de una funcion musical -----------\n";
  $abmFuncionMusical = new ABM_Funcion_Musical();
  echo "Ingrese el id de la funcion a la que le quiere cambiar el cantidad de personas en escena: ";
  $idFuncion = trim(fgets(STDIN));
  $objFuncionMusical = new Funcion_Musical();
  if($objFuncionMusical->buscar($idFuncion)){
    echo "Ingrese la nueva cantidad: ";
    $nuevaCant = trim(fgets(STDIN));
    if($abmFuncionMusical->modificarCantPersEscenaMusical($objFuncionMusical, $nuevaCant)){
      echo "Cantidad cambiada correctamente";
    } 
  }
  else{
    echo "No existe esa funcion, o es de un tipo distinto a musical";
  } 
}  

//crearFuncion();
/* cambiarGeneroFuncionCIne */
//cambiarGeneroFuncionCine();
function cambiarGeneroFuncionCine(){
  echo "\n----------- Cambiar genero de una pelicula -----------\n";
  $abmFuncionCine = new ABM_Funcion_Cine();
  echo "Ingrese el id de la funcion a la que le quiere cambiar el genero: ";
  $idFuncion = trim(fgets(STDIN));
  $objFuncionCine = new Funcion_Cine();
  if($objFuncionCine->buscar($idFuncion)){
    echo "Ingrese el nuevo genero de la funcion: ";
    $nuevoGenero = trim(fgets(STDIN));
    if($abmFuncionCine->modificarGenero($objFuncionCine, $nuevoGenero)){
      echo "Genero de la pelicula cambiado correctamente";
    } 
  }
  else{
    echo "No existe esa funcion, o es de un tipo distinto a cine";
  }   
}

//cambiarPaisDeOrigenFuncionCine();
function cambiarPaisDeOrigenFuncionCine(){
  echo "\n----------- Cambiar pais de origen de una pelicula -----------\n";
  $abmFuncionCine = new ABM_Funcion_Cine();
  echo "Ingrese el id de la funcion a la que le quiere cambiar el pais de origen: ";
  $idFuncion = trim(fgets(STDIN));
  $objFuncionCine = new Funcion_Cine();
  if($objFuncionCine->buscar($idFuncion)){
    echo "Ingrese el nuevo pais de origen de la funcion: ";
    $nuevoPaisOrigen = trim(fgets(STDIN));
    if($abmFuncionCine->modificarPaisDeOrigen($objFuncionCine, $nuevoPaisOrigen)){
      echo "Pais de origen de la pelicula cambiado correctamente";
    } 
  }
  else{
    echo "No existe esa funcion, o es de un tipo distinto a cine";
  }   
}

function eliminarFuncion(){
  $abmFuncion = new ABM_Funcion();
  $abmFuncionMusical = new ABM_Funcion_Musical();
  $abmFuncionTeatro = new ABM_Funcion_Teatro();
  $abmFuncionCine = new ABM_Funcion_Cine();
  $objFuncion = new Funcion();
  $objFuncionTeatro = new Funcion_Teatro();
  $objFuncionMusical = new Funcion_Musical();
  $objFuncionCine = new Funcion_Cine();
  if($objFuncion->listar()!=[]){
    echo "\n----------- Eliminar una funcion -----------\n";
    echo "\nIngrese el id de la funcion que quiere eliminar: ";
    $idFuncion = trim(fgets(STDIN));
    $funcion = $abmFuncion->seleccionarFuncion($idFuncion);
    // print_r($objFuncion);
    if ($objFuncionMusical->buscar($idFuncion)) {
      // echo "true para musical";
      if($abmFuncionMusical->eliminarFuncionMusicalAbm(($objFuncionMusical))){
        if($abmFuncion->eliminarFuncionAbm($funcion)){
          echo "Funcion eliminada";
        }
      }
    }
    else if ($objFuncionTeatro->buscar($idFuncion)) {
      // echo "true para teatro";
      if($abmFuncionTeatro->eliminarFuncionTeatroAbm(($objFuncionTeatro))){
        if($abmFuncion->eliminarFuncionAbm($objFuncion)){
          echo "Funcion eliminada";
        }
      }
    }
    else if ($objFuncionCine->buscar($idFuncion)) {
      // echo "true para cine";
      if($abmFuncionCine->eliminarFuncionCineAbm(($objFuncionCine))){
        if($abmFuncion->eliminarFuncionAbm($funcion)){
          echo "Funcion eliminada";
        }
      }
    }
  }
  else {
    echo "No hay funciones para eliminar";
  }
}

function darCostosTest(){
  $objTeatro = new Teatro();
  if($objTeatro->listar()!=[]){
    echo "\n----------- Ver los costos del teatro -----------\n";
    do {
      echo "Ingrese el id del teatro donde quiere agregar la nueva funcion: ";
      $idTeatro = trim(fgets(STDIN));
    } while (!$objTeatro->buscar($idTeatro));
    $objTeatro->Buscar($idTeatro);
  
    $costos = $objTeatro->darCostos();
    echo $costos;
  }
  else {
    echo "No hay teatros en el sistema";
  }
}
