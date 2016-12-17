<?php

namespace LudusVisualis\DAO;

use LudusVisualis\Domain\Category;

class CategoryDAO extends DAO
{
    public function getAllCategories(){
        $stmt = $this->getDb()->prepare('SELECT * FROM Categories');
        $stmt->execute();
        $rows = $stmt->fetchAll();
        $categories = [];
        foreach($rows as $row){
            $categories[] =  $this->buildDomainObject($row);
        }
        return $categories;
    }
    
    
     protected function buildDomainObject(array $row) {
        $category = new Category();
        $category->setName($row['category_name']);
        return $category;
    }
}