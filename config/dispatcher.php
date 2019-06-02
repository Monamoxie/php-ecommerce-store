<?php
class Dispatcher
{
    private $request;
    public $router;

    public function dispatch()
    {
        $this->request = new Request();  
        $this->router = new Router(); 
        $this->router->routeParser($this->request, $this->request->url);
        $controller = $this->loadController();   
        call_user_func_array([$controller, $this->request->action], $this->request->params);
    }

    public function loadController()
    {
        $name = ucfirst($this->request->controller) . "Controller";
        require APP_ROOT . 'core' . '/' . 'Controller.php';   
        $file = APP_ROOT . 'app/controllers/' . $name . '.php';
        require $file;
        $controller = new $name();
        return $controller;
    }

}