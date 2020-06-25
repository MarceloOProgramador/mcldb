<?php

namespace Src\mcldb\Classes;

use PDO;

class Connection {
    
    private ?PDO    $instance = null;
    private string  $errors = "";
    private string  $statement = "";
    private array   $options = [];
    private string  $host = "";
    private string  $db = "";
    private string  $password = "";
    private string  $root = "";
    private array   $datas = [];
    private string  $table;
    private string  $fields = "";
    
    public function __construct(string $host, string $root, string $password, string $db, array $options = [])
    {
        if($this->instance == null)
        {
            $this->setHost($host);
            $this->setRoot($root);
            $this->setPassword($password);
            $this->setDb($db);
            $this->setOptions($options);
            
            $this->toConnect();
        }
    }
    
    /**
     * 
     * @param string $field
     * @param string $operator
     * @param string $key
     * @return void
     */
    public function where(string $field, string $operator = "=", string $key) : Connection
    {
        $statement = $this->getStatement() . " WHERE {$field} {$operator} " . "'${key}'";
        $this->setStatement($statement);
        
        return $this;
    }
    
    /**
     * 
     * @return bool
     * @throws \PDOException
     */
    public function exec():bool
    {
        try{
            $prepared = $this->getInstance()->prepare($this->getStatement());
            
            if($this->getDatas() !== null)
            {
                $executed = $prepared->execute($this->getDatas());
            }else{
                $executed = $prepared->execute();
            }
            
            if($prepared->errorCode())
                throw new \PDOException($prepared->errorInfo()[2], $prepared->errorInfo()[1]);
            
        } catch (\PDOException $ex) {
            $this->setErrors($ex->getMessage());
        }
        
        return $executed;     
    }
    
    /**
     * 
     * @return void
     */
    private function toConnect() : void
    {
        $dns = "mysql:dbname={$this->getDb()};host={$this->getHost()}";
        
        try{
            $pdo = new PDO($dns, $this->getRoot(), $this->getPassword(), $this->getOptions());
            $this->setInstance($pdo);
        } catch (\PDOException $ex) {
            $this->setErrors($ex->getMessage());
        }
       
        return;
    }
    
    /**
     * 
     * @return PDO
     */
    public function getInstance(): PDO 
    {
        return $this->instance;
    }

    /**
     * 
     * @return string
     */
    public function getErrors(): string 
    {
        return $this->errors;
    }

    /**
     * 
     * @return string
     */
    public function getStatement(): string 
    {
        return $this->statement;
    }

    /**
     * 
     * @return array
     */
    public function getOptions(): array 
    {
        return $this->options;
    }

    /**
     * 
     * @return string
     */
    public function getHost(): string 
    {
        return $this->host;
    }

    /**
     * 
     * @return string
     */
    public function getDb(): string 
    {
        return $this->db;
    }

    /**
     * 
     * @return string
     */
    public function getPassword(): string 
    {
        return $this->password;
    }

    /**
     * 
     * @param PDO $instance
     * @return void
     */
    public function setInstance(PDO $instance): void 
    {
        $this->instance = $instance;
    }

    /**
     * 
     * @param string $errors
     * @return void
     */
    public function setErrors(string $errors): void 
    {
        $this->errors = $errors;
    }

    /**
     * 
     * @param string $statement
     * @return void
     */
    public function setStatement(string $statement): void 
    {
        $this->statement = $statement;
    }

    /**
     * 
     * @param array $options
     * @return void
     */
    public function setOptions(array $options): void 
    {
        $this->options = $options;
    }

    /**
     * 
     * @param string $host
     * @return void
     */
    public function setHost(string $host): void 
    {
        $this->host = $host;
    }

    /**
     * 
     * @param string $db
     * @return void
     */
    public function setDb(string $db): void 
    {
        $this->db = $db;
    }

    /**
     * 
     * @param string $password
     * @return void
     */
    public function setPassword(string $password): void 
    {
        $this->password = $password;
    }
    
    /**
     * 
     * @param string $root
     * @return void
     */
    public function setRoot(string $root) : void
    {
        $this->root = $root;
    }
    
    /**
     * 
     * @return string
     */
    public function getRoot():string
    {
        return $this->root;
    }
    
    /**
     * 
     * @return array
     */
    public function getDatas(): array {
        return $this->datas;
    }

    /**
     * 
     * @return string
     */
    public function getTable(): string {
        return $this->table;
    }

    /**
     * 
     * @return string
     */
    public function getFields(): string {
        return $this->fields;
    }

    /**
     * 
     * @param string $key
     * @param type $value
     * @return void
     */
    public function setDatas(string $key, $value): void {
        $this->datas[$key] = $value;
    }

    /**
     * 
     * @param string $table
     * @return void
     */
    public function setTable(string $table): void {
        $this->table = $table;
    }

    /**
     * 
     * @param string $fields
     * @return void
     */
    public function setFields(string $field): void {
        $this->fields .= $field;
    }
}
