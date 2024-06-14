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
}