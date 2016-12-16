<?php

namespace LudusVisualis\Domain;
use Symfony\Component\Security\Core\User\UserInterface;
class User implements UserInterface
{
    /**
     * User id.
     *
     * @var integer
     */
    private $id;

    /**
     * User email.
     *
     * @var string
     */
    private $email;
    
    /**
     * User password.
     *
     * @var string
     */
    private $password;
    
    /**
     * User descriptionLong.
     *
     * @var string
     */
    private $lastName;
    
    /**
     * User author.
     *
     * @var string
     */
    private $userName;
    
    /**
     * User adresse.
     *
     * @var string
     */
    private $address;
    
        /**
     * User zip.
     *
     * @var int
     */
    private $zip;
    
    /**
     * User city.
     *
     * @var string
     */

    private $city;

    /**
     * Game salt.
     *
     * @var string
     */
    private $salt;
    
    /**
     * User number.
     *
     * @var number
     */
    private $role;

    public function getUserName() {
        return $this->userName;
    }
    
    public function getUser(){
        return this;    
    }
    
     public function setUserName($userName) {
        $this->userName = $userName;
    }
        
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }
    
    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getUserLastName() {
        return $this->lastName;
    }

    public function setUserLastName($lastName) {
        $this->lastName = $lastName;
    }
        
    public function getAddress() {
        return $this->address;
    }

    public function setAddress($address) {
        $this->address = $address;
    }
        
    public function getZip() {
        return $this->zip;
    }

    public function setZip($zip) {
        $this->zip = $zip;
    }
        
        
    public function getCity() {
        return $this->city;
    }

    public function setCity($city) {
        $this->city = $city;
    }
        
    public function getSalt() {
        return $this->salt;
    }

    public function setSalt($salt) {
        $this->salt = $salt;
    }
    
     public function getRole()

    {
        return $this->role;
    }


    public function setRole($role) {
        $this->role = $role;
    }


    /**
     * @inheritDoc
     */

    public function getRoles()

    {
        return array($this->getRole());
    }


    /**
     * @inheritDoc
     */

    public function eraseCredentials() {
        // Nothing to do here

    }
}