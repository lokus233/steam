<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>
</head>
<body>
    <?php
    require 'auxiliar.php';
    if(!comprobar_login()){
        return;
    }
    $pdo = conectar();
    $sent = $pdo->query('SELECT * FROM clientes');
    ?>
    <?php cabecera() ?>
    <table border="1">
        <thead>
            <th>DNI</th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Dirección</th>
            <th>Código Postal</th>
            <th>Teléfono</th>
            <th>Acciones</th>
            <th colspan="2"> Modificar </th>
        </thead>
        <tbody>
            <?php foreach ($sent as $fila): ?>
            <tr>
                <td><?= hh($fila['dni']) ?></td>
                <td><?= hh($fila['nombre']) ?></td>
                <td><?= hh($fila['apellidos']) ?></td>
                <td><?= hh($fila['direccion']) ?></td>
                <td><?= hh($fila['codpostal']) ?></td>
                <td><?= hh($fila['telefono']) ?></td>
                <td>
                    <form action="borrar.php" method="post" >
                        <input type="hidden" name="id" value="<?=hh($fila['id'])?>">
                        <button type="submit"> "borrar" </button>
            </form>
                </td>
                <td>
                    <a href="modificar.php?id=<?=hh($fila['id'])?>">modificar</a>
                </td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <?php
    $sent = $pdo->query('SELECT * FROM juegos');
    ?>
    <table border="1">
        <thead>
            <th>titulos</th>
            <th>genero</th>
            <th>precio</th>
        </thead>
        <tbody>
            <?php foreach ($sent as $fila): ?>
            <tr>
                <td><?= hh($fila['titulo']) ?></td>
                <td><?= hh($fila['genero']) ?></td>
                <td><?= hh($fila['precio']) ?></td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <br>
    <a href="insertar.php"> Insertar un nuevo cliente </a>
</body>
</html>