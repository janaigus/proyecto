<?php
    // Requerir el fichero para la conexion con la base de datos 
    require('../bd/conexionBDlocal.php');
    $db = conectaDb();
    $idcentro = (isset($_POST['idcentro'])) ? $_POST['idcentro'] : "";
    if($_POST['comando'] == "editar"){
        $consulta = 'UPDATE  centroseducativos SET ';
        $consulta .= 'nombre = :nombre, ';
        $consulta .= 'longitud = :longitud, ';
        $consulta .= 'latitud = :latitud, ';
        $consulta .= 'informacion = :info, ';
        $consulta .= 'idisla = :isla ';
        $consulta .= 'WHERE id = '.$idcentro;
        $result = $db->prepare($consulta);
        $resultado = $result->execute(array(':nombre' => $_POST['nombre'],
                                            ':longitud' => $_POST['longitud'],
                                            ':latitud' => $_POST['latitud'],
                                            ':info' => $_POST['info'],
                                            ':isla' => $_POST['isla']
                                           ) );
        if($resultado == 1){
            echo "OK";
        }else{
            echo "BAD";
        }
    }else{
        if($_POST['comando'] == "borrar"){            
            // Borrar las categorias 
            $consulta = "DELETE FROM centroseducativos WHERE id = :centro";
            $result = $db->prepare($consulta);
            $result->bindParam(":centro", $idcentro, PDO::PARAM_STR);
            $resultado = $result->execute();
            if($resultado == 1){
                echo "OK";
            }else{
                echo "BAD";
            }
        }else{
            if($_POST['comando'] == "agregar"){
                // Comenzar borrando los votos
                $consulta = "INSERT INTO auxcategorias (nombre, longitud, latitud, informacion, idisla) ";
                $consulta .= "VALUES (:nombre, :longitud, :latitud, :informacion, :isla)";
                $result = $db->prepare($consulta);
                $result->bindParam(":nombre", $_POST['nombre'], PDO::PARAM_STR);
                $result->bindParam(":longitud", $_POST['longitud'], PDO::PARAM_STR);
                $result->bindParam(":latitud", $_POST['latitud'], PDO::PARAM_STR);
                $result->bindParam(":informacion", $_POST['informacion'], PDO::PARAM_STR);
                $result->bindParam(":isla", $_POST['isla'], PDO::PARAM_STR);
                $resultado = $result->execute();
                if($resultado == 1){
                    header ('Location: ../paginas/administrador.php#centroseducativos');
                }
            }
        }
    }
?>