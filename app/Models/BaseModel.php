<?php

abstract class BaseModel{

    protected $table;
    protected $fields;

    protected $databaseConnection;

    public function __construct($table, $fields, $data){
        $this->table = $table;
        $this->fields = $fields;
        $this->databaseConnection = Database::getInstance();

        $this->create($data);
    }

    public function create($data){
        $fields = implode(", ", $this->fields);
        $values = implode("', '", $data);
        $result = $this->databaseConnection->query("INSERT INTO $this->table ($fields) VALUES ('$values')");
        //retorna o id;
        return $this->databaseConnection->conn->insert_id;
    }

    public function findById($id){
        $result = $this->databaseConnection->query("SELECT * FROM $this->table WHERE id = $id");
        return $result->fetch_assoc();
    }

    public function findAll(){
        $result = $this->databaseConnection->query("SELECT * FROM $this->table");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function update($id, $data){
        $fields = implode(", ", $this->fields);
        $values = implode("', '", $data);
        $this->databaseConnection->query("UPDATE $this->table SET $fields = '$values' WHERE id = $id");
        return $this->databaseConnection->conn->insert_id;
    }

}