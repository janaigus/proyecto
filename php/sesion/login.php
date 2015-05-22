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
        echo $userContra;
        //Si la contraseña del usuario coincide
        if(crypt($passwordI, $userContra) == $userContra){
            $_SESSION['usuario'] = $arrayResult[0]['email'];
            $_SESSION['fecha'] = date("Y-n-j H:i:s");
            echo "OK";
        }else
            echo "BADPASS";
    }else
        echo "BADEMAIL";
?>