<?php
require_once 'config.php';
class ModelBooks{
    private $conexion;
    public function __construct(){
        $this->conexion= new PDO('mysql:host=' . MYSQL_HOST . ';dbname=' . MYSQL_DB . ';charset=utf8', MYSQL_USER, MYSQL_PASS);
}
public function GetBooks(){
    $consulta="SELECT * FROM libros  JOIN autor ON autor.id_autor=libros.id_autor";
    $query = $this->conexion->prepare($consulta);
    $query->execute();
    $libros = $query->fetchAll(PDO::FETCH_OBJ);
    
    return $libros;
}	


public function GetbookById($id){
    $consulta="SELECT * FROM libros WHERE id_libros= ?";
    $query = $this->conexion->prepare($consulta);
    $query->execute([$id]);
    $librobyId = $query->fetchAll(PDO::FETCH_OBJ);
    
    return $librobyId;
}

public function InsertBook($titulo,$AñoDePublicacion,$descripcion,$idAutor){

    $consulta= "INSERT INTO libros(titulo,Anio,descripcion,id_autor) VALUES(?,?,?,?)";
    $query = $this->conexion->prepare($consulta);
    $query->execute([$titulo,$AñoDePublicacion,$descripcion,$idAutor]);
    $libronuevo = $query->fetchAll(PDO::FETCH_OBJ);
    return $this->conexion->lastInsertId();
}



public function DeleteBook($id){

    $consulta="DELETE FROM libros WHERE id_libros = ?";
    $query = $this->conexion->prepare($consulta);
    $query->execute([$id]);
    $libroeliminado = $query->fetchAll(PDO::FETCH_OBJ);
   // return $libroeliminado;
}

//actualizar tarea//

function updatelibros($t,$a,$d,$id){//edita un libro//
     $consulta="UPDATE libros SET titulo= '$t',Anio='$a', descripcion='$d' WHERE  id_libros= $id";
     $query=$this->conexion->prepare($consulta);
     $query->execute();
    // $modificacion=$query->fetchAll(PDO::FETCH_ASSOC);
    // return $modificacion;
    
}

 function getColumns() {
    $query = $this->conexion->prepare('SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS  WHERE TABLE_NAME = "libros"');
    $query->execute();
    return $query->fetchALL(PDO::FETCH_COLUMN);
}

 function getOrderLibros($field, $order) {
    $consulta=('SELECT * FROM libros ORDER BY  ? ? ');
    $query = $this->conexion->prepare($consulta);
    $query->execute([$field,$order]);
    return $query->fetchAll(PDO::FETCH_OBJ);
}

public function pagesBooks($start, $BookspageSize) {
    $query = $this->conexion->prepare('SELECT * FROM `libros`  LIMIT ' . $start . ', ' . $BookspageSize );
    $query->execute();
    $resp= $query->fetchAll(PDO::FETCH_OBJ);
    return $resp;
}
}
