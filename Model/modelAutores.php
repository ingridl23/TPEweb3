<?php

class modeloAutor{
    private $conexion;
    function __construct(){
        $this->conexion= new PDO('mysql:host=' . MYSQL_HOST . ';dbname=' . MYSQL_DB . ';charset=utf8', MYSQL_USER, MYSQL_PASS);

    }

    function getautores(){
        $consulta= 'SELECT * FROM autor';

        $query= $this->conexion->prepare($consulta);
        $query->execute();
        $resp= $query->fetchAll(PDO::FETCH_OBJ);

        return $resp;


    }

        function getColumns() {
        $query = $this->conexion->prepare('SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS  WHERE TABLE_NAME = "autor"');
        $query->execute();
        return $query->fetchALL(PDO::FETCH_COLUMN);
    }

     function getOrderAutores($field, $order) {
        $consulta=('SELECT * FROM autor ORDER BY ' . $field . ' ' . $order . '');
        $query = $this->conexion->prepare($consulta);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }


     function GetAutorById($id){
        $consulta="SELECT * FROM autor WHERE id_autor= ?";
        $query = $this->conexion->prepare($consulta);
        $query->execute([$id]);
        $autorbyId = $query->fetchAll(PDO::FETCH_OBJ);
        
        return $autorbyId;
    }


    public function InsertAutor($nombreApellido, $nacionalidad){

        $consulta= "INSERT INTO autor(nombreApellido, nacionalidad) VALUES(?,?)";
        $query = $this->conexion->prepare($consulta);
        $query->execute([$nombreApellido, $nacionalidad]);
        $autornuevo = $query->fetchAll(PDO::FETCH_OBJ);
        return $this->conexion->lastInsertId();
    }

    function updateAutor($nm,$n,$id){//edita un autor//
        $consulta="UPDATE autor SET nombreApellido= '$nm',nacionalidad='$n' WHERE  id_autor= $id";
        $query=$this->conexion->prepare($consulta);
        $query->execute();
       
       
   }

}

