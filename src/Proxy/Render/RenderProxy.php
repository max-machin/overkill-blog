<?php

namespace App\Proxy\Render;

use App\Classes\Render\Render;
use App\Interfaces\Render\RenderInterface;

class RenderProxy implements RenderInterface {
    protected $view;
    protected $params;
    protected $render;

    public function __construct($view, $params = [])
    {
        $this->view = $view;
        $this->params = $params;

        $this->display($this->view, $this->params);
    }

    public function display(){
        if (!$this->render){
            $this->render = new Render($this->view, $this->params);
        } 

        $this->render->display($this->view, $this->params);
    }
}


?>