<?php

class Blog extends Controller {

    function __construct() {
        parent::__construct();
    }
    
    /*
     * http://localhost/
     */
    function Index () {
        $this->view("template/header");
        $this->view("main/index");
        $this->view("template/footer");
        
    }



}
?>