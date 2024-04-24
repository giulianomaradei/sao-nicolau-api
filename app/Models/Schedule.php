<?php

class Schedule extends BaseModel{


    function __construct(){
        parent::__construct('schedules', ['id', 'date', 'hour', 'person_id', 'medic_id']);
    }

    function availableHoursByDate($medic_id, $date){
        $stmt = $this->databaseConnection->prepare("SELECT hour FROM $this->table WHERE medic_id = ? AND date = ?");
        $stmt->bind_param('is', $medic_id, $date);
        $stmt->execute();
        $result = $stmt->get_result();
        $hours = [];
        while ($row = $result->fetch_assoc()) {
            $hours[] = $row['hour'];
        }
        return $hours;
    }

}