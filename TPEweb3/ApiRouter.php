<?php
require_once 'libs/Router.php';
require_once 'ApiController/ApiControllerBooks.php';
require_once 'ApiController/ApiControllerAutores.php';

define("BASE_URL", 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].dirname($_SERVER["PHP_SELF"]).'/');








// crea el router
$router = new Router();

// define la tabla de ruteo


//tabla de ruteo libros
$router->addRoute('traerlibros', 'GET','ApiControllerBooks', 'ObtenerBooks');//trae todos los  libros con autor
$router->addRoute('libros/:ID', 'GET','ApiControllerBooks','ObtenerBookbyId');//trae un libro en especifico
$router->addRouter('libros/:FIELD','GET','ApiControllerAutor','AutoresByLibros'); //trae por titulo ordenado alfabeticamente
$router->addRoute('libronuevo','POST', 'ApiControllerBooks', 'CrearLibro');//crea
$router->addRoute('actualizarlibro/:ID', 'PUT', 'ApiControllerBooks', 'ActuaLizalibroById');//actualiza/modifica

//tabla de ruteo autores
$router->addRoute('autores','GET','ApiControllerAutor','ObtenerAutores');//trae autores
$router->addRoute('autores/:FIELD','GET','ApiControllerAutor','ObtenerAutoresByCountry');//trae autores por nacionalidad
                        //nacionalidad
$router->addRoute('autoresfield/:FIELD','GET','ApiControllerAutor','ObtenerAutoresByField');//trae por cualquier campo ordenado desc

// rutea      // recurso solicitado       // método utilizado
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);

