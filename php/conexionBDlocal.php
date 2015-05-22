<?php
$usuario = "proyecto";
$contraseña = "123456789";
try {
    $mbd = new PDO('mysql:host=localhost;dbname=helptoknow', $usuario, $contraseña);
} catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
}
?>