<?php

class Employee extends BaseModel{

    protected $id, $contract_date, $salary, $password;

    function __construct($id, $contract_date, $salary, $password){
        $data = [$id, $contract_date, $salary, $password];
        parent::__construct('employees', ['id', 'contract_date', 'salary', 'password'], $data);
    }
}