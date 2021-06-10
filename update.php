<?php
require_once "config/Database.php";

use MyApp\Database\Database;

        $db = new Database();
        $id = $_POST['id'];

        $sql = "SELECT * FROM tasks WHERE id =:id";
        $result = $db->connect()->prepare($sql);
        $result->bindParam(':id', $id);
        $result->execute();

        $results = $result->fetchAll();

if ($result) {
       echo json_encode("Success");
} else {
       echo json_encode("Not Success");
}

?>
