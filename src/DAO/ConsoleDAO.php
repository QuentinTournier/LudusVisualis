<?php
namespace LudusVisualis\DAO;
use LudusVisualis\Domain\Console;
class ConsoleDAO extends DAO
{
    /**
    * 
    * @return returns all the different consoles, as an array of object
    */
    public function findAllConsoles(){
        $stmt = $this->getDb()->prepare('SELECT * FROM Console');
        $stmt->execute();
        $rows = $stmt->fetchAll();
        $consoles = [];
        foreach($rows as $row){
            $consoles[] =  $this->buildDomainObject($row);
        }
        return $consoles;
    }
    
    /**
    * 
    * @return returns the console
    */
    public function findConsole($consoleId){
        $stmt = $this->getDb()->prepare('SELECT * FROM Console WHERE id = :id');
        $stmt->execute(['id'=>$consoleId]);
        $rows = $stmt->fetchAll();

        return $this->buildDomainObject($rows[0]);
    }
    
     /**
     * Creates a console object based on a DB row.
     *
     * @param array $row The DB row containing Console data.
     * @return \LudusVisualis\Domain\Console
     */
    protected function buildDomainObject(array $row) {
        $console = new Console();
        $console->setId($row['id'])
        ->setName($row['name'])
        ->setPrice($row['price'])
        ->setDescription($row['description'])
        ->setDeveloper($row['developer'])
        ->setImage($row['image']);
        return $console;
    }
}