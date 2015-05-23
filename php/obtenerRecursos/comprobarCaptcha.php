<?php
echo file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=6LecTAcTAAAAAKg7meG4TT6RWFKD8i4jox9WlsEA&response='.$_POST['respuesta'].'&remoteip='.$_SERVER['REMOTE_ADDR']);
?>