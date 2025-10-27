<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar nuevo cliente</title>
</head>
<body>
    <?php

   require 'auxiliar.php';

   if(!comprobar_login()){
        return;
   }

   token_csrf();
   
    $_csfr     = obtener_post('_csfr');
    $dni       = obtener_post('dni');
    $nombre    = obtener_post('nombre');
    $apellidos = obtener_post('apellidos');
    $direccion = obtener_post('direccion');
    $codpostal = obtener_post('codpostal');
    $telefono  = obtener_post('telefono');

    if(isset($dni,$_csfr, $nombre, $apellidos, $direccion, $codpostal, $telefono)){
        // Validación
         if (!comprobar_csrf($_csfr)){
        return volver();
    }
        $pdo = conectar();
        $pdo->beginTransaction();
        $pdo->exec('LOCK TABLE clientes IN SHARE MODE;');
        $error = [];
        validar_dni($dni ,$error, $pdo );
        validar_nombre($nombre, $error);
        validar_sanear_apellidos($apellidos, $error);
        validar_sanear_direccion($direccion, $error);
        validar_sanear_codpostal($codpostal, $error);
        validar_sanear_telefono($telefono,$error);

        if(empty($error)){
        $sent = $pdo->prepare('INSERT INTO clientes (dni, nombre, apellidos, direccion, codpostal, telefono)
                               VALUES (:dni, :nombre, :apellidos, :direccion, :codpostal, :telefono)');
        $sent->execute([
            ':dni' => $dni,
            ':nombre' => $nombre,
            ':apellidos' => $apellidos,
            ':direccion' => $direccion,
            ':codpostal' => $codpostal,
            ':telefono' => $telefono,
        ]);
        $pdo->commit();
        return volver();
        }else {
            $pdo->rollBack();
            cabecera();
            mostrar_errores($error);
        }
    }else{
        cabecera();
    }
    ?>
    <form action="" method="post">
        <?php campo_csrf() ?>
        <label for="dni">DNI:*</label>
        <input type="text"    id="dni"          name="dni"  value="<?= hh($dni) ?> " ><br>
        <label for="nombre">NOMBRE:*</label>
        <input type="text"    id="nombre"       name="nombre"  value="<?= hh($nombre) ?> " ><br>
        <label for="apellidos">APELLIDOS:</label>
        <input type="text"    id="apellidos"    name="apellidos" value="<?= hh($apellidos) ?> " ><br>
        <label for="dirección">DIRECCIÓN:</label>
        <input type="text"    id="direccion"    name="direccion" value="<?= hh($direccion) ?> " ><br>
        <label for="codpostal">CÓDIGO POSTAL:*</label>
        <input type="text"    id="codpostal"    name="codpostal" value="<?= hh($codpostal) ?> " ><br>
        <label for="telefono">TELÉFONO:</label>
        <input type="text"    id="telefono"    name="telefono"  value="<?= hh($telefono) ?> " ><br>
        <button type="submit">Insertar</button>
        <a href="index.php">Volver</a>
    </form>

</body>
</html>