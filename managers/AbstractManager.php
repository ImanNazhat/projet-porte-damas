<?php

// Declaration of the abstract class AbstractManager
abstract class AbstractManager
{
    // Protected property for the database connection
    protected PDO $db;
    
    // Constructor of the AbstractManager class
    public function __construct()
    {   
        // Building the database connection string
        $connexion = "mysql:host=".$_ENV["DB_HOST"].";port=3306;charset=".$_ENV["DB_CHARSET"].";dbname=".$_ENV["DB_NAME"];
        
        // Initializing the PDO connection
        $this->db = new PDO(
            $connexion,
            $_ENV["DB_USER"],
            $_ENV["DB_PASSWORD"]
        );
    }
}