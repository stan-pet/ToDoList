<?php

namespace Repository;

use OutOfBoundsException;
use \PDO;
use MyApp\Database\Database;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class TodoRepository
{
    private $db = null;
    private $loader;
    private $twig;

    public function __construct() {
        $this->db = new Database();

        $this->loader = new FilesystemLoader('templates');
        $this->twig = new Environment($this->loader);
    }

    /**
     * @return array
     */
    public function fetch()
    {

        $sql = "SELECT * from tasks ORDER BY date_created DESC";

        $stmt = $this->db->connect()->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        $stmt->execute();

        $results = $stmt->fetchAll();

        echo $this->twig->render('list.html.twig',
            [
                'results' => $results
            ]);

    }

    /**
     * @param string $title
     * @param string $description
     * @return string
     */
    public function create(string $title, string $description) {

        $date_created = date('Y-m-d H:i:s');

        $sql = "INSERT INTO tasks (title, description, date_created) VALUES (?, ?, ?)";
        $result = $this->db->connect()->prepare($sql);
        $result->execute([$title, $description, $date_created]);

        if ($result) {
            echo json_encode("Record was successfully added");
        } else {
            echo json_encode("Error. Try again!");
        }

    }

    /**
     * @param int $id
     * @return array
     */
    public function update(int $id)
    {
        $loader = new FilesystemLoader('templates');
        $twig = new Environment($loader);

        $sql = "SELECT * FROM tasks WHERE id =:id";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $results = $stmt->fetchAll();

        echo $twig->render('update.html.twig',
        [
            'results' => $results
        ]);
    }

    /**
     * @param int $id
     * @param string $title
     * @param string $description
     * @return string
     */
    public function saveUpdate(int $id, string $title, string $description)
    {
        $sql = "UPDATE tasks SET title = :title, description = :description WHERE id = :id";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->execute();

        return true;

    }

    /**
     * @param int $id
     */
    public function delete(int $id)
    {

        $sql = "DELETE FROM tasks WHERE id =:id";
        $result = $this->db->connect()->prepare($sql);
        $result->bindParam(':id', $id);
        $result->execute();

        if ($result) {
            echo json_encode("Success !!!!  " . $id);
        } else {
            echo json_encode("Not Success");
        }
    }
}


