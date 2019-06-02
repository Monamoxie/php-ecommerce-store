<?php

    class Request
    {
        public $url;
        public $controller;
        public $public_Root_Folder;

        public function __construct()
        { 
            $this->url = $_SERVER["REQUEST_URI"]; 
        }
    }

?>