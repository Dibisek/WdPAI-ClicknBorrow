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

    public function bookDetails()
    {
        if (!$this->isGet()) {
            return $this->render('bookDetails');
        }

        $id = $_GET['id'];

        $book = $this->bookRepository->getBookById($id);
        return $this->render('bookDetails', ['book' => $book]);
    }
}