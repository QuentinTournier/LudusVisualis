<?php
namespace LudusVisualis\Domain;
class Category 
{
    private $name;
    private $id;
    
    public function getName(){
        return $this->name;
    }
    
    public function setName($name){
        $this->name= $name;
        
        return $this;
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function setId($id){
        $this->id = $id;
        return $this;
    }
    
    
}