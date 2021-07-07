<?php

namespace Mcldb\Classes;

use PDO;
use PDOException;

class Connection {
    
    private ?PDO    $instance = null;
    private string  $errors = "";
    private string  $statement = "";
    private array   $options = [];
    private string  $host = "";
    private string  $db = "";
    private string  $password = "";
    private string  $user = "";
    private array   $datas = [];
    private string  $table;
    private string  $fields = "";
    
    public function __construct()
    {
        if($this->instance == null)
        {
            $this->setHost($_SERVER['DB_HOST']);
            $this->setUser($_SERVER['DB_USER']);
            $this->setPassword($_SERVER['DB_PASS']);
            $this->setDb($_SERVER['DB_NAME']);
            $this->setOptions(is_array($_SERVER['DB_OPTIONS']) ? $_SERVER['DB_OPTIONS'] : array());
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
    public function exec() : bool
    {
        try{
            $prepared = $this->getInstance()->prepare($this->getStatement());

            if(!!$this->getDatas())
                $prepared->execute($this->getDatas());
            else
               $prepared->execute();

            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        } 
    }
    
    /**
     * 
     * @return void
     */
    public function toConnect() : void
    {
        $dns = "mysql:dbname={$this->getDb()};host={$this->getHost()}";
        try{
            $pdo = new PDO($dns, $this->getUser(), $this->getPassword(), $this->getOptions());
            $this->setInstance($pdo);
            $this->getInstance()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
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
     * @param string $user
     * @return void
     */
    public function setUser(string $user) : void
    {
        $this->user = $user;
    }
    
    /**
     * 
     * @return string
     */
    public function getUser():string
    {
        return $this->user;
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
