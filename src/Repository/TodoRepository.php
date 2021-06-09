<?php

namespace Repository;

use OutOfBoundsException;
use \PDO;
use MyApp\Database\Database;



class TodoRepository
{

    public function fetch()
    {
        $db = new Database();
        $arr = [];
        $sql = "SELECT * FROM tasks ORDER BY date_created DESC";

        if ($result = $db->connect()->query($sql)) {
            if ($result->rowCount() > 0) {
                while($row = $result->fetch()){
                    $arr[] = $row;

                    /*
                     * echo $twig->render('list.html.twig',
                    ['id' => $arr[0]['id'],
                      'title' => $arr[0]['title'],
                      'description' => $arr[0]['description'],
                      'date_created' => $arr[0]['date_created']
                    ]);
                     * */
                }
            }
        }
        echo json_encode($arr);
    }

    public function create() {

        $db = new Database();

        $title = $_POST['title'];
        $description = $_POST['description'];
        $date_created = date('Y-m-d H:i:s');

        $sql = "INSERT INTO tasks (title, description, date_created) VALUES ($title, $description, $date_created)";
        $result = $db->connect()->query($sql);
        $result->execute();

        if ($result) {
            echo json_encode("Success");
        } else {
            echo json_encode("Not Success");
        }

    }

    public function update($id)
    {
        $query = 'UPDATE tasks SET title=:title, description=:description, date_created=:date_created WHERE id=:id';
        $statement = $this->pdo->prepare($query);

        if ($statement->rowCount() === 0) {
            throw new OutOfBoundsException();
        }
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        return $row;
    }

    public function delete($id)
    {
        static $query = 'DELETE FROM tasks WHERE id = :id ';
        $statement = $this->pdo->prepare($query);

        if ($statement->rowCount() === 0) {
            throw new OutOfBoundsException();
        }
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        return $row;
    }
}