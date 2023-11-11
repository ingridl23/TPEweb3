<?php
require_once 'Model/modelAutores.php';
require_once 'ApiController/ApiController.php';


class ApiControllerAutores extends ApiController{

  private $model;


  function __construct() {
    parent::__construct();
    $this->model = new modeloAutor();
  }

  function ObtenerAutores(){
    $autores = $this->model->getautores();
    $this->view->response($autores, 200);
  }

  public function ObtenerAutoresByField($params = []){
    if (isset($params[':FIELD'])) {
      $fieldOrder = $params[':FIELD'];
    } else {
      $fieldOrder = 'nombreApellido';
    };
    $columnNames = $this->model->getColumns();
    for ($i = 0; $i < count($columnNames); $i++) {
      if ($columnNames[$i] == $fieldOrder) {
        $validateField = $fieldOrder;
      }
    }
    if (isset($params[':ORDER'])) {
      $order = $params[':ORDER'];
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


  public function ObtenerAutorById($params = []){
    $Id = $params[':ID'];
    if (is_numeric($Id)) {
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


  public function CrearAutor(){
    //if ($this->secHelper->isLoggedIn()) {
    $body = $this->getData();
    if (!empty($body->nombreApellido) && !empty($body->nacionalidad)) {
      $nombreApellido = $body->nombreApellido;
      $nacionalidad = $body->nacionalidad;




      $newAutor = $this->model->InsertAutor($nombreApellido, $nacionalidad);
      if ($newAutor) {
        $this->view->response("Se ha creado un nuevo autor con la id = '{$newAutor}' ", 201);
      } else {
        $this->view->response("El autor no fue creado", 500);
      };
    } else {
      $this->view->response("No se ha podido crear un nuevo autor, asegurese de colocar todos los campos de la tabla ", 400);
    } 
  }


  function ActualizaAutorById($params = null){
    if (isset($params[':ID'])) {
      $id =  $params[':ID'];
    }
    if (is_numeric($id)) {
      $body = $this->getData();
       if (!empty((array) $body)) //Esto es para verificar si el cuerpo de la solicitud no está vacío 
       {
        $this->model->updateAutor($body->nombreApellido, $body->nacionalidad, $id);
        $this->view->response("El autor con id = '{$id}' fue editado", 200);
      } else {
        $this->view->response("No se pudo editar el autor con id = '{$id}', asegurarse de colocar todos los campos de la tabla", 400);
      }
    } else {
      $this->view->response("No existe un autor con id = '{$id}' ", 404);
      // }
    }
  }
}
