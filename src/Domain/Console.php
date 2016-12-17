<?php
namespace LudusVisualis\Domain;
class Console 
{

    private $id;
    private $name;
    private $shortName;
    private $desctipion;
    private $price;
    private $developer;
    
    public function getName(){
        return $this->name;
    }
    public function setName($name){
        $this->name = $name;
        return $this;
    }
    
    public function getShortName(){
        return $this->shortName;
    }
    public function setShortName($shortName){
        $this->shortName = $shortName;
        return $this;
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function setId($id){
        $this->id = $id;
        return $this;
    }
    
    
    public function setDescription($description){
        $this->description = $description;
        return $this;
    }
    
    public function setPrice($price){
        $this->price = $price;
        return $this;
    }
    
    public function setDeveloper($developer){
        $this->developer = $developer;
        return $this;
    }
    
    public function getImage(){
        return $this->image;
    }
    
    public function setImage($image){
        $this->image = $image;
        return $this;
    }

}