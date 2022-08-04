<?php

namespace App\Middleware;
use App\Core\Middleware;

class RouteMiddleware 
{

    public function middleware()
    {
        $uri = explode("/", $_SERVER["REQUEST_URI"]);

        //unset($uri[0]);
        //$target = '/' . array_shift($uri);

        $target = '/' . $uri[1];

        //$parameters = array_splice($uri, 0, 2);

        $routeFile = "routes.yml";

        if(!file_exists($routeFile)){
            die("Le fichier ".$routeFile." n'existe pas");
        }
        
        $routes = yaml_parse_file($routeFile);

        if( empty($routes[$target]) ||  empty($routes[$target]["controller"])  ||  empty($routes[$target]["action"]) || empty($routes[$target]["role"]) ){           
            http_response_code(404);
            include('Exceptions/404.php');
            die();
        }

        $role = array_map('strtolower', ($routes[$target]["role"]));

        /*
        *
        *  Vérfification de la sécurité, est-ce que la route possède le paramètr rôle
        *  Si oui est-ce que l'utilisation a les droits et surtout est-ce qu'il est connecté ?
        *  Sinon rediriger vers la home ou la page de login
        *
        */

        if(!in_array('none', $role)){

            if(isset($_SESSION['role'])){ //si l'utilisateur est connecté

                if(!in_array($_SESSION['role'],$role)){ 
                    header('Location: /');
                }
            }else{ //sinon 
                header('Location: /login');
            }
        }

        $controller = ucfirst(strtolower($routes[$target]["controller"]));
        $action = strtolower($routes[$target]["action"]);

        $controllerFile = "Controller/".$controller."Controller.php";
        if(!file_exists($controllerFile)){
            die("Le controller ".$controllerFile." n'existe pas");
        }

        include $controllerFile;

        $controller = "App\\Controller\\".$controller."Controller";
        if( !class_exists($controller)){
            die("La classe ".$controller." n'existe pas");
        }

        $objectController = new $controller();

        if( !method_exists($objectController, $action)){
            die("L'action ".$action." n'existe pas");
        }

        $objectController->$action();

    }

}
