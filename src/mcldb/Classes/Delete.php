<?php

namespace Mcldb\Classes;

use Mcldb\Classes\Connection;

class Delete extends Connection
{
    
    public function toDelete($table): Delete
    {
        $statement = "DELETE FROM {$table}";
        $this->setStatement($statement);
        
        try{
            $prepared = $this->getInstance()->prepare($statement);
            
            if($prepared->errorCode())
                throw new \PDOException($prepared->errorInfo()[2], $prepared->errorInfo()[1]);
        } catch (\PDOException $e) {
            $this->setErrors($e->getMessage());
        }          
        
        return $this;
    }    
}
