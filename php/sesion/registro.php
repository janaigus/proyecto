<?php
    // Requerir el fichero para la conexion con la base de datos 
    // IMPORTANTE CAMBIAR el fichero de la BD local por el de la BD del hosting
    session_start();
    require('../bd/conexionBDlocal.php');
    $db = conectaDb();
    $consulta = "SELECT * FROM usuarios where email=:email";
    $result = $db->prepare($consulta);
    $result->execute(array(":email" => $_POST['registroEmail']));

    // Si no hay resultados continuar con el insert
    if($result->rowCount() != 0){
        $consulta = "INSERT INTO usuarios(email, nick, nombre, apellidos, password, idrol, idmunicipio)
            VALUES(:mail, :alias, :name, :sname, :pass, :rol, :mun)";
        $result  = $db->prepare($consulta);
        $resultado = $result->execute(array(
            "mail" => $_POST['registroEmail'],
            "alias" => strtolower(substr($_POST['registroNombre'], 0, 2).substr($_POST['registroApellidos'], 0, 2)),
            "name" => $_POST['registroNombre'],
            "sname" => $_POST['registroApellidos'],
            "pass" => $_POST['registroPassword'],
            "rol" => 2,
            "mun" => $_POST['registroMunicipios']
        ));
        if($resultado){
            echo "OK";
        }
    }else{
        // El email ya está registrado y NO puede ser insertado
        echo "REGISTEREDUSER";
        
    }
?>