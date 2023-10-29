<?php

require_once "../RequiresOnce/General.php";



    $usuario=$_POST['usuario'];
    $nombre=$_POST['nombre'];
    $contrasenna=$_POST['contrasenna'];
    $rcontrasenna=$_POST['rcontrasenna'];

    if(empty($usuario)){
        redireccionar('Registro.php?error=El usuario es requerido');
        exit();
    }elseif (empty($nombre)){
        redireccionar('Registro.php?error=El nombre es requerido');
        exit();
    }elseif (empty($contrasenna)){
        redireccionar('Registro.php?error=La contraseña es requerida');
        exit();
    }elseif(empty($rcontrasenna)){
        redireccionar('Registro.php?error=Repetir la contraseña es requerido');
        exit();
    }elseif ($contrasenna != $rcontrasenna){
        redireccionar('Registro.php?error=La contraseña no coincide');
        exit();
    }else{

        if($usuario = DAO::usuarioCrear($nombre,$usuario, $contrasenna)){
            redireccionar('Registro.php?success="Usuario creado correctamente"');
        }else{
            redireccionar('Registro.php?error="Error al registrarse"');
        }


    }

?>
