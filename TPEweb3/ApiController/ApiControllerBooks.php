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

 function ObtenerBooks($params=null) {
        
        $books = $this->model->GetBooks();
        
          $this->view->response($books, 200);
       
  }

  function ObtenerBooksById($params = []) {
    // obtiene el parametro de la ruta
    if (is_numeric(isset($params[':ID']))) {
        $id= $params[':ID'];
        $booksId = $this->model->GetbookById($id);

      }

    if ($booksId) {
        $this->view->response($booksId, 200);   
    } else {
        $this->view->response("No existe el libro con el id='{$id}'", 404);
    }

}

function CrearLibro($params=null){
     // devuelve el objeto JSON enviado por POST 

     if ($this->helper->ValidateUser()){
     $newBook = $this->getData();

     // inserta la tarea
     if(empty($newBook->titulo)||empty($newBook->anio)|| empty($newBook->descripcion) || empty($newBook->idAutor)){
      $this->view->response("El libro no fue creado, complete los campos", 400);

     }else{
      $libronuevo=$this->model->InsertBook($newBook->titulo,$newBook->anio,$newBook->descripcion,$newBook->idAutor);
      $this->view->response("libro insertado con exito"$libroInsertado,201);
     }   

} else {
   $this->view->response("Necesitas estar logueado para realizar la request", 401);
  }
  
}

 function ActualizaLibroByid(){
    if ($this->Helper->validateuser()) {
         $id = $params[':ID'];
             if (is_numeric($id)) {
                $body = $this->getData();
                 if(empty($body->titulo)|| empty($body->anio)|| empty($body->descripcion)){
                  $this->model->updatelibros($body->titulo,$body->anio,$body->descripcion, $id);
                  $this->view->response("El libro con id = '{$id}' fue editado", 200);    
                 }
           
                   
               } else {
                      $this->view->response("No se pudo editar el libro con id = '{$id}', asegurarse de colocar todos los campos de la tabla", 400);
                                     };
     } else {
           $this->view->response("No existe un libro con id = '{$id}' ", 404);
      }
}

function deleteBook($params=null){

  if ($this->Helper->validateuser()){
        $id = $params [':ID'];

        $libro= $this->model->GetbookById($id);

           if($libro){
         
                $this->model->deleteBook($id);
                $this->view->response($libro,200);
                  }else{
                      $this->view->response("No hay libros para eliminar con el id= $id",404);
                     }
                       }
                         }
                           }



