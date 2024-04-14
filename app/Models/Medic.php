<?php

class Medic extends BaseModel{

    protected $id, $crm, $specialty;

    function __construct($id, $crm, $specialty){
        $data = [$id, $crm, $specialty];
        parent::__construct('medics', ['id', 'crm', 'specialty'], $data);
    }

}