<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/Book.php';
require_once __DIR__.'/../repository/BookRepository.php';
class BooksController extends AppController
{
    private $bookRepository;

    public function __construct()
    {
        parent::__construct();
        $this->bookRepository = new BookRepository();
    }

    public function homepage()
    {
        if (!$this->isGet()) {
            return $this->render('homepage');
        }

        $books = $this->bookRepository->getBooks();
        return $this->render('homepage', ['books' => $books]);
    }
}