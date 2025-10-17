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

    $dni       = obtener_post('dni');
    $nombre    = obtener_post('nombre');
    $apellidos = obtener_post('apellidos');
    $direccion = obtener_post('direccion');
    $codpostal = obtener_post('codpostal');
    $telefono  = obtener_post('telefono');

    if(isset($dni, $nombre, $apellidos, $direccion, $codpostal, $telefono)){
        // Validación
        $error = [];
        validar_dni($dni, $error);
        validar_nombre($nombre, $error);
        validar_sanear_apellidos($apellidos, $error);
        validar_sanear_direccion($direccion, $error);
        validar_sanear_codpostal($codpostal, $error);
        validar_sanear_telefono($telefono,$eror);

        if(empty($error)){
        
        $pdo = conectar();
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
        return volver();
        }}
    ?>
    <form action="" method="post">
        <label for="dni">DNI:*</label>
        <input type="text"    id="dni"          name="dni"><br>
        <label for="nombre">NOMBRE:*</label>
        <input type="text"    id="nombre"       name="nombre"><br>
        <label for="apellidos">APELLIDOS:</label>
        <input type="text"    id="apellidos"    name="apellidos"><br>
        <label for="dirección">DIRECCIÓN:</label>
        <input type="text"    id="direccion"    name="direccion"><br>
        <label for="codpostal">CÓDIGO POSTAL:*</label>
        <input type="text"    id="codpostal"    name="codpostal"><br>
        <label for="telefono">TELÉFONO:</label>
        <input type="text"    id="telefono"    name="telefono"><br>
        <button type="submit">Insertar</button>
    </form>

</body>
</html>