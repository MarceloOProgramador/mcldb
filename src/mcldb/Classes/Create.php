<?php

namespace Src\mcldb\Classes;

use Src\mcldb\Classes\Connection;

class Create extends Connection{
    
    public function toCreate(string $table, array $params) : void
    {    
        $fields = "";
        $values = "";
        
        foreach ($params as $key => $value) {
            $fields .= $key.', ';
            $values .= ":{$key}, ";
            $arrayExecute[":{$key}"] = $value;
        }   
        
        $fields = substr($fields, 0, -2);
        $values = substr($values, 0, -2);
        $this->setStatement("INSERT INTO {$table} ({$fields}) VALUES ({$values});");        
        $query_prepared = $this->getInstance()->prepare($this->getStatement());
        
        try{
            $query_prepared->execute($arrayExecute);
        } catch (Exception $ex) {
            $this->setErrors("Algo de errado ocorreu!");
        }              
        
        return;
    }    
}
