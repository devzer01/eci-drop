<?php namespace app\controllers;

class HomeController extends \SlimController\SlimController
{
    public function indexAction()
    {
        $deadline = $this->request()->get('deadline', date("Y-m-d H:i:s", strtotime("+24 hours")));
        $this->render('home/index', ['deadline' => $deadline]);
    }
}
