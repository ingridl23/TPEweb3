<?php
require_once 'libs/Router.php';
require_once 'Apicontroller/ApiControllerBooks.php';

define("BASE_URL", 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].dirname($_SERVER["PHP_SELF"]).'/');








// crea el router
$router = new Router();

// define la tabla de ruteo
$router->addRoute('TraerLibros', 'GET','ApiControllerBooks', 'ObtenerBooks');
$router->addRoute('Libro/:ID', 'GET','ApiControllerBooks','ObtenerBookbyId');
$router->addRoute('LibroNuevo','POST', 'ApiControllerBooks', 'CrearLibro');
$router->addRoute('Actualizarlibro/:ID', 'PUT', 'ApiControllerBooks', 'ActuaLizalibroById');
$router->addRoute('Borrarlibro/:ID', 'DELETE', 'ApiControllerBooks', 'EliminaLibroById');


// rutea      // recurso solicitado       // método utilizado
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);

