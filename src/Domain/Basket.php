<?php
namespace LudusVisualis\Domain;
class Basket 
{
    const ORDERED= 'ordered';
    const ORDERING = 'ordering';
    const DELIVERED = 'delivered';
 
    private $id;
    
    private $userId;
    
    private $gameId;
    
    private $state;
    
    public function getId() {
        return $this->id;
    }
    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function getUserId() {
        return $this->userId;
    }
    public function setUserid($userId) {
        $this->userId = $userId;
        return $this;
    }
    
    public function getGameId() {
        return $this->gameId;
    }
    public function setGameId($gameId) {
        $this->gameId = $gameId;
        return $this;
    }
    
    public function getState(){
        return $this->state;
    }
    
    public function setState($state){
        $this->state = $state;
        return $this;
    }
   
}