<?php

class Bookmark
{
    private $user_id;
    private $book_id;


    public function __construct(int $user_id, int $book_id)
    {
        $this->user_id = $user_id;
        $this->book_id = $book_id;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    public function getBookId(): int
    {
        return $this->book_id;
    }

    public function setBookId(int $book_id): void
    {
        $this->book_id = $book_id;
    }


}