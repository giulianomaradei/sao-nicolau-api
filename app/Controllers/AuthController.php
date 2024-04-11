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

}
    