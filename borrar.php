<?php session_start() ?>
<?php

require_once 'auxiliar.php';
require_once 'Cliente.php';
if (!comprobar_login()){
    return;
   }

if($_SESSION['nick'] != 'admin'){
    $_SESSION['fallo'] = 'No tiene permiso para borrar un cliente';
    return volver();
}

// $id = trim($_POST['id']);
$_csrf = obtener_post('_csrf');
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);

if(isset($id, $_csfr)){
    if(!comprobar_csrf($_csfr)){
        return volver();
    }
    Cliente::buscar_por_id($id);//INTENTO borrarlo, si hay nulo pues no se borra.
    $_SESSION['exito'] = 'El cliente se ha borrado correctamente';
}

header('Location: index.php');
