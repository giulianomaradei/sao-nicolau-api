<?php

require_once 'BaseController.php';
require_once __DIR__ . '/../Models/Person.php';
require_once __DIR__ . '/../Models/Employee.php';
require_once __DIR__ . '/../Models/Medic.php';
require_once __DIR__ . '/../Utils/Database.php';

class AuthController extends BaseController {
    public function login() {
        
        $email = $_POST['email'];
        $password = $_POST['password'];

        try{
            $person = (new Person())->findByEmail($email);

            if($person === null){
                self::errorResponse("Usuário não encontrado");
                return;
            }

            if(password_verify($password, $person['password'])){
                session_start();
                $_SESSION['id'] = $person['id'];
                self::successResponse($person);
            }else{
                self::errorResponse("Senha incorreta");
            }

        }catch(Exception $e){
            self::errorResponse($e->getMessage());
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
        $contract_date = DateTime::createFromFormat('d/m/Y', $_POST['contract_date'])->format('Y-m-d');

        $salary = $_POST['salary'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $is_medic = $_POST['is_medic'] ?? false;

        try{
            $personId = (new Person())->create([$name, $gender, $email, $phone, $zipcode, $address, $state, $city]);

            $employeeId = (new Employee())->create([$personId, $contract_date, $salary, $password]);

            if($is_medic){
                $crm = $_POST['crm'];
                $specialty = $_POST['specialty'];

                (new Medic())->create([$employeeId, $crm, $specialty]);
            }

            session_start();
            $_SESSION['id'] = $employeeId;
            self::successResponse("Usuário cadastrado com sucesso");
        }catch(Exception $e){
            self::errorResponse($e->getMessage());
        }
    }

}
    