<?php

require_once 'AppController.php';

class DefaultController extends AppController
{
    public function index()
    {
        if (!isset($_SESSION['user'])) {
            return $this->render('login');
        }

        (new BooksController)->homepage();
    }

    public function error()
    {
        return $this->render('error');
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