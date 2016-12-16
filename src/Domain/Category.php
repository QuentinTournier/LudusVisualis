<?php
namespace LudusVisualis\Domain;
class Category 
{
    private $name;
    
    public function getName(){
        return $this->name;
    }
    
    public function setName($name){
        $this->name= $name;
        
        return $this;
    }
}