<?php

require_once "../RequiresOnce/_Varios.php";
require_once "../RequiresOnce/_Clases.php";
require_once "../RequiresOnce/_DAO.php";



    $usuario=$_POST['usuario'];
    $nombre=$_POST['nombre'];
    $contrasenna=$_POST['contrasenna'];
    $rcontrasenna=$_POST['rcontrasenna'];

    if(empty($usuario)){
        redireccionar('RegistroComprobar.php?error=El usuario es requerido');
        exit();
    }elseif (empty($nombre)){
        redireccionar('RegistroComprobar.php?error=El nombre es requerido');
        exit();
    }elseif (empty($contrasenna)){
        redireccionar('RegistroComprobar.php?error=La contraseña es requerida');
        exit();
    }elseif(empty($rcontrasenna)){
        redireccionar('RegistroComprobar.php?error=Repetir la contraseña es requerido');
        exit();
    }elseif ($contrasenna != $rcontrasenna){
        redireccionar('RegistroComprobar.php?error=La contraseña no coincide');
        exit();
    }else{

        if($usuario = DAO::usuarioCrear($nombre,$usuario, $contrasenna)){
            redireccionar('Registro.php?success="Usuario creado correctamente"');
        }else{
            redireccionar('Registro.php?error="Error al registrarse"');
        }


    }

?>
