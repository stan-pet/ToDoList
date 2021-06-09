<?php
require __DIR__ . '/vendor/autoload.php';

if (isset($_POST['list'])) {

    $index = new \Repository\TodoRepository();
    $index->fetch();
}
if (isset($_POST['insert'])) {

    $index = new \Repository\TodoRepository();
    $index->create();
}

