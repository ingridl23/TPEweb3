<?php
require_once 'libs/Router.php';
require_once 'ApiController/ApiControllerBooks.php';
require_once 'ApiController/ApiControllerAutores.php';
require_once 'ApiController/ApiController.php';


define("BASE_URL", 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].dirname($_SERVER["PHP_SELF"]).'/');


// crea el router
$router = new Router();

// define la tabla de ruteo



$router->addRoute('libros', 'GET','ApiControllerBooks', 'ObtenerBooks');//trae todos los  libros con autor  
$router->addRoute('autores','GET','ApiControllerAutores','ObtenerAutores');//trae todos los autores  

//ordenados por un campo 
$router->addRoute('autores/:ORDER/:FIELD','GET','ApiControllerAutores','ObtenerAutoresByField');//trae autores por campo y ordenados 
//trae libros de forma paginada
$router->addRoute('libros/page/:PAGENUMBER','GET','ApiControllerBooks', 'GetPaginateBooks'); //se obtiene los libros paginados

$router->addRoute('libros/:ORDER/:FIELD','GET', 'ApiControllerBooks','ObtenerLibrosByField'); //libros ordenados y tambien por campo 

$router->addRoute('libros/:ID','GET','ApiControllerBooks','ObtenerBookbyId');//trae un libro en especifico por id 

$router->addRoute('autores/:ID','GET', 'ApiControllerAutores','ObtenerAutorById');//trae autor por id

$router->addRoute('libros','POST', 'ApiControllerBooks', 'CrearLibro');//crea 
$router->addRoute('autores','POST', 'ApiControllerAutores', 'CrearAutor'); //crea 


$router->addRoute('libros/:ID','PUT','ApiControllerBooks','ActuaLizalibroById');//actualiza/modifica libro 

$router->addRoute('autores/:ID','PUT','ApiControllerAutores','ActualizaAutorById');//actualiza/modifica autor   


$router->addRoute('libros/:ID','DELETE','ApiControllerBooks','deleteBook'); // eliminar un libro en especifico 




 

// rutea      // recurso solicitado       // método utilizado
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);