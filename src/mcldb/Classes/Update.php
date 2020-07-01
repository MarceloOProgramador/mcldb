<?php

namespace Mcldb\Classes;

use Mcldb\Classes\Connection;

final class Update extends Connection{
    
    /**
     * 
     * @param string $table
     * @param array $params
     * @return \Src\mcldb\Classes\Update
     */    
    public function toUpdate(string $table, array $params) : Update
    {
        $this->setTable($table);
        
        foreach ($params as $key => $value) {
            $this->setFields("{$key} = :{$key}, ");
            $this->setDatas(":{$key}", $value);
        } 
        
        $this->setStatement("UPDATE {$this->getTable()} SET " . substr($this->getFields(), 0, -2));
        
        return $this;
    }
}
