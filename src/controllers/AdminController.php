<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/Book.php';
require_once __DIR__.'/../models/Reservation.php';
require_once __DIR__.'/../repository/BookRepository.php';
require_once __DIR__.'/../repository/ReservationRepository.php';
class AdminController extends AppController
{
    private $reservationRepository;

    const MAX_FILE_SIZE = 1024*1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/img/uploads/';
    private $message = [];
    private $bookRepository;
    private $authorRepository;
    private $categoryRepository;

    public function __construct()
    {
        parent::__construct();
        $this->reservationRepository = new ReservationRepository();
        $this->bookRepository = new BookRepository();
        $this->authorRepository = new AuthorRepository();
        $this->categoryRepository = new CategoryRepository();
    }


    public function reservationsAdmin()
    {
        if (!$this->isGet()) {
            return $this->render('reservationsAdmin');
        }

        $pendingReservations = $this->reservationRepository->getPendingReservations();

        return $this->render('reservationsAdmin', ['reservations' => $pendingReservations]);
    }

    public function reservationHandler()
    {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);
            header('Content-type: application/json');
            http_response_code(200);

            $reservation_id = $decoded['reservation_id'];
            $status = $decoded['status'];
            $this->reservationRepository->updateReservationStatus($status, $reservation_id);
            return;
        }
    }

    public function addBook()
    {
        if ($this->isPost() && is_uploaded_file($_FILES['cover']['tmp_name']) && $this->validateFile($_FILES['cover']) && $this->validateForm($_POST)) {
            $fileExt = pathinfo($_FILES['cover']['name'], PATHINFO_EXTENSION);

            $uniqueFileName = uniqid('', true).'.'.$fileExt;

            move_uploaded_file(
                $_FILES['cover']['tmp_name'],
                dirname(__DIR__).self::UPLOAD_DIRECTORY.$uniqueFileName
            );

            $newBook = new Book(
                $_POST['title'],
                $_POST['author'],
                $_POST['description'],
                $_POST['publishingDate'],
                $_POST['pageCount'],
                $uniqueFileName,
                $_POST['category']
            );


            $this->bookRepository->addBook($newBook);


        }
        $this->render('addBook', ['authors' => $this->authorRepository->getAuthors(),
            'categories' => $this->categoryRepository->getCategories()]
        );
    }

    private function validateFile(array $file) :bool
    {
        if (!is_uploaded_file($file['tmp_name'])) {
            $this->message[] = 'File not uploaded';
            return false;
        }

        if ($file['size'] > self::MAX_FILE_SIZE) {
            $this->message[] = 'File is too large';
            return false;
        }

        if (!isset($file['type']) || !in_array($file['type'], self::SUPPORTED_TYPES)) {
            $this->message[] = 'File type is not supported';
            return false;
        }
        return true;
    }

    private function validateForm(array $book_data) :bool
    {
        $required_fields = [
            'title',
            'author',
            'description',
            'pageCount',
            'publishingDate',
            'category'
        ];

        foreach ($required_fields as $field) {
            if (empty($book_data[$field])) {
                $this->message[] = "You need to fill in the field";
                return false;
            }
        }
        return true;
    }

    private function uploadFile(mixed $book_photo) :void
    {
        move_uploaded_file($book_photo['tmp_name'],
            dirname(__DIR__).self::UPLOAD_DIRECTORY.$book_photo['name']
        );
    }
}