<?php

namespace LudusVisualis\DAO;

use LudusVisualis\Domain\Category;

class CategoryDAO extends DAO
{
    public function getAllCategories($language){
        $stmt = $this->getDb()->prepare('SELECT * FROM Categories_has_translation WHERE cat_language = :language');
        $stmt->execute(['language' => $language]);
        $rows = $stmt->fetchAll();
        $categories = [];
        foreach($rows as $row){
            $categories[] =  $this->buildDomainObject($row);
        }
        return $categories;
    }
    
    
     protected function buildDomainObject(array $row) {
        $category = new Category();
        $category->setName($row['cat_name'])
            ->setId($row['cat_id']);
        return $category;
    }
}