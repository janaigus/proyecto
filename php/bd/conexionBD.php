<?php
function conectaDb()
{
    try {
        $db = new PDO('mysql:host=localhost;dbname=u135108308_h2k;charset=utf8', 'u135108308_h2k', 'i3fEcTLjB8');
        $db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
        return($db);
    } catch(PDOException $e) {
        print "<p>Error: " . $e->getMessage() . "</p>\n";
    }
}
?>
