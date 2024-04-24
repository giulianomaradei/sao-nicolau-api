<?php

abstract class BaseModel{

    protected $table;
    protected $fields;

    protected $databaseConnection;

    public function __construct($table, $fields){
        $this->table = $table;
        $this->fields = $fields;
        $this->databaseConnection = Database::getInstance();
    }

    public function create($data){
        $placeholders = str_repeat('?, ', count($this->fields) - 1) . '?';
    
        $query = "INSERT INTO $this->table (" . implode(', ', $this->fields) . ") VALUES ($placeholders)";
    
        $stmt = $this->databaseConnection->prepare($query);
    
        if ($stmt === false) {
            return false;
        }
    
        $stmt->bind_param(str_repeat('s', count($data)), ...$data);
    
        $stmt->execute();
    
        if ($stmt->affected_rows > 0) {
            return $this->databaseConnection->getLastInsertedId();
        } else {
            return false;
        }
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
        $fields = array_keys($data);
        $values = array_values($data);
    
        $setStatements = [];
        foreach ($fields as $field) {
            $setStatements[] = "$field = ?";
        }
        $setClause = implode(", ", $setStatements);
    
        $values[] = $id;
    
        $stmt = $this->databaseConnection->prepare("UPDATE $this->table SET $setClause WHERE id = ?");
        
        $types = str_repeat("s", count($values));
        $stmt->bind_param($types, ...$values);
    
        return $stmt->execute();
    }
    public function where($field, $value){
        $stmt = $this->databaseConnection->prepare("SELECT * FROM $this->table WHERE $field = ?");
        $stmt->bind_param('s', $value);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

}