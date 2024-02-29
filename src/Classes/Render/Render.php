<?php

namespace App\Classes\Render;

use App\Interfaces\Render\RenderInterface;

/**
 * Class Render : Classe responsable du rendu des vues.
 * Elle sera ensuite instancier dans un proxy afin de pouvoir précharger des images pour les articles par exemple
 * Exemple illustrant le design pattern : proxy
 */
class Render implements RenderInterface {
    protected $view;
    protected $params;


    public function __construct($view, $params = [])
    {
        $this->view = $view;
        $this->params = $params;

        $this->display($this->view, $this->params);
    }

    /**
     * function display : Formate et rend une vue
     *
     * @return void
     */
    public function display(){

        ignore_user_abort(true);

        ob_flush();
        flush();

        // Si la connexion est perdue on historise les params de la page dans un fichier txt
        if (connection_aborted())
        {
            // On créer un fichier cache comprenant tous les paramètres 
            $fp = fopen('cache/'.$this->view.'.txt', 'w');        
            fwrite($fp, print_r($this->params, true));
            fclose($fp);

            $this->endPacket();
        } 
        else {
           
            // On les récupèrent ensuite pour reformer la view et les reinsérer dans les paramètres actuels
            if (file_exists('cache/'.$this->view.'.txt'))
            {
                $currentHistory = file_get_contents('cache/'.$this->view.'.txt');
                unlink('cache/'.$this->view.'.txt');
            }  
            if (!empty($currentHistory) && empty($this->params))
            {
                var_dump(explode(',',$currentHistory));
                $this->params = $currentHistory;
            } 
            
            $this->vPrint();  
        }

        $this->endPacket();

    }

    public function vPrint()
    {
        // Buffer
        ob_start();
        
        // Extraction des paramètres 
        extract($this->params);
        // Insertion de la vue
        require_once 'src/views/' . $this->view . '.php';
        // Création du tampon de contenu
        $tampon = ob_get_contents();
        // Clean du buffer
        ob_end_clean();
        
        // Header
        require_once 'src/views/partials/header.php';
        // Content
        echo $tampon;
        // Footer
        require_once 'src/views/partials/footer.php';

    }

    public function endPacket()
    {
        echo "\r\n\r\n";
        ob_flush();
        flush();
    }
}



?>