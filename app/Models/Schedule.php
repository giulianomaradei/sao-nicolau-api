<?php

class Schedule extends BaseModel{


    function __construct(){
        parent::__construct('schedules', ['id', 'date', 'time', 'person_id', 'medic_id']);
    }

}