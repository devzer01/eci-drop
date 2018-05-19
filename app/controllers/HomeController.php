<?php namespace app\controllers;

class HomeController extends \SlimController\SlimController
{
    public function indexAction()
    {
        $this->render('home/index');
    }
}
