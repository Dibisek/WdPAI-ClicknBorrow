<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/Bookmark.php';
require_once __DIR__.'/../models/Book.php';
require_once __DIR__.'/../repository/BookmarkRepository.php';
require_once __DIR__.'/../repository/BookRepository.php';

class BookmarkController extends AppController
{
    private $bookmarkRepository;
    private $bookRepository;

    public function __construct()
    {
        parent::__construct();
        $this->bookmarkRepository = new BookmarkRepository();
        $this->bookRepository = new BookRepository();
    }

    public function bookmarks()
    {
        if (!$this->isGet()) {
            return $this->render('bookmarks');
        }

        if (!isset($_SESSION['user'])) {
            return $this->render('login');
        }

        $user_id = unserialize($_SESSION['user'])->getId();
        $bookmarks = $this->bookmarkRepository->getUserBookmarks($user_id);


        $books = $this->bookRepository->getBooksIdSorted();
        $bookmarkedBookIds = [];
        if (isset($_SESSION['user'])) {
            $bookmarkedBookIds = $this->bookmarkRepository->getUserBookmarks(unserialize($_SESSION['user'])->getId());
        }

        return $this->render('bookmarks', ['books' => $books, 'bookmarkedBookIds' => $bookmarkedBookIds]);
    }

    public function addBookmark(string $book_id)
    {
        if (!isset($_SESSION['user'])) {
            return $this->render('login');
        }
        $book_id = intval($book_id);
        $user_id = unserialize($_SESSION['user'])->getId();
        $bookmark = new Bookmark($user_id, $book_id);
        if ($this->bookmarkRepository->isBookmarked($user_id, $book_id)) {
            $this->bookmarkRepository->removeBookmark($bookmark);
        } else {
            $this->bookmarkRepository->addBookmark($bookmark);
        }

        http_response_code(200);
    }

}