<?php
    // Requerir el fichero para la conexion con la base de datos 
    // IMPORTANTE CAMBIAR el fichero de la BD local por el de la BD del hosting
    session_start();
    require('../bd/conexionBDlocal.php');
    $db = conectaDb();
    $consulta = "SELECT * FROM usuarios where email=:email";
    $result = $db->prepare($consulta);
    $result->execute(array(":email" => $_POST['entrarEmail']));
    //Cuando haya un resultado segun el correo electronico
    if($result->rowCount() > 0){
        $arrayResult = $result->fetchAll();
        $userContra = $arrayResult[0]['password'];
        //Si la contraseña del usuario coincide, crear sesiones y redirigir a su página
        if(md5(md5(md5($_POST['entrarPass']))) == $userContra){
            $_SESSION['idh2k'] = $arrayResult[0]['id'];
            $_SESSION['nickh2k'] = $arrayResult[0]['nick'];
            $_SESSION['nombreh2k'] = $arrayResult[0]['nombre'];
            $_SESSION['rolh2k'] = $arrayResult[0]['idrol'];
            $_SESSION['municipioh2k'] = $arrayResult[0]['idmunicipio'];
            $_SESSION['islah2k'] = $arrayResult[0]['idisla'];
            $_SESSION['emailh2k'] = $arrayResult[0]['email'];
            $_SESSION['tiempoh2k'] = date("Y-n-j H:i:s");
            echo "OK";
        }else
            echo "BADPASS";
    }else
        echo "BADEMAIL";
?>