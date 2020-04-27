<?php

function myAutoload($class)
{
    /*if (file_exists("core/".$class.".class.php")) {
        include "core/".$class.".class.php";
    } elseif (file_exists("models/".$class.".model.php")) {
        include "models/".$class.".model.php";
    }*/

    $class = str_replace('www', '', $class);

    $class = str_replace('\\', '/', $class);

    if ($class[0] == '/') {
        include substr($class.'.php', 1);
    }else{
        include $class.'.php';
    }
echo ($class.'.php');
}

spl_autoload_register("myAutoload");

use www\Core\ConstLoader;


new ConstLoader();

$uri = $_SERVER["REQUEST_URI"];

use www\Controllers\DefaultController;
new DefaultController();

$listOfRoutes = yaml_parse_file("routes.yml");

if (!empty($listOfRoutes[$uri])) {
    $c = 'www\Controllers\\'.ucfirst($listOfRoutes[$uri]["controller"]."Controller");
    $a = $listOfRoutes[$uri]["action"]."Action";

    //Est ce que dans le dossier controller il y a une class
    //qui correspond à $c
    /*if (file_exists("controllers/".$c.".class.php")) {*/
        var_dump($c);
        /*if (class_exists($c)) {*/
            $controller = new $c();
            if (method_exists($controller, $a)) {
                $controller->$a();
            } else {
                die("L'action' n'existe pas");
            }
        /*} else {
            die("Le class controller n'existe pas");
        }*/
    /*} else {
        die("Le fichier du controller n'existe pas : controllers/".$c.".class.php");
    }*/
} else {
    die("L'url n'existe pas : Erreur 404");
}
