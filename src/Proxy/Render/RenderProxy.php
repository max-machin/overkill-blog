<?php

namespace App\Proxy\Render;

// Classe
use App\Classes\Render\Render;
// Interface
use App\Interfaces\Render\RenderInterface;

/**
 * Class RenderProxy : Proxy charger d'instancier une classe Render pour rendre utilisable la fonction display et render une vue
 * Exemple illustrant le design pattern : proxy
 */
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

    /**
     * function display : Instancie un nouveau render et display la view
     *
     * @return void
     */
    public function display(){
        if (!$this->render){
            $this->render = new Render($this->view, $this->params);
        } 

        $this->render->display($this->view, $this->params);
    }
}


?>