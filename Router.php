<?php

  class Router {
    private $post; 
    private $get; 
    private $error;

    public function __construct() {
      $this->post = [];
      $this->get = []; 
    }

    public function get($path, $action) {
      $this->get[$path] = $action; 
    }

    public function post($path, $action) {
      $this->post[$path] = $action; 
    }

    public function error($action) {
      $this->error = $action; 
    }

    public function dispatch() {
      $path = explode('?', $_SERVER['REQUEST_URI'])[0]; 
      $method = strtolower($_SERVER['REQUEST_METHOD']);
      if (isset($this->$method[$path])){
        $action = explode('::', $this->$method[$path]);
      } else {
        $action = explode('::', $this->error);
      }

      $controller = $action[0];
      $function = $action[1];
      
      require_once "controllers/{$controller}.php";
      return (new $controller)->$function();
    }
  }
