<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Book.php';
class BookRepository extends Repository
{
    public function getBooks() : array
    {
        $this->database->connect();
        $query = $this->database->getConnection()->prepare('SELECT * FROM books_view');
        $query->execute();

        $this->database->disconnect();

        $books = $query->fetchAll(PDO::FETCH_ASSOC);
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
}