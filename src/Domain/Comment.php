<?php
namespace LudusVisualis\Domain;
class Comment 
{

    private $id;
    private $userId;
    private $gameId;
    private $rating;
    private $commentText;
    
    public function getId(){
        return $this->id;
    }
    
    public function setId($id){
        $this->id = $id;
        return $this;
    }
    
    
    public function getUserId(){
        return $this->userId;
    }
    
    public function setUserId($userId){
        $this->userId = $userId;
        return $this;
    }
    
    
    public function getGameId(){
        return $this->gameId;
    }
    
    public function setGameId($gameId){
        $this->gameId = $gameId;
        return $this;
    }
    
    
    public function getRating(){
        return $this->rating;
    }
    
    public function setRating($rating){
        $this->rating = $rating;
        return $this;
    }
    
    
    public function getCommentText(){
        return $this->commentText;
    }
    
    public function setCommentText($commentText){
        $this->commentText = $commentText;
        return $this;
    }
    
}