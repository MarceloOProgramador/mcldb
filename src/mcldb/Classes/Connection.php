<?php

namespace Src\mcldb\Classes;

use PDO;

class Connection {
    
    private ?PDO    $instance = null;
    private string  $errors;
    private string  $statement;
    private array   $options;
    private string  $host;
    private string  $db;
    private string  $password;
    private string  $root;
    
    public function __construct(string $host, string $root, string $password, string $db, array $options = [])
    {
        $this->setHost($host);
        $this->setRoot($root);
        $this->setPassword($password);
        $this->setDb($db);
        $this->setOptions($options);
        
        if($this->instance == null)
        {
            $this->toConnect();
        }
    }
    
    public function toConnect() : bool
    {
        $dns = "mysql:dbname={$this->getDb()};host={$this->getHost()}";
        
        try{
            $pdo = new PDO($dns, $this->getRoot(), $this->getPassword(), $this->getOptions());
            $this->setInstance($pdo);
        } catch (Exception $ex) {
            $this->setErrors($ex->getMessage());
        }
       
        return true;
    }
    
    public function getInstance(): PDO {
        return $this->instance;
    }

    public function getErrors(): string {
        return $this->errors;
    }

    public function getStatement(): string {
        return $this->statement;
    }

    public function getOptions(): array {
        return $this->options;
    }

    public function getHost(): string {
        return $this->host;
    }

    public function getDb(): string {
        return $this->db;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function setInstance(PDO $instance): void {
        $this->instance = $instance;
    }

    public function setErrors(string $errors): void {
        $this->errors = $errors;
    }

    public function setStatement(string $statement): void {
        $this->statement = $statement;
    }

    public function setOptions(array $options): void {
        $this->options = $options;
    }

    public function setHost(string $host): void {
        $this->host = $host;
    }

    public function setDb(string $db): void {
        $this->db = $db;
    }

    public function setPassword(string $password): void {
        $this->password = $password;
    }
    
    public function setRoot(string $root) : void
    {
        $this->root = $root;
    }
    
    public function getRoot():string
    {
        return $this->root;
    }
}
