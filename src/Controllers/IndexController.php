<?php

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use MyApp\Database\Database;

class IndexController
{
    public function __construct()
    {

    }

    public function index()
    {
        $loader = new FilesystemLoader('templates');
        $twig = new Environment($loader);

        echo $twig->render('startpage.html.twig', []);
    }

    public function create()
    {
        $loader = new FilesystemLoader('templates');
        $twig = new Environment($loader);

        echo $twig->render('add.html.twig', []);
    }

}