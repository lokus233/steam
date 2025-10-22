<?php

function conectar()
{
    return new PDO('pgsql:host=localhost;dbname=steam', 'steam', '1234');
}
 function obtener_post(string $par): ?string
{
    return isset($_POST[$par]) ? trim($_POST[$par]): null;
}

function volver(){
    header('Location: index.php');
}

function validar_dni($dni, &$error){
    if($dni === '') {
            $error[] = 'El DNI es obligatorio';    
        }elseif(mb_strlen($dni) > 9){
                $error[] = 'El DNI es demasiado largo';
        }else{
                $pdo = conectar();
                $sent = $pdo->prepare('SELECT * FROM clientes WHERE dni = :dni');
                $sent->execute([':dni' => $dni]);
                if($sent->fetch()){
                    $error[] = 'Ya existe un cliente con ese DNI';
                }
            }
};

function validar_nombre($nombre, &$error){
    if($nombre === '') {
            $error[] = 'El nombre es obligatorio';    
        }elseif(mb_strlen($nombre) > 255){
                $error[] = 'El nombre es demasiado largo';
        }else{
                //Comprobar qeu es único
            }
};


function validar_sanear_apellidos($apellidos, &$error){
    if($apellidos === ''){
        $apellidos = null;
    }
    elseif(mb_strlen($apellidos) > 255) {
            $error[] = 'El apellidos es obligatorio';    
        
}};


function validar_sanear_direccion($direccion, &$error){
    if($direccion === ''){
        $direccion = null;
    }
    elseif(mb_strlen($direccion) > 255) {
            $error[] = 'La dirección es obligatorio';    
        
}};

function validar_sanear_codpostal($codpostal, &$error)
{
    if($codpostal === ''){
        $codpostal = null;
    }else if(!ctype_digit($codpostal)){
        $error[] = 'EL código postal no es válido';
    }elseif (mb_strlen($codpostal) > 5){
        $error[]='El código postal es demasiado largo';
    }
};


function validar_sanear_telefono($telefono, &$error){
    if($telefono === ''){
        $telefono = null;
    }
    elseif (mb_strlen($telefono) > 255){
        $error[] = 'El telegono es demasiado largo';
    }
};