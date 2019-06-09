<?php
namespace Core;

abstract class Model 
{
    protected $db;
    protected $session;  

    public function __construct() 
    {  
        require_once ("Database.php");
        $instance = Database::getInstance(); 
        $this->db = $instance;
        
        require_once ("Session.php");
        $this->session = new Session();
    }
} 