<?php

namespace App\Router\Routes;

use App\Authentication\Auth;
use App\Controller\Authentication\AuthenticationController;
use App\Controller\Authentication\AuthenticationFacadeController;
use App\Proxy\Render\RenderProxy;
use App\Router\Router;

class AuthenticationRoutes
{
    public function __construct(Router $router)
    {
        // Register 
        $router->get('/register', function () {
            try {
                $proxy = new RenderProxy('register');
                $proxy->display();
            } catch (\Exception $e) {
                $proxy->display('register', ['error' => $e->getMessage()]);
                // $controller->render('register', ['error' => $e->getMessage()]);
            }
        }, "register");
        
        $router->post('/register', function () {
            try {
                $controller = new AuthenticationFacadeController();
                $controller->signUpNewUser($_POST['email'], $_POST['password'], $_POST['password_confirm'], $_POST['firstname'], $_POST['lastname']);
            } catch (\Exception $e) {
                $controller->render('register', ['error' => $e->getMessage()]);
            }
        }, "register");

        // Login
        $router->get('/login', function () {
            $controller = new AuthenticationController();
            $controller->render('login');
        }, "login");
        
        $router->post('/login', function () {
            try {
                $controller = new AuthenticationFacadeController();
                $controller->loginSelf($_POST['email'], $_POST['password']);
            } catch (\Exception $e) {
                $proxy = new RenderProxy('login', ['error' => $e->getMessage()]);
                $proxy->display();
            }
        }, "login");

        // Logout 
        $router->get('/logout', function () {
            $controller = new AuthenticationController();
            $controller->manageLogout();
        }, "logout");
    }
}

?>