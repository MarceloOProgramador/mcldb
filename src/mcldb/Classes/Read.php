<?php 

namespace Mcldb\Classes;

use Mcldb\Classes\Connection;

class Read extends Connection
{
    
    public function toRead(string $table, array $fields = null) : Read
    {
        $fields_statement = "";
        
        if(is_null($fields))
            $statement = "SELECT * FROM {$table}";
        else{
            foreach ($fields as $field)
                $fields_statement .= "{$field}, ";
            
            $fields_statement = substr($fields_statement, 0, -2);
            $statement = "SELECT {$fields_statement} FROM {$table}";
        }
        
        $this->setStatement($statement);   
        
        return $this;
    }
    
    public function fetch():array
    {
        $prepared = $this->getInstance()->prepare($this->getStatement());
        $datas = [];
        
        try{
            $prepared->execute();            
            $datas = $prepared->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            echo "Error:" . $e->getMessage();
        }
        
        return $datas;
    }
}
