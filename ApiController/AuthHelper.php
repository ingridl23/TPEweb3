<?php
class Helper{


function ValidateUser($user){

    $_SESSION['UserContraseña'] = $user->contraseña;
    $_SESSION['usuario']= $user->nombre;
    $_SESSION['logueado'] = true;
    
}




function logout(){

     session_start();
     session_destroy();
    header('Location: '.BASE_URL.'home');
}

}

?>


 