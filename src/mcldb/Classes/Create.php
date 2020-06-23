<?php

namespace Src\mcldb\Classes;

use Src\mcldb\Classes\Connection;

final class Create extends Connection{
    
    private string $values = "";
    
    public function toCreate(string $table, array $params) : void
    {            
        $this->setTable($table);
        //INSERT INTO users (name, email, phone) VALUES (:name, :email, :phone);
        
        foreach ($params as $key => $value) {
            $this->setFields("{$key}, ");
            $this->values .= ":{$key}, ";
            $this->setDatas(":{$key}", $value);
        }   
        
        $this->values = substr($this->values, 0, -2);
        $this->setStatement("INSERT INTO {$this->getTable()} (".substr($this->getFields(), 0, -2).") VALUES ({$this->values});");                
        
        return;
    }    
}
