<?php

require_once 'BaseController.php';
require_once __DIR__ . '/../Models/Medic.php';
require_once __DIR__ . '/../Models/Schedule.php';


class MedicController extends BaseController{

    public function existingSpecialties(){
        $medic = new Medic();
        $specialties = $medic->existingSpecialties();
        $this->successResponse($specialties);
    }

    public function filterBySpecialty(){
        $specialty = $_GET['specialty'];
        $medic = new Medic();
        $medics = $medic->filterBySpeciality($specialty);
        $this->successResponse($medics);
    }

    public function availableHoursByDate(){
        $medic_id = $_GET['medic_id'];
        $date = $_GET['date'];
        $hours = (new Schedule())->availableHoursByDate($medic_id, $date);;
        $this->successResponse($hours);
    }
}