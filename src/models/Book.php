<?php

class Book
{
    private $id;
    private $title;
    private $author;
    private $description;
    private $publishingDate;
    private $pageCount;
    private $photo;
    private $categories;

    public function __construct(string $title, string $author, string $description, string $publishingDate,
                                int $pageCount, string $photo, string $categories, int $id=0)
    {
        $this->id = $id;
        $this->title = $title;
        $this->author = $author;
        $this->description = $description;
        $this->publishingDate = $publishingDate;
        $this->pageCount = $pageCount;
        $this->photo = $photo;
        $this->categories = $categories;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title): void
    {
        $this->title = $title;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function setAuthor($author): void
    {
        $this->author = $author;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description): void
    {
        $this->description = $description;
    }

    public function getPublishingDate()
    {
        return $this->publishingDate;
    }

    public function setPublishingDate($publishingDate): void
    {
        $this->publishingDate = $publishingDate;
    }

    public function getPageCount()
    {
        return $this->pageCount;
    }

    public function setPageCount($pageCount): void
    {
        $this->pageCount = $pageCount;
    }

    public function getPhoto()
    {
        return $this->photo;
    }

    public function setPhoto($photo): void
    {
        $this->photo = $photo;
    }

    public function getCategories()
    {
        return $this->categories;
    }

    public function setCategories($categories): void
    {
        $this->categories = $categories;
    }

}