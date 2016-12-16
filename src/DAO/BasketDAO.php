<?php
namespace LudusVisualis\DAO;
use LudusVisualis\Domain\Basket;
use LudusVisualis\Domain\Article;
use LudusVisualis\Domain\Game;
use LudusVisualis\Domain\User;
class BasketDAO extends DAO
{
    
    /**
     * Returns an basket matching user id
     *
     * @param integer $id
     *
     * @return \LudusVisualis\Domain\Article
     */
    public function findAllByUser($id) {
        $sql = "SELECT * FROM Basket Natural join VideoGames WHERE user_id=?";
        return $this->getDb()->fetchAll($sql, array($id));
        
    }
    
    public function deleteOrder(Game $game, User $user) {
         $stmt = $this->getDb()->prepare('DELETE FROM basket WHERE user_id= :userId AND game_id = :gameId ');
        $stmt->execute(['userId' => $user->getId(), 'gameId' => $game->getId()]);
    }
    
    public function addInBasket(Game $game, User $user) {
         $stmt = $this->getDb()->prepare('INSERT INTO basket (user_id,game_id) VALUES (:userId, :gameId)');
        $stmt->execute(['userId' => $user->getId(), 'gameId' => $game->getId()]);
    }
    
    /**
     * Creates an Basket object based on a DB row.
     *
     * @param array $row The DB row containing Article data.
     * @return \LudusVisualis\Domain\Article
     */
    protected function buildDomainObject(array $row) {
        $basket = new Basket();
        $basket->setId($row['basket_id']);
        $basket->setUserid($row['user_id']);
        $basket->setGameId($row['game_id']);
        return $basket;
    }
    
    public function existsInBasket(Game $game, User $user){
        $sql = "SELECT 1 FROM Basket WHERE game_id= :gameId and user_id= :userId";
        $result= $this->getDb()->fetchAll($sql, array('gameId' => $game->getId(),'userId' => $user->getId()));
        return !empty($result);
    }
    
    
    /**
     * Saves a comment into the database.
     *
     * @param \sellDreams\Domain\Basket $basket The comment to save
     */
    public function save(Basket $basket) {
        //On regarde si le jeu est déjà dans le panier
        $sql = "SELECT * FROM Basket WHERE game_id=? and user_id=?";
        $result= $this->getDb()->fetchAll($sql, array($basket->getGameId(),$basket->getUserId()));
        $isEmpty=empty($result);
        $basketData = array(
            'user_id' => $basket->getUserId(),
            'game_id' => $basket->getGameId(),
            );
        
        // The article has never been saved : insert it   
        $this->getDb()->insert('Basket', $basketData);
        // Get the id of the newly created comment and set it on the entity.
        $id = $this->getDb()->lastInsertId();
        $basket->setId($id);
        
    }
    
    /**
     * Removes a game command from the database.
     *
     * @param integer $id The article id.
     */
    public function delete($id) {
        // Delete the article
        $this->getDb()->delete('Basket', array('bas_id' => $id));
    }
         
    /**
     * @param $baskets array of basket
     * return total price
     */
    /*
    public function sumQuantity($baskets){
        $total = 0;
        foreach($baskets as $basket){
            $total = $total + $basket->getQuantity()*$basket->getValue();
        }
        return $total;
    }
    */
}