<?php

require __DIR__ . '/vendor/autoload.php';
require_once "config/Database.php";

$app = new IndexController();
$app->create();