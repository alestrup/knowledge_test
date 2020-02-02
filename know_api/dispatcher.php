<?php

require(ROOT . 'Models/User.php');

class Dispatcher
{

    private $request;

    public function dispatch()
    {
        $this->request = new Request();
        Router::parse($this->request->url, $this->request);

        if(!isset($this->request->action)){
            http_response_code(404);
        }
        else{
            $controller = $this->loadController();
            call_user_func_array([$controller, $this->request->action], $this->request->params);
        }

    }

    public function loadController()
    {
        $name = $this->request->controller . "Controller";
        $file = ROOT . 'Controllers/' . $name . '.php';
        require($file);
        $controller = new $name();
        return $controller;
    }

}
?>