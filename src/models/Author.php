<?php

class Author
{
    private $author_id;
    private $first_name;
    private $last_name;

    public function __construct(string $first_name, string $last_name, int $id=0)
    {
        $this->author_id = $id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
    }

    public function getAuthorId(): int
    {
        return $this->author_id;
    }

    public function getName(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getFirstName(): string
    {
        return $this->first_name;
    }

    public function getLastName(): string
    {
        return $this->last_name;
    }


}