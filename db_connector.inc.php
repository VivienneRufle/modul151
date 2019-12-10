<?php
$host = 'localhost'; // host
$username = 'supportForum'; // username
$password = '-.g1bm#2019.-'; // password
$database = 'supportForum'; // database

// mit Datenbank verbinden
$mysqli = new mysqli($host, $username, $password, $database);

// fehlermeldung, falls verbindung fehl schlägt.
if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_error . ') ' . $mysqli->connect_error);
}

?>