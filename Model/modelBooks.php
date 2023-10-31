<?php
require_once 'config.php';
class ModelBooks{
    private $conexion;
    public function __construct(){
        $this->conexion= new PDO('mysql:host=' . MYSQL_HOST . ';dbname=' . MYSQL_DB . ';charset=utf8', MYSQL_USER, MYSQL_PASS);
}
public function GetBooks(){
    $consulta="SELECT * FROM libros LEFT JOIN autor ON autor.id_autor=libros.id_libros";
    $query = $this->conexion->prepare($consulta);
    $query->execute();
    $libros = $sentencia->fetchAll(PDO::FETCH_OBJ);
    
    return $libros;
}	


public function GetbookById($id){
    $consulta="SELECT * FROM libros WHERE id=?";
    $query = $this->conexion->prepare($consulta);
    $query->execute([$id]);
    $librobyId = $query->fetchAll(PDO::FETCH_OBJ);
    
    return $librobyId;
}

public function InsertBook($titulo,$AñoDePublicacion,$descripcion,$idAutor){

    $consulta= "INSERT INTO libros(titulo,Anio,descripcion,id_autor) VALUES(?,?,?,?)";
    $query = $this->db->prepare($consulta);
    $query->execute([$titulo,$AñoDePublicacion,$descripcion,$idAutor]);
    $libronuevo = $query->fetchAll(PDO::FETCH_OBJ);
    return $libronuevo;
}



public function BorrarTarea($id){

    $consulta="DELETE FROM libros WHERE id_libros = ?";
    $query = $this->conexion->prepare($consulta);
    $query->execute([$id]);
    $libroeliminado = $query->fetchAll(PDO::FETCH_OBJ);
    return $libroeliminado;
}

//actualizar tarea//
/////
}

