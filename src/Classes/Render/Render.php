<?php

namespace App\Classes\Render;

use App\Interfaces\Render\RenderInterface;

class Render implements RenderInterface {
    protected $view;
    protected $params;


    public function __construct($view, $params = [])
    {
        $this->view = $view;
        $this->params = $params;

        $this->display($this->view, $this->params);
    }

    public function display(){
        
        ob_start();
        extract($this->params);
        require_once 'src/views/' . $this->view . '.php';
        $tampon = ob_get_contents();
        file_put_contents('/Cache/index.html', $tampon);
        ob_end_clean();
        require_once 'src/views/partials/header.php';
        echo $tampon;
        require_once 'src/views/partials/footer.php';
    }
}



?>