<?php
require_once 'Model/modelBooks.php';
require_once 'ApiController/AuthHelper.php';
require_once 'Apiviews/ApiView.php';
class ApiControllerBooks{
   
    private $model;
    private $view;
    private $data;
    private $helper;
function __construct(){
    $this->model = new ModelBooks();
    $this->view=new ApiView($this);
    $this->data = file_get_contents("php://input"); 
    $this->helper= new Helper();
    
}

function getData(){ 
    return json_decode($this->data); 
}  



 function ObtenerBooks() {
        
        $books = $this->model->GetBooks();
        
          $this->view->response($books, 200);
         //return $bookss;
  }

  function ObtenerBooksById($params = []) {
    // obtiene el parametro de la ruta
    if (is_numeric(isset($params[':ID']))) {
        $id= $params[':ID'];
      }
    $booksId = $this->model->GetbookById($id);
    
    if ($booksId) {
        $this->view->response($booksId, 200);   
    } else {
        $this->view->response("No existe el libro con el id='{$id}'", 404);
    }

}

function CrearLibro(){
     // devuelve el objeto JSON enviado por POST     
     if ($this->helper->ValidateUser()) {
     $newBook = $this->getData();

     // inserta la tarea
     $titulo = $newBook->titulo;
     $anio= $newBook->anio;
     $descripcion = $newBook->descripcion;
     $autor = $newBook->idAutor;
     $libronuevo=$this->model->InsertBook($titulo,$anio,$descripcion,$autor);
     
    $libroInsertado= $this->model->ObtenerBooksById($libronuevo);

     if ($libroInsertado)
            $this->view->response($libroInsertado, 201);
        else
            $this->view->response("El libro no fue creado", 400);


} else {
    $this->view->response("Necesitas estar logueado para realizar la request", 401);
  };


  
}

 function ActualizaLibroByid(){
    if ($this->Helper->validateuser()) {
        $id = $params[':ID'];
        if (is_numeric($id)) {
            $body = $this->getData();
            $body = $body->titulo;
            $anio = $body->anio;
            $descripcion= $body->descripcion;
           
            $this->model->updatelibros($titulo, $anio, $descripcion, $id);
        }  $this->view->response("El libro con id = '{$id}' fue editado", 200);
    } else {
      $this->view->response("No se pudo editar el libro con id = '{$id}', asegurarse de colocar todos los campos de la tabla", 400);
    };
  } else {
        $this->view->response("No existe un libro con id = '{$id}' ", 404);
      };
}




