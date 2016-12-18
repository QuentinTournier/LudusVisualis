<?php

namespace LudusVisualis\DAO;

use Doctrine\DBAL\Connection;
use LudusVisualis\Domain\Game;
use LudusVisualis\Domain\Console;

class GameDAO extends DAO
{

    /**
     * Return a list of all games, sorted by date (most recent first).
     *
     * @return array A list of all games.
     */
    public function findAll($language) {
        $sql = "select * from VideoGames order by game_id desc";
        $result = $this->getDb()->fetchAll($sql);
        // Convert query result to an array of domain objects
        $games = array();
        foreach ($result as $row) {
            $GameId = $row['game_id'];
            $games[$GameId] = $this->buildDomainObject($row['game_id'],$language);
        }
        return $games;
    }
    
     /**
    * removes one from the number of game available
    * @param Game $game
    */
       public function removeOne(Game $game) {
        $db = $this->getDb();
        $sql = "UPDATE videogames Set game_number=game_number-1 WHERE game_id = :gameId";
        $success = $db->prepare($sql)->execute(['gameId'=>$game->getId()]);
        
        return $success;
       }
    
    /**
    * add one to the number of game available
    * @param Game $game
    */
    public function addOne(Game $game) {
        $db = $this->getDb();
        $sql = "UPDATE videogames Set game_number=game_number+1 WHERE game_id = :gameId";
        $success = $db->prepare($sql)->execute(['gameId'=>$game->getId()]);
        
        return $success;
       }
/**
returns all the games from a categorie
**/
    public function findAllFromCategorie($categorie, $language) {
        $sql = "select * from VideoGames where game_type=?";
        $result= $this->getDb()->fetchAll($sql, array($categorie));
        $games = array();
        foreach ($result as $row) {
            $GameId = $row['game_id'];
            $games[$GameId] = $this->buildDomainObject($row['game_id'], $language);
        }
        return $games;
        }
    
 /**
     * Returns an article matching the supplied id.
     *
     * @param integer $id The article id.

     */
    public function find($id, $language) {
        $sql = "select * from VideoGames where game_id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));
        if ($row)
            return $this->buildDomainObject($row['game_id'], $language);
        else
            throw new \Exception("No article matching id " . $id);
    }
    
    /**
    *
    * @param Console object, console
    * @return, an array of game object
    */
    
    public function getAllGamesFromConsole($consoleId, $language)
    {
        $stmt = $this->getDb()->prepare('SELECT game_id FROM Game_has_console WHERE console_id = :consoleId');
        $stmt->execute(['consoleId'=> $consoleId]);
        $rows = $stmt->fetchAll();
        $games = [];
        foreach($rows as $row){
            $games[] =  $this->find($row['game_id'], $language);
        }
        return $games;
    }
    

    /**
     * Creates a Game object based on a DB row.
     *
     * @param array $row The DB row containing Game data.
     * @return \LudusVisualis\Domain\Game
     */
    protected function buildDomainObject($id, $language) {
        $stmt = $this->getDb()->prepare("
            SELECT * 
            FROM VideoGames vg 
            INNER JOIN VideoGames_has_translation vght 
            ON vg.game_id = vght.game_id 
            WHERE vg.game_id = :gameId AND vght.language = :language");
        $stmt->execute(['gameId' => $id, 'language' => $language]);
        $row = $stmt->fetch();

        $game = new Game();
        $game->setId($row['game_id']);
        $game->setName($row['game_name']);
        $game->setDescriptionShort($row['game_description_short']);
        $game->setDescriptionLong($row['game_description_long']);
        $game->setAuthor($row['game_author']);
        $game->setYear($row['game_year']);
        $game->setImage($row['game_image']);
        $game->setType($row['game_type']);
        $game->setPrice($row['game_price']);
        $game->setNumber($row['game_number']);
        return $game;
    }
}