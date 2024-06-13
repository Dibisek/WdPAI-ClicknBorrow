<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Category.php';
class CategoryRepository extends Repository
{
    public function getCategories() :array
    {
        $query = $this->database->connect()->prepare('SELECT * FROM categories');
        $query->execute();

        $this->database->disconnect();

        $categories = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($categories as $category) {
            $result[] = new Category(
                $category['category_name'],
                $category['category_id']
            );
        }

        return $result;
    }
}