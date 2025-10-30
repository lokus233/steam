<?php session_start() ?>
<?php

require_once 'auxiliar.php';
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
    $pdo = conectar();
    $sent = $pdo->prepare("DELETE FROM clientes WHERE id = :id"); /* el :id es un marcador */
    $sent->execute([':id' => $id]);
    $_SESSION['exito'] = 'El cliente se ha borrado correctamente';
}

header('Location: index.php');
