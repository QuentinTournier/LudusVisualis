<?php

namespace LudusVisualis\DAO;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use LudusVisualis\Domain\User;

class UserDAO extends DAO implements UserProviderInterface
{

    /**
     * Returns a user matching the supplied id.
     *
     * @param integer $id The user id.
     *
     * @return \ LudusVisualis\Domain\User|throws an exception if no matching user is found
     */
    public function find($id) {
        $sql = "select * from Users where user_id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));
        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No user matching id " . $id);
    }

    /**
     * {@inheritDoc}
     */
    public function refreshUser(UserInterface $user)
    {
        $class = get_class($user);
        if (!$this->supportsClass($class)) {
            printf('Instances of "%s" are not supported.', $class);
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $class));
        }
        return $this->loadUserByUsername($user->getEmail());
    }
    
    /**
     * Saves a user into the database.
     *
     * @param \LudusVisualis\Domain\User $user The user to save
     */
    public function save(User $user) {
        $sql = "select Max(user_id) from Users";
        $result = $this->getDb()->fetchColumn($sql);
        $id=$result[0]+1;
        $userData = array(   
            'user_id'=>$id,
            'user_email' => $user->getEmail(),
            'user_password' => $user->getPassword(),
            'user_lastName' => $user->getUserLastname(),
            'user_firstName' => $user->getUsername(),  
            'user_address' => $user->getAddress(),
            'user_zip' => $user->getZip(),
            'user_city' => $user->getCity(),       
            'user_salt' => $user->getSalt(),
            'user_role' => $user->getRole()
            );
        $this->getDb()->insert('Users', $userData);
    }
    
    public function loadUserByUsername($email)

    {
        $sql = "select * from Users where user_email=?";
        $row = $this->getDb()->fetchAssoc($sql, array($email));
        if ($row){
            return $this->buildDomainObject($row);       
        }
        else
            throw new UsernameNotFoundException(sprintf('User "%s" not found.', $email));
    }
    
    public function getUser($firstName)

    {
        $sql = "select * from Users where user_firstName=?";
        $row = $this->getDb()->fetchAssoc($sql, array($firstName));
        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new UsernameNotFoundException(sprintf('User "%s" not found.', $firstName));
    }


    /**
     * {@inheritDoc}
     */
    public function supportsClass($class)
    {
        return 'LudusVisualis\Domain\User' === $class;
    }
    
    public function getUsername($username){
        $sql = "select * from users where user_firstName=?";
        $row = $this->getDb()->fetchAssoc($sql, array($username));
        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new UsernameNotFoundException(sprintf('User "%s" not found.', $username));
    }

    /**
     * Creates a User object based on a DB row.
     *
     * @param array $row The DB row containing User data.
     * @return \ LudusVisualis\Domain\User
     */
    protected function buildDomainObject(array $row) {
        $user = new User();
        $user->setId($row['user_id']);
        $user->setEmail($row['user_email']);
        $user->setPassword($row['user_password']);
        $user->setUserLastName($row['user_lastName']);
        $user->setUserName($row['user_firstName']);
        $user->setAddress($row['user_address']);
        $user->setZip($row['user_zip']);
        $user->setCity($row['user_city']);
        $user->setSalt($row['user_salt']);
        $user->setRole($row['user_role']);
        return $user;   
    }
    
    
    /**
    * updates the user params
    * @param user to update
    * @params params to update
    */
    public function updateUser(User $user, $params){
        $paramsSql = 'UPDATE users SET';
        foreach($params as $key => $param){
            $paramsSql .= '`'.$key . '`="'. $param . '"';
            if(end($params) !== $param){
                $paramsSql .=',';
            }
        }
        $paramsSql .=  'WHERE user_id = :userId';
        $this->getDb()->executeUpdate($paramsSql,['userId' => $user->getId()]);
    }
}
    
