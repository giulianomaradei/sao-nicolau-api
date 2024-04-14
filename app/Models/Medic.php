<?php

class Medic extends BaseModel{

    function __construct(){
        parent::__construct('medics', ['id', 'crm', 'specialty']);
    }

    function filterBySpeciality($specialty){
        parent::where('specialty', $specialty);
    }

}