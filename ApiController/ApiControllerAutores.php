<?php
require_once 'Model/modelAutores.php';

require_once 'Apiviews/ApiView.php';

class ApiControllerAutores{
  
    private $model;
    private $view;
    private $data;
    private $helper;

function __construct(){
    $this->model = new modeloAutor();
    $this->view=new ApiView($this);
    $this->data = file_get_contents("php://input"); 
   // $this->helper= new Helper();
    
}

function getData(){ 
    return json_decode($this->data); 
}  


  function ObtenerAutores(){
       $autores= $this->model->getautores();
       $this->view->response($autores, 200);
    }

    public function ObtenerAutoresByField($params = []) {
        if (isset($params[':FIELD'])) {
          $fieldOrder = $params[':FIELD'];
        } else {
          $fieldOrder = 'nombreApellido'; 
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
          $orderedAutores = $this->model->getOrderAutores($validateField, $order);
          return $this->view->response($orderedAutores, 200);
        } else {
          return $this->view->response("no existe el campo designado para ordenar = '{$fieldOrder}' en la tabla de Autor", 404);
        };
      }


      public function ObtenerAutorById($params = []) {
        $Id = $params[':ID'];
     if(is_numeric($Id)){
       $autor = $this->model->GetAutorById($Id);
       if ($autor) {
         $this->view->response($autor, 200);
       } else {
         $this->view->response("No existe el autor con el id={$Id} indicado", 404);
       };
     } else {
       $this->view->response("Asegurese que el ID escrito sea numerico", 400);
     };
   }
}