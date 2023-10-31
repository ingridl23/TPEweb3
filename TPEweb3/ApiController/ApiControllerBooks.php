<?php
require_once 'Model/modelBooks.php';
class ApiControllerBooks{
   
    private $model;
    private $view;
    private $data;
function __construct(){
    $this->model = new ModelBooks();
    $this->view=new ApiView($this);
    $this->data = file_get_contents("php://input"); 

    
}

function getData(){ 
    return json_decode($this->data); 
}  



    function ObtenerBooks($params = []) {
        
        $books = $this->model->GetBooks();
        
          $this->view->response($books, 200);
         //return $bookss;
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
     // devuelve el objeto JSON enviado por POST     
     $newBook = $this->getData();

     // inserta la tarea
     $titulo = $newBook->titulo;
     $anio= $newBook->anio;
     $descripcion = $newBook->descripcion;
     $autor = $newBook->idAutor;
    $libronuevo=$this->model->InsertBook($titulo,$anio, $descripcion,$autor);
     
    $libroInsertado= $this->model->ObtenerBooksById($libronuevo);

     if ($libroInsertado)
            $this->view->response($libroInsertado, 200);
        else
            $this->view->response("El libro no fue creado", 500);


}


  
}

function ActualizaLibroByid(){

}

function EliminaLibroById(){
    $id = $params[':ID'];
    $bookEliminado = $this->model->get($id);
    if ($bookEliminado) {
        $this->model->DeleteBook($id);
        $this->view->response("El libro fue borrado con exito.", 200);
    } else
        $this->view->response("El libro con el id={$id} no existe", 404);
}


