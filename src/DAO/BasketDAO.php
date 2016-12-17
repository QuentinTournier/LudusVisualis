<?php
namespace LudusVisualis\DAO;
use LudusVisualis\Domain\Basket;
use LudusVisualis\Domain\Article;
use LudusVisualis\Domain\Game;
use LudusVisualis\Domain\User;
class BasketDAO extends DAO
{
    
    /**
     * Returns an basket matching user
     * @param User $user
     * @return Array of Basket
     */
    public function findAllByUser(User $user, $state = Basket::ORDERED) {
        $sql = "SELECT * FROM Basket Natural join VideoGames WHERE user_id= :userId AND state=:state";
        $rows = $this->getDb()->fetchAll($sql, ['userId'=> $user->getId(), 'state' => $state]);
        $basket = [];
        foreach ($rows as $row){
            $basket[] = $this->buildDomainObject($row);
        }
        return $basket;
    }
    
    /**
    * remove one copy of the game from the basket, and put back a copy available for the game
    * @param Game $game
    * @param User $user
    * @param GameDAO, needed to remove one copy
    * @return returns true if the game was deleted, false otherwise
    */
    public function deleteOrder(Game $game, User $user, GameDAO $gameDao) {
        $stmt = $this->getDb()->prepare('DELETE FROM basket WHERE user_id= :userId AND game_id = :gameId AND state = :state');
        $numDeleted = $stmt->execute(['userId' => $user->getId(), 'gameId' => $game->getId(), 'state'=> Basket::ORDERING]);
        if($numDeleted>0){
            $gameDao->addOne($game);
        }
        return $numDeleted>0;
    }
    
    /**
    * add one copy of the game in the basket, and remove copy available for the game
    * @param Game $game
    * @param User $user
    * @param GameDAO, needed to remove one copy
    * @return returns true if the game was inserted, false otherwise
    */
    public function addInBasket(Game $game, User $user, GameDAO $gameDao) {
        $stmt = $this->getDb()->prepare('INSERT INTO basket (user_id,game_id,state) VALUES (:userId, :gameId, :state)');
        $numInserted = $stmt->execute(['userId' => $user->getId(), 'gameId' => $game->getId(), 'state' => Basket::ORDERING]);
        if($numInserted>0){
            $gameDao->removeOne($game);
        }
        return $numInserted>0;
    }
    
    /**
     * Creates an Basket object based on a DB row.
     * @param array $row The DB row containing Article data.
     * @return \LudusVisualis\Domain\Article
     */
    protected function buildDomainObject(array $row) {
        $basket = new Basket();
        $basket->setId($row['basket_id'])
        ->setUserid($row['user_id'])
        ->setGameId($row['game_id'])
        ->setState($row['state']);
        return $basket;
    }
    
    /**
    * returns true if the user already has the game, false otherwise
    * @param Game $game
    * @param User $user
    * @return Boolean, true if the user already has the game, false otherwise
    */
    public function existsInBasket(Game $game, User $user){
        $sql = "SELECT 1 FROM Basket WHERE game_id= :gameId and user_id= :userId";
        $result= $this->getDb()->fetchAll($sql, array('gameId' => $game->getId(),'userId' => $user->getId()));
        return !empty($result);
    }
    
    /**
    * put all games for the user to ordered
    * @param User $user
    */
    public function orderBasket(User $user){
        $stmt = $this->getDb()->prepare("UPDATE basket SET state = :stateOrdered WHERE state =:stateOrdering AND user_id = :userId");
        $stmt->execute([
            'stateOrdered' => Basket::ORDERED,
            'stateOrdering' => Basket::ORDERING,
            'userId' => $user->getId()
        ]);
    }
    
    /**
    *
    * @param
    * @param 
    * @return Int, the number of games in the cart
    */
    public function findChartSize(User $user){
        $sql = "SELECT * FROM Basket Natural join VideoGames WHERE user_id= :userId AND state=:state";
        $rows = $this->getDb()->fetchAll($sql, ['userId'=> $user->getId(), 'state' => Basket::ORDERING]);
        return count($rows);
    }
}