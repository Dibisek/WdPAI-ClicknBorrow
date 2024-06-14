<?php

require_once 'AppController.php';
require_once __DIR__.'/../repository/BookRepository.php';
require_once __DIR__.'/../repository/CategoryRepository.php';
require_once __DIR__.'/../repository/AuthorRepository.php';
require_once __DIR__.'/../models/Book.php';
require_once __DIR__.'/../models/Category.php';
require_once __DIR__.'/../models/Author.php';
class BooksController extends AppController
{
    private $bookRepository;
    private $categoryRepository;
    private $authorRepository;

    public function __construct()
    {
        parent::__construct();
        $this->bookRepository = new BookRepository();
        $this->categoryRepository = new CategoryRepository();
        $this->authorRepository = new AuthorRepository();
    }

    public function homepage()
    {
        if (!$this->isGet()) {
            return $this->render('homepage');
        }

        $books = $this->bookRepository->getBooksAlphabetically();
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

    public function filterBooks()
    {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            header('Content-type: application/json');
            http_response_code(200);
            $title = $decoded['title'];
            $category = $decoded['category'];
            $author = $decoded['author'];
            echo json_encode($this->bookRepository->getBooks($title, $category, $author));
        }
    }

    public function search()
    {
        if (!$this->isGet()) {
            return $this->render('search');
        }

        $authors = $this->authorRepository->getAuthors();
        $categories = $this->categoryRepository->getCategories();
        return $this->render('search', ['authors' => $authors, 'categories' => $categories]);
    }
}