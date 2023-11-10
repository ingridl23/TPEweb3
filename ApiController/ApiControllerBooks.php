<?php
require_once 'Model/modelBooks.php';
require_once 'ApiController/ApiController.php';

class ApiControllerBooks extends ApiController {
   
    private $model;
 

 function __construct(){
    parent::__construct();
    $this->model = new ModelBooks();
    
}


 function ObtenerBooks() {
        
        $books = $this->model->GetBooks();
        
          $this->view->response($books, 200);
       
  }

  public function ObtenerBookbyId($params = []) {
       $Id = $params[':ID'];
    if(is_numeric($Id)){
      $book = $this->model->GetbookById($Id);
      if ($book) {
        $this->view->response($book, 200);
      } else {
        $this->view->response("No existe el libro con el id={$Id} indicado", 404);
      };
    } else {
      $this->view->response("Asegurese que el ID escrito sea numerico", 400);
    };
  }


public function CrearLibro() { 
  //if ($this->secHelper->isLoggedIn()) {
    $body = $this->getData();
    if (!empty($body->titulo) && !empty($body->anio) && !empty($body->descripcion) && !empty($body->idAutor)){
         $titulo = $body->titulo;
         $date = $body->anio;
        $descripcion = $body->descripcion;
        $idautor = $body->idAutor;


        $newBook = $this->model->InsertBook($titulo,$date,$descripcion,$idautor);
   if($newBook) {
        $this->view->response("Se ha creado un nuevo libro con la id = '{$newBook}' ",201);
      } else {
        $this->view->response("El libro no fue creado", 500);
      };
    } else {
      $this->view->response("No se ha podido crear un nuevo libro, asegurese de colocar todos los campos de la tabla ", 400);
    }//else {
     // $this->view->response("Necesitas estar logueado para realizar la request", 401);
  //} 
    }
    
      
    
     



 function ActualizaLibroById($params=null){
   // if ($this->Helper->validateuser()) {
             if (isset($params[':ID'])){

               $id =  $params [':ID'];
             }
               if (is_numeric($id)) {
                $body = $this->getData();
                 if(empty($body->titulo)|| empty($body->anio)|| empty($body->descripcion)){
                   $this->model->updatelibros($body->titulo,$body->anio,$body->descripcion, $id);
                   $this->view->response("El libro con id = '{$id}' fue editado", 200);    
                 }
                  else {
                       $this->view->response("No se pudo editar el libro con id = '{$id}', asegurarse de colocar todos los campos de la tabla", 400);
                                      };
                                     } else {
          $this->view->response("No existe un libro con id = '{$id}' ", 404);
     // }
}
 }

function deleteBook($params=[]){

 // if ($this->Helper->validateuser()){
           if(isset($params[':ID'])){

             $id = $params [':ID'];
           }

        $libro= $this->model->GetbookById($id);

           if($libro){
         
                $this->model->deleteBook($id);
                $this->view->response($libro,200);
                  }else{
                      $this->view->response("No hay libros para eliminar con el id= $id",404);
                     }
                       }
                         
                           


                      function ObtenerLibrosByField($params = []) {
                            if (isset($params[':FIELD'])) {
                                $fieldOrder = $params[':FIELD'];
                            } else {
                                $fieldOrder = 'titulo'; 
                            };
                                $columnNames = $this->model->getColumns();
                                   for ($i=0; $i < count($columnNames) ; $i++) { 
                                       if($columnNames[$i] == $fieldOrder){
                                          $validateField = $fieldOrder;
                                           }
                            } 
                                  if (isset($params[':ORDER'])) {
                                     $order = 'desc'; 
                                      } else {
                                        $order = 'asc'; 
                                                        };
                                           if (isset($validateField)) {
                                               $orderedLibros = $this->model->getOrderlibros($validateField, $order);
                                                return $this->view->response($orderedLibros, 200);
                                                  } else {
                                                      return $this->view->response("no existe el campo designado para ordenar = '{$fieldOrder}' en la tabla de Libros", 404);
                                                               };
                                                                   }


                        function GetPaginateBooks($params = []) {
                         
                          $pageNumber = intval($params[':PAGENUMBER']); 
                          $books = $this->model->GetBooks();
                          $totalBooks = count($books); 
                          $BookspageSize = 2; 
                          $startFrom = ($pageNumber - 1) * $BookspageSize; 
                          $totalPages = ceil($totalBooks / $BookspageSize);
                      
                          if ($pageNumber > 0 && $pageNumber <= $totalPages) {
                              $page = $this->model->pagesBooks($startFrom, $BookspageSize); 
                                  $this->view->response($page, 200);
                          } else {
                              $this->view->response("la pagina no existe", 404);
                          }
                      }
                    }
                