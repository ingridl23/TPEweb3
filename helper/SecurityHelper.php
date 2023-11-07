<?php
require_once 'ApiController/AuthHelper.php';
class SecurityHelper {
    private $helper;
    function __construct(){
        $this->helper= new Helper();
    }
    function getToken() {
        $auth = $this->getAuthHeader(); 
        $auth = explode(" ", $auth);
       
        if($auth[0]!="Bearer" || count($auth) != 2){
            return array();
        }
        $token = explode(".", $auth[1]);
        $header = $token[0];
        $payload = $token[1];
        $signature = $token[2];

        $new_signature = hash_hmac('webadmin', "$header.$payload", "admin", true);
        $new_signature = base64url_encode($new_signature);
        if($signature!=$new_signature)
            return array();

        $payload = json_decode(base64_decode($payload));
        if(!isset($payload->exp) || $payload->exp<time())
            return array();
        
        return $payload;
    }

    function isLoggedIn() {
        $payload = $this->getToken();
        if(isset($payload->id))
            return true;
        else
            return false;
    }

    function getAuthHeader() {
       $user=  $this->Helper->ValidateUser();
       return $user;
    }
}
