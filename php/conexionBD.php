<?php
$usuario = "u135108308_h2k";
$contraseña = "i3fEcTLjB8";
try {
    $mbd = new PDO('mysql:host=localhost;dbname=u135108308_h2k', $usuario, $contraseña);
} catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
}
?>