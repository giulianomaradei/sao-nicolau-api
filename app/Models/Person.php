<?php

class Person extends BaseModel{
    protected $name, $gender, $email, $phone, $zipcode, $address, $state, $city;


    public function __construct($name, $gender, $email, $phone, $zipcode, $address, $state, $city){
        
        $this->name = $name;
        $this->gender = $gender;
        $this->email = $email;
        $this->phone = $phone;
        $this->zipcode = $zipcode;
        $this->address = $address;
        $this->state = $state;
        $this->city = $city;


        parent::__construct('persons', ['id', 'name', 'gender', 'email', 'phone', 'zipcode', 'address', 'state', 'city'], $data);
    }

}