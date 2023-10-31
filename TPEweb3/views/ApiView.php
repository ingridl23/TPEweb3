<?php
class APIView() {

    public function response($data, $status) {
        
        header("Content-Type: application/json");
        header("HTTP/1.1 " . $status . " " . $this->_requestStatus($status));
        $obj=json_encode($data);
        echo $obj->titulo,
        echo $obj->anio,
        echo $obj->descripcion,
        echo $obj->idAutor;

    
    }
    
         private function _requestStatus($code){
            $status = array(
                200 => "consulta realizada con exito",
                404 => "Not found",
                500 => "Internal Server Error"
              );
              return (isset($status[$code]))? $status[$code] : $status[500];
            }
        
    }
    
?>    