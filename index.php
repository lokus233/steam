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
    require_once 'auxiliar.php';
    require_once 'Cliente.php';
    
    if(!comprobar_login()){
        return;
    }

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
            <?php foreach (Cliente::todos() as $cliente): ?>
            <tr>
                <td><?= hh($cliente->dni) ?></td>
                <td><?= hh($cliente->nombre) ?></td>
                <td><?= hh($cliente->apellidos) ?></td>
                <td><?= hh($cliente->direccion) ?></td>
                <td><?= hh($cliente->codpostal) ?></td>
                <td><?= hh($cliente->telefono) ?></td>
                <td>
                    <form action="borrar.php" method="post" >
                        <?php campo_csrf() ?>
                        <input type="hidden" name="id" value="<?=hh($cliente->id)?>">
                        <button type="submit"> "borrar" </button>
            </form>
                </td>
                <td>
                    <a href="modificar.php?id=<?=hh($cliente->id)?>">modificar</a>
                </td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    
    <a href="insertar.php"> Insertar un nuevo cliente </a>
</body>
</html>