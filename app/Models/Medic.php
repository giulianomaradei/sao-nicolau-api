<?php

class Medic extends BaseModel{

    function __construct(){
        parent::__construct('medics', ['id', 'crm', 'specialty']);
    }

    function existingSpecialties(){
        $stmt = $this->databaseConnection->prepare("SELECT DISTINCT specialty FROM $this->table");
        $stmt->execute();
        $result = $stmt->get_result();
        $specialties = [];
        while ($row = $result->fetch_assoc()) {
            $specialties[] = $row['specialty'];
        }
        return $specialties;
    }

    function filterBySpeciality($specialty){
        $stmt = $this->databaseConnection->prepare("SELECT * FROM $this->table WHERE specialty = ?");
        $stmt->bind_param('s', $specialty);
        $stmt->execute();
        $result = $stmt->get_result();
        $medicsIds = [];
        while ($row = $result->fetch_assoc()) {
            $medicsIds[] = $row['id'];
        }

        $medics = [];
        foreach ($medicsIds as $medicId) {
            $stmt = $this->databaseConnection->prepare("SELECT name FROM persons WHERE id = ?");
            $stmt->bind_param('i', $medicId);
            $stmt->execute();
            $result = $stmt->get_result();
            $person = $result->fetch_assoc();
            $medics[] = [
                'name' => $person['name'],
                'medic_id' => $medicId
            ];
        }

        return  $medics;
    }
}