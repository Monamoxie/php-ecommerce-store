<?php
require "config/constants.php";
require "core/Model.php";

class TableCreator extends Model 
{

    private $output;
    public function createProductTable()
    {
        if (!$this->db->runQuery("CREATE TABLE IF NOT EXISTS products
        (   id INT(11) AUTO_INCREMENT,
            name VARCHAR(255) NOT NULL,
            price decimal (11, 2) NOT NULL,
            image VARCHAR(255) NOT NULL,
            caption VARCHAR(140) NOT NULL,
            total_rate_points INT(11) NOT NULL DEFAULT '0',
            total_raters INT(11) NOT NULL DEFAULT '0',
            average_rating INT(11) NOT NULL DEFAULT '0',
            date_uploaded DATETIME,
            status ENUM('active', 'inactive') NOT NULL DEFAULT 'active',
            PRIMARY KEY(id)
        ) ") )
        {
            $this->output .= '<strong>ERROR:</strong> An error occured while creating the Product Table';
        }
        else 
        {
            $this->output .= '<strong>SUCCESS:</strong> <strong> Product Table </strong> was <strong> successfully </strong> created'; 

            // Insert Dummy Data
            $dummyProducts = ['apple' => '0.3', 'beer' => '2', 'water' => '1',  'cheese' => '3.74'];
            $this->output .= '<p> --------------------- </p>';
            foreach ($dummyProducts as $key => $product)
            {
                $data = [
                    'name' => $key,
                    'price' => $product,
                    'image' => $key.'.png',
                    'caption' => 'This is the best '.$key.' in the world wide world',
                    'date_uploaded' => date("Y-m-d H:i:s")         
                ];
                if (!$this->db->InsertData("products", $data)) {
                    $this->output .= '<p><strong>An Error</strong> occured while inserting the <strong>'.ucfirst($key).'</strong> record';
                }
                else {
                    $this->output .= '<p><strong> '.ucfirst($key).' record </strong> was <strong> successfully </strong> inserted </p>';
                }
            }   
        }
        return $this->output;
    }
}

// Create an instance of the class
$tables_Creator = new TableCreator();
// Remove the comment from the echo statement below when you wish to call and run file in browser via

//https:// domain/table_creator.php

/*
****************

echo $tables_Creator->createProductTable(); 

*****************/