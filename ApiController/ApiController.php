<?php
require_once 'helper/SecurityHelper.php';
require_once 'Apiviews/ApiView.php';
abstract class ApiController {
    protected $view;
    protected $secHelper;
    private $data; 
    
    public function __construct() {
        $this->view = new APIView();
        $this->data = file_get_contents("php://input"); 
        $this->secHelper = new SecurityHelper();
    }
    
    function getData() { 
        return json_decode($this->data); 
    }  
}