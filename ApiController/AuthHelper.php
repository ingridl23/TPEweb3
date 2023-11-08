<?php
require_once 'ApiController/apiController.php';

function base64url_encode($data) {
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}
class AuthApiController extends ApiController {
    
    public function __construct() {
        parent::__construct();
    }

    public function getToken() {
        $basic = $this->secHelper->getAuthHeader();
        if(empty($basic)){
            $this->view->response('No autorizado', 401);
            return;
        };
        $basic = explode(" ",$basic);
        if($basic[0]!="Basic"){
            $this->view->response('La autenticación debe ser Basic', 401);
            return;
        };
        $userpass = base64_decode($basic[1]);
        $userpass = explode(":", $userpass);
        $user = $userpass[0];
        $pass = $userpass[1];
        if($user == "webdmin" && $pass == "admin"){
            $header = array(
                'alg' => 'HS256',
                'typ' => 'JWT'
            );
            $payload = array(
                'id' => 1,
                'name' => "webadmin",
                'exp' => time()+3600
            );
            $header = base64url_encode(json_encode($header));
            $payload = base64url_encode(json_encode($payload));
            $signature = hash_hmac('SHA256', "$header.$payload", "Clave1234", true);
            $signature = base64url_encode($signature);
            $token = "$header.$payload.$signature";
             $this->view->response($token,200);
        } else {
            $this->view->response('No autorizado', 401);
        };
    }

}


 