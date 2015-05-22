<?php
function conectaDb()
{
    try {
        $db = new PDO('mysql:host=localhost;dbname=helptoknow;charset=utf8', 'proyecto', '123456789');
        $db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
        return($db);
    } catch(PDOException $e) {
        print "<p>Error: " . $e->getMessage() . "</p>\n";
    }
}
?>