<?php

namespace Core;

use PDO;
use PDOException;
use App\Config;

/**
 * Base model
 *

 */
abstract class Model
{
    protected $db;
    private $stmt;
    private $error;
    
    public function __construct()
    {
        try {
            $dsn = 'mysql:host=' . Config::DB_HOST . ';dbname=' . Config::DB_NAME . ';charset=utf8';
            $this->db = new PDO($dsn, Config::DB_USER, Config::DB_PASSWORD);

            // Throw an Exception when an error occurs
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (PDOException $ex) {
            $this->error = $ex->getMessage();
            echo $this->error;
        }
    }

    public function query($sql)
    {
        $this->stmt = $this->db->prepare($sql);
    }
    
    // Execute the prepared statement
    public function execute()
    {
        return $this->stmt->execute();
    }

    // Get result set as array of objects
    public function resultSet()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Get single record as object
    public function single()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    public function bind($param, $value, $type = null)
    {
      if (is_null($type))
      {
        switch (true) 
        {
          case is_int($value):
            $type = PDO::PARAM_INT;
            break;
  
          case is_bool($value):
            $type = PDO::PARAM_BOOL;
            break;
  
          case is_null($value):
            $type = PDO::PARAM_NULL;
            break;
          
          default:
            $type = PDO::PARAM_STR;
        }
      }
  
      $this->stmt->bindValue($param, $value, $type);
    }

}
