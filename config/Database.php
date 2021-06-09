<?php

namespace MyApp\Database;

use \PDO;
use PDOException;

class Database {

    function connect(){
        $config = include('environment.php');

        try {
            $conn = new PDO("mysql:host=$config->host; dbname=$config->dbName", $config->user, $config->pass);
            $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        }
        catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }
}
?>