<?php

require_once 'BaseModel.php';

class Person extends BaseModel{
    protected $name, $gender, $email, $phone, $zipcode, $address, $state, $city;


    public function __construct(){

        parent::__construct('persons', ['name', 'gender', 'email', 'phone', 'zipcode', 'address', 'state', 'city']);
    }

    public function findByEmail($email){
        $stmt = $this->databaseConnection->prepare("SELECT p.id, e.* FROM $this->table p JOIN employees e ON p.id = e.id WHERE p.email = ?");
        $stmt->execute([$email]);
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

}