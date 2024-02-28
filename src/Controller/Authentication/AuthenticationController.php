<?php

namespace App\Controller\Authentication;

use App\Class\Controller;
use App\Class\Crud;

class AuthenticationController extends Controller 
{
    private $table = 'user';
    private $crud;

    public function __construct()
    {
        $this->crud = new Crud($this->table); 
    }

    public function manageLogout()
    {
        unset($_SESSION['user']);
        $this->redirect('home');
    }

    public static function getUserSession(){
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        } else {
            return null;
        }
    }
}

?>