<?php

namespace LudusVisualis\DAO;

use LudusVisualis\Domain\Comment;
use LudusVisualis\Domain\Game;

class CommentDAO extends DAO
{
    /**
    *
    * @param Game $game
    * @return array of comments linked to the given game
    */
    public function getAllCommentsForGame(Game $game){
        $stmt = $this->getDb()->prepare('SELECT * FROM Comments WHERE game_id = :gameId');
        $stmt->execute(['gameId' => $game->getId()]);
        $rows = $stmt->fetchAll();
        $comments = [];
        foreach($rows as $row){
            $comments[] =  $this->buildDomainObject($row);
        }
        return $comments;
    }
    
     protected function buildDomainObject(array $row) {
        $comment = new Comment();
        $comment->setId($row['id'])
            ->setUserId($row['user_id'])
            ->setGameId($row['game_id'])
            ->setRating($row['rating'])
            ->setCommentText($row['comment_text']);
        return $comment;
    }
    
    /**
    * save a comment in db
    * @param $commentData, the params of the comment
    */
    public function saveComment($commentData){
        $stmt = $this->getDb()->prepare('SELECT Max(id) FROM Comments');
        $stmt->execute();
        $id = $stmt->fetchColumn();
        $stmt = $this->getDb()->prepare('INSERT INTO Comments (user_id,game_id, rating, comment_text) 
        VALUES (:userId, :gameId, :rating, :commentText)');
        $success = $stmt->execute([
            'userId' => $commentData['userId'],
            'gameId' => $commentData['gameId'],
            'rating' => $commentData['rating'],
            'commentText' => $commentData['commentText']
        ]);
        return $success;
    }
    
    /**
    * 
    * Comment $comment
    */
    public function removeComment(Comment $comment){
        $stmt = $this->getDb()->prepare('DELETE FROM Comments WHERE id = :id');
        $stmt->execute([':id'=>$comment->getId()]);
    }
    
    /**
    * load the comment of the given id
    * @param $commentId
    */
    public function loadComment($commentId){
        $stmt = $this->getDb()->prepare('SELECT id, user_id,game_id, rating, comment_text FROM Comments WHERE id= :id');
        $stmt->execute(['id' => $commentId]);
        $row = $stmt->fetch();
        return $this->buildDomainObject($row);
    }
}
   