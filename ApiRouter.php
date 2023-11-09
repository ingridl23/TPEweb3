<?php
require_once 'libs/Router.php';
require_once 'ApiController/ApiControllerBooks.php';
require_once 'ApiController/ApiControllerAutores.php';
require_once 'ApiController/ApiController.php';
require_once 'ApiController/AuthHelper.php';

define("BASE_URL", 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].dirname($_SERVER["PHP_SELF"]).'/');


// crea el router
$router = new Router();

// define la tabla de ruteo



$router->addRoute('libros', 'GET','ApiControllerBooks', 'ObtenerBooks');//trae todos los  libros con autor  //ya anda//
$router->addRoute('autores','GET','ApiControllerAutores','ObtenerAutores');//trae todos los autores  //ya anda//

//ordenados por un campo 
$router->addRoute('autores/:ORDER/:FIELD','GET','ApiControllerAutores','ObtenerAutoresByField');//trae autores por campo ordenados // ya anda

$router->addRoute('libros/:ORDER/:FIELD','GET', 'ApiControllerBooks','ObtenerLibrosByField'); //libros ordenados  // ya anda

$router->addRoute('libros/:ID','GET','ApiControllerBooks','ObtenerBookbyId');//trae un libro en especifico por id //ya anda

$router->addRoute('autores/:ID','GET', 'ApiControllerAutores','ObtenerAutorById');//trae autor por id  // ya anda

$router->addRoute('libros','POST', 'ApiControllerBooks', 'CrearLibro');//crea //todavia no anda
$router->addRoute('autores/:ID','POST', 'ApiControllerAutores', 'CrearAutor'); //crea //todavia no anda

$router->addRoute('libros/:ID','PUT','ApiControllerBooks','ActuaLizalibroById');//actualiza/modifica  //ya anda

$router->addRoute('libros/:ID','DELETE','ApiControllerBooks','deletebook'); // eliminar un libro en especifico //ya anda

//trae libros de forma paginada
$router->addRoute('libros/page/:PAGENUMBER','GET','ApiControllerBooks', 'GetPaginateBooks'); //paginar //todavia no anda me salta a otra funcion segun chat gpt no encuentra ningun error
//token
$router->addRoute("auth/token", 'GET', 'AuthApiController','getToken'); //no se a probado
 

// rutea      // recurso solicitado       // método utilizado
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);