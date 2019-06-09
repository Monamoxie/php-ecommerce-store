<?php
namespace Core;  

abstract class Controller
 {  

    public function __construct() 
    {
       // require_once APP_ROOT . 'core/Model.php';
    } 

     public function render($filename, $data)
     { 
        /** 
        * Output buffering
        * page content to be rendered within default layout
        *
        */
        ob_start();
        if (file_exists(APP_ROOT . 'app/views/' . $filename . '.php')) {
            require APP_ROOT. 'app/views/' . $filename . '.php';
        } else {
            require APP_ROOT. 'app/views/home.php';
        }
        $main_Content = ob_get_clean(); 

        // The default layout page 
        require_once APP_ROOT . 'app/views/templates/layout.php';
     }
  
 }