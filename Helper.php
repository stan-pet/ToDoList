<?php
require __DIR__ . '/vendor/autoload.php';

if (isset($_POST['list'])) {

    $index = new \Repository\TodoRepository();
    $index->fetch();
}
if (isset($_POST['insert'])) {

    $title = $_POST['title'];
    $description = $_POST['description'];

    $index = new \Repository\TodoRepository();
    $index->create($title, $description);
}
if (isset($_POST['update'])) {

    $id = $_POST['id'];

    $index = new \Repository\TodoRepository();
    $index->update($id);
}
if (isset($_POST['saveUpdate'])) {

    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    $index = new \Repository\TodoRepository();
    $index->saveUpdate($id, $title, $description);
}

if (isset($_POST['delete'])) {

    $id = $_POST['id'];

    $index = new \Repository\TodoRepository();
    $index->delete($id);
}

