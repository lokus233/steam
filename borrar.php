<?php session_start() ?>
<?php

require 'auxiliar.php';
if (!comprobar_login()){
    return;
   }

if($_SESSION['nick'] != 'admin'){
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
}

header('Location: index.php');
