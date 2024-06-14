<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Author.php';

class AuthorRepository extends Repository
{
    public function getAuthors() : array
    {
        $this->database->connect();
        $query = $this->database->getConnection()->prepare('SELECT * FROM authors');
        $query->execute();

        $this->database->disconnect();

        $authors = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($authors as $author) {
            $result[] = new Author(
                $author['firstname'],
                $author['surname'],
                $author['author_id']
            );
        }

        return $result;
    }
}