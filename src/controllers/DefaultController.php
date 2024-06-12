<?php

require_once 'AppController.php';

class DefaultController extends AppController
{
    public function index()
    {
        $this->render('login');
    }

    public function homepage()
    {
        $this->render('homepage');
    }

    public function bookmarks() {
        $this->render('bookmarks');
    }

    public function account() {
        $this->render('account');
    }

    public function search() {
        $this->render('search');
    }

}