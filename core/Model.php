<?php
namespace Core;

abstract class Model 
{
    protected $db;
    protected $session;  

    public function __construct() 
    {  
        
        $instance = Database::getInstance(); 
        $this->db = $instance;
        $this->session = new Session();
    }
} 