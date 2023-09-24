<?php 

namespace App;


class Router{

    
    private $router;
    public $chemin;
    public $layout = '/layout/default';

    public function __construct($chemin){
        $this->chemin = $chemin;
        $this->router = new \AltoRouter;
    }

    public function get($tag, $path, $title = null){
        
        $this->router->map('GET', $tag, $path, $title);
        return $this;
    }

    public function post($tag, $path, $title = null){
        
        $this->router->map('POST', $tag, $path, $title);
        return $this;
    }

    public function url (string $name, array $params = []){
        return $this->router->generate($name, $params);
    }
    public function run(){
        $match = $this->router->match();
        $view = $match['target'];
        $params = $match['params'];
        $router = $this;
        
            ob_start();
            require $this->chemin . '/' . $view ;
            $content = ob_get_clean();
            
            require $this->chemin .'/'. $this->layout.'.php';
       
      
        return $this;
    }
    public function match($tag, $path, $title = null){
        
        $this->router->map('POST|GET', $tag, $path, $title);
        return $this;
    }
}