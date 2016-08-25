<?php
/*
$dbhost='127.0.0.1';
$dbuser='root';
$dbpass='220593';
$conn = mysql_connect($dbhost,$dbuser,$dbpass);
$db = mysql_select_db('backup_articulos_web_publicacion');
*/

$dbhost='190.7.26.28'; //'pc24cys.dyndns.org';
$dbuser='remoto';
$dbpass='cmc2012';
$conn = mysql_connect($dbhost,$dbuser,$dbpass);
$db = mysql_select_db('pg_pharmad', $conn);

?>