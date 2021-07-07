<?php

namespace Mcldb\Classes;

use Mcldb\Classes\Connection;

class Delete extends Connection
{
    
    public function toDelete($table): Delete
    {
        $this->setStatement("DELETE FROM {$table}");
        
        $this->getInstance()->prepare($this->getStatement());       
        
        return $this;
    }    
}
