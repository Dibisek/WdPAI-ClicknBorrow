<?php
class Category
{
    private $category_id;
    private $category_name;

    public function __construct(string $category_name, int $id=0)
    {
        $this->category_id = $id;
        $this->category_name = $category_name;
    }

    public function getCategoryId(): int
    {
        return $this->category_id;
    }

    public function getCategoryName(): string
    {
        return $this->category_name;
    }

}