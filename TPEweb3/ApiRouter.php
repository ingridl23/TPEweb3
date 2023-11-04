<?php
require_once 'libs/Router.php';
require_once 'ApiController/ApiControllerBooks.php';
require_once 'ApiController/ApiControllerAutores.php';

define("BASE_URL", 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].dirname($_SERVER["PHP_SELF"]).'/');








// crea el router
$router = new Router();

// define la tabla de ruteo


//tabla de ruteo libros
$router->addRoute('libros/traerlibros', 'GET','ApiControllerBooks', 'ObtenerBooks');//trae todos los  libros con autor
$router->addRoute('autores','GET','ApiControllerAutor','ObtenerAutores');//trae todos los autores

//ordenados por un campo
$router->addRoute('autores/:ORDER/:pais','GET','ApiControllerAutor','ObtenerAutoresByCountry');//trae autores por nacionalidad
$router->addRouter('libros/:ORDER/:titulo','GET','ApiControllerAutor','LibrosByField'); //trae por titulo ordenado asc o desc (ambas)

//trae por cualquier campo ordenado especificando desc o asc  (ambas)        
$router->addRoute('libros/:ORDER/:FIELD','GET','ApiControllerAutor','ObtenerlibrosByFieldByOrder');

$router->addRoute('libros/:ID','GET','ApiControllerBooks','ObtenerBookbyId');//trae un libro en especifico por id

$router->addRoute('libros/libronuevo','POST', 'ApiControllerBooks', 'CrearLibro');//crea
$router->addRoute('libros/actualizarlibro/:ID', 'PUT', 'ApiControllerBooks', 'ActuaLizalibroById');//actualiza/modifica

//trae libros de forma paginada
$router->addRoute('libros/paginarbooks/:PAGENUMBER','GET', 'ApiControllerBooks', 'GetPaginateBooks'); //paginar
//token

 

// rutea      // recurso solicitado       // método utilizado
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);

