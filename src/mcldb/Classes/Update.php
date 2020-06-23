<?php

namespace Src\mcldb\Classes;

use Src\mcldb\Classes\Connection;

final class Update extends Connection{
    
    private array  $datas;
    private string $table;
    private string $fields = "";
    
    public function toUpdate(string $table, array $params) : Update
    {
        //$statement = UPDATE users SET name = :name, email = :email WHERE $this->where()
        $this->table = $table;
        
        foreach ($params as $key => $value) {
            $this->fields .= "{$key} = :{$key}, ";
            $this->datas[":{$key}"] = $value;
        }  
        $this->fields = substr($this->fields, 0, -2);   
        
        return $this;
    }
    
    public function where(string $field, string $operator = "=", $primary_key) : Update
    {
        (string) $primary_key;
        $statement = "UPDATE {$this->table} SET {$this->fields} WHERE {$field} {$operator} " . $primary_key;
        $this->setStatement($statement);
        
        return $this;
    }
    
    public function exec():bool
    {
        try{
            $prepared = $this->getInstance()->prepare($this->getStatement());
            $executed = $prepared->execute($this->datas);
            
            if($prepared->errorCode())
                throw new \PDOException($prepared->errorInfo()[2], $prepared->errorInfo()[1]);
            
        } catch (\PDOException $ex) {
            $this->setErrors($ex->getMessage());
        }
        
        return $executed;     
    }
}
