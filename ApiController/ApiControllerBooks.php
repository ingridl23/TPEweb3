<?php
require_once 'Model/modelBooks.php';
class ApiControllerBooks{
   
    private $model;
    private $view;

function __construct(){
    $this->model = new ModelBooks();
    $this->view=new ApiView($this);
    
}


    function ObtenerBooks($params = []) {
        $books = $this->model->GetBooks();
        return $this->view->response($books, 200);
  }

  function ObtenerBooksById($params = []) {
    // obtiene el parametro de la ruta
    $id = $params[':ID'];
        
    $booksId = $this->model->GetbookById($id);
    
    if ($booksId) {
        $this->view->response($booksId, 200);   
    } else {
        $this->view->response("No existe el libro con el id={$id}", 404);
    }

}

function CrearLibro(){

}


  
}

function ActualizaLibroByid(){

}

function EliminaLibroById(){

}
