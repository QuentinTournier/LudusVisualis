<?php
namespace LudusVisualis\Domain;
class Basket 
{
    
    /**
     * Basket id.
     *
     * @var integer
     */
    private $id;
    
    private $userId;
    
    private $gameId;
    
    private $quantity;
    
    public function getId() {
        return $this->id;
    }
    public function setId($id) {
        $this->id = $id;
    }

    public function getUserId() {
        return $this->userId;
    }
    public function setUserid($userId) {
        $this->userId = $userId;
    }
    
    public function getGameId() {
        return $this->gameId;
    }
    public function setGameId($gameId) {
        $this->gameId = $gameId;
    }
   
}