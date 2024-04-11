<?php

require_once 'BaseController.php';
require_once __DIR__ . '/../Utils/Database.php';

class AuthController extends BaseController {
    public function login() {
        
        $email = $_POST['email'];
        $password = $_POST['password'];

        $database = Database::getInstance();
        $result = $database->query("SELECT p.id, e.* FROM persons p JOIN employees e ON p.id = e.id WHERE p.email = '$email'");

        if(count($result) == 0){
            self::errorResponse("Usuário não encontrado");
            return;
        }

        $employee = $result[0];
        if(password_verify($password, $employee['password'])){
            self::successResponse($employee);
        }else{
            self::errorResponse("Senha incorreta");
        }
        
    }

    public function register(){
        $name = $_POST['name'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $zipcode = $_POST['zipcode'];
        $address = $_POST['address'];
        $state = $_POST['state'];
        $city = $_POST['city'];
        $contract_date = $_POST['contract_date'];
        $salary = $_POST['salary'];
        $password = $_POST['password'];
        $is_medic = $_POST['is_medic'];

        $database = Database::getInstance();
        $database->query("INSERT INTO persons (name, gender, email, phone, zipcode, address, state, city) VALUES ('$name', '$gender', '$email', '$phone', '$zipcode', '$address', '$state', '$city')");

        $id = $database->getLastInsertedId();

        $database->query("INSERT INTO employees (id, contract_date, salary, password, is_medic) VALUES ('$id', '$contract_date', '$salary', '$password', '$is_medic')");

        if($database->conn->error){
            self::errorResponse($database->conn->error);
        }else{
            self::successResponse("Usuário cadastrado com sucesso");
        }
    }

}
    