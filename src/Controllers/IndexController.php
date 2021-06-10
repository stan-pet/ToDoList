<?php

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class IndexController
{

    public function twigRender($template, array $options) {

        $loader = new FilesystemLoader('templates');
        $twig = new Environment($loader);

        return $twig->render($template);
    }

    public function index()
    {
        echo $this->twigRender('startpage.html.twig', []);
    }

    public function create()
    {
        echo $this->twigRender('add.html.twig', []);
    }

    public function update()
    {
        echo $this->twigRender('update.html.twig', []);
    }

}