<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Book.php';
class BookRepository extends Repository
{
    public function getBooks(string $title = null, string $category = null, string $author = null) : array
    {
        $this->database->connect();
        $query = "SELECT * FROM books_view WHERE 1=1";
        $params = [];

        if (!empty($title)) {
            $query .= " AND title LIKE :title";
            $params[':title'] = "%$title%";
        }

        if(!empty($category)) {
            $query .= " AND categories = ANY(:category)";
            $params[':category'] = $category;
        }

        if(!empty($author)) {
            $query .= " AND author_name = :author";
            $params[':author'] = $author;
        }

        $stmt = $this->database->getConnection()->prepare($query);

        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value, PDO::PARAM_STR);
        }

        $stmt->execute();

        $this->database->disconnect();

        $books = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $books;
    }

    public function getBooksAlphabetically() : array
    {
        $this->database->connect();
        $query = $this->database->getConnection()->prepare('SELECT * FROM books_view ORDER BY title');
        $query->execute();

        $this->database->disconnect();

        $books = $query->fetchAll(PDO::FETCH_ASSOC);

        if(!$books) {
            return [];
        }

        foreach ($books as $book) {
            $result[] = new Book(
                $book['title'],
                $book['author_name'],
                $book['description'],
                $book['publishing_date'],
                $book['page_count'],
                $book['photo'],
                $book['categories'],
                $book['book_id']
            );
        }

        return $result;
    }

    public function getBookById(int $id) : ?Book
    {
        $this->database->connect();
        $query = $this->database->getConnection()->prepare('SELECT * FROM books_view WHERE book_id = :id');
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();

        $this->database->disconnect();

        $book = $query->fetch(PDO::FETCH_ASSOC);

        if(!$book) {
            return null;
        }

        return new Book(
            $book['title'],
            $book['author_name'],
            $book['description'],
            $book['publishing_date'],
            $book['page_count'],
            $book['photo'],
            $book['categories'],
            $book['book_id']
        );
    }

    public function addBook(Book $book) : void
    {
        $this->database->connect();
        $query = $this->database->getConnection()->prepare('
        SELECT add_book(?, ?, ?, ?, ?, ?, ?, ?);
        ');

        $author_name = explode(' ', $book->getAuthor());
        $categories = explode(',', $book->getCategories());
        // Convert date to postgres format
        $date = date('Y-m-d', strtotime($book->getPublishingDate()));

        // Convert the array of categories to array for postgres
        $categories = '{'.implode(',', $categories).'}';
        $query->bindParam(1, $book->getTitle(), PDO::PARAM_STR);
        $query->bindParam(2, $author_name[0], PDO::PARAM_STR);
        $query->bindParam(3, $author_name[1], PDO::PARAM_STR);
        $query->bindParam(4, $date, PDO::PARAM_STR);
        $query->bindParam(5, $book->getPageCount(), PDO::PARAM_INT);
        $query->bindParam(6, $book->getPhoto(), PDO::PARAM_STR);
        $query->bindParam(7, $categories, PDO::PARAM_STR);
        $query->bindParam(8, $book->getDescription(), PDO::PARAM_STR);



        $query->execute();


        $this->database->disconnect();
    }


}