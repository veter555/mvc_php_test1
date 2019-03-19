<?php

class Controller {

    protected $title = null; 
    protected $view = null; 
    protected $registry = array();
    

    public function setView($view = null) {
        if ($view === null) {
            $view = debug_backtrace()[1]['function'];
        }
        if ( strpos($view, 'Action') > 0) {
            $view = substr($view, 0, strpos($view, 'Action'));
        }
        $this->view = $view;
    }
    
    public function getView() {
        return $this->view === null ? '404' : $this->view;
    }
    
    public function renderPartialview($view_name) {
        $view_path = ROOT . '/app/views/' . $view_name . '.php';
        if(file_exists($view_path)) {
            include $view_path;
        }

        
    }

    public function renderView() {
        if ($this->getView() ==="404") {
            $class_name = "ErrorController";
        } else {
            $class_name = get_called_class();
        }
        $controller = substr($class_name, 0, strpos($class_name, 'Controller'));
        $view_path = ROOT . '/app/views/' . strtolower($controller) . '/' . strtolower($this->getView()) . '.php';
       
        if(file_exists($view_path)) {
            include $view_path;
            
        }
    }
    
    public function renderLayout($layout = "index") {
        if(file_exists(ROOT . '/app/views/index/'.$layout.'.php')) {
            include ROOT . '/app/views/index/'.$layout.'.php';
        }      
    }

    function __call($name, $args) {
        $this->setView('404');
        $this->renderLayout('layout_404');
    }
    
    public function getModel($name) {
        $model = new $name();
        return $model;
    }

    
}