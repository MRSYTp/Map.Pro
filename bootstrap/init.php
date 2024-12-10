<?php
    include "constants.php";
    include MAP_PATH ."bootstrap/config.php";
    include MAP_PATH ."libs/helpers.php";
    // include MAP_PATH ."vendor/autoload.php";

    // var_dump($config_database);
try {
    $conn = new PDO("mysql:host=$config_database->host;dbname=$config_database->db", $config_database->user,$config_database->pass);
} catch (PDOException $e) {
     echo "ERROR!";
     die();
}