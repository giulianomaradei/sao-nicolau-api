<?php

class Schedule extends BaseModel{

    protected $id, $date, $time, $name, $gender, $email, $medic_id;

    function __construct($id, $date, $time, $person_id, $medic_id){
        $data = [$id, $date, $time, $person_id, $medic_id];
        parent::__construct('schedules', ['id', 'date', 'time', 'person_id', 'medic_id'], $data);
    }

}