<?php

namespace backend\core;

use backend\core\Config;

class Model{
    
    protected $db = null;
    protected $table = null;
    protected $primaryKey = null;
    protected $lastInsertId = null;
    
    public function __construct(){
        $this->db = Database::connect();
    }
    
    public function all($columns = '*', $orderBy = null, $order = 'ASC'){
        $sql = "SELECT $columns FROM $this->table";
        
        if($orderBy){
            $sql .= " ORDER BY $orderBy $order";
        }
        
        $result = $this->db->query($sql);
        
        return $result->fetchAll();
    }
    
    public function find($id){
        $sql = "SELECT * FROM $this->table WHERE $this->primaryKey = ?";
        $result = $this->db->query($sql, [$id]);
        
        return $result->fetch();
    }
    
    public function create($data){
        $columns = implode(', ', array_keys($data));
        $values = implode(', ', array_fill(0, count($data), '?'));
        
        $sql = "INSERT INTO $this->table ($columns) VALUES ($values)";
        $result = $this->db->query($sql, array_values($data));
        
        $this->lastInsertId = $this->db->lastInsertId();
        
        return $result;
    }
    
    public function update($id, $data){
        $columns = '';
        
        foreach($data as $key => $value){
            $columns .= $key . ' = ?, ';
        }
        
        $columns = rtrim($columns, ', ');
        
        $sql = "UPDATE $this->table SET $columns WHERE $this->primaryKey = ?";
        $result = $this->db->query($sql, array_merge(array_values($data), [$id]));
        
        return $result;
    }
    
    public function delete($id){
        $sql = "DELETE FROM $this->table WHERE $this->primaryKey = ?";
        $result = $this->db->query($sql, [$id]);
        
        return $result;
    }
    
    public function lastInsertId(){
        return $this->lastInsertId;
    }

}