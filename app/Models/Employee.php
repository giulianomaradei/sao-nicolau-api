<?php

class Employee extends BaseModel{

    function __construct(){
        parent::__construct('employees', ['id', 'contract_date', 'salary', 'password']);
    }
}