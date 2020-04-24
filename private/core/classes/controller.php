<?php

abstract class Controller {

    private $route = [];

    protected $currentUrl = "/";

    private $args = 0;

    private $params = [];

    function __construct () {

        $this->route = explode('/', URI);

        $this->currentUrl = $this->buildRelativeUrl($this->route, 1);

        $this->args = count($this->route);

        $this->router();

    }

    protected function buildRelativeUrl( $urlArray, $start_index ) {
        
        $full_url = $this->route;
        
        if (is_array($full_url)) {
            $url_pieces = $full_url;
        } else {
            $url_pieces = explode("/", $full_url);
        }
        
        $count = count($url_pieces);

        $pieces = array();
        
        for ($i = $start_index; $i < $count; $i++) {
            $pieces[$i-$start_index] = $url_pieces[$i];
        }

        $ret = str_replace("//", "/", join("/", $pieces) . "/");

        return $ret;
    
    }

    private function router () {
        
        if (class_exists($this->route[1])) {
            
            if ($this->args >= 3) {
                if (method_exists($this, $this->route[2])) {
                    $this->uriCaller(2, 3);
                } else {
                    $this->uriCaller(0, 2);
                }
            } else {
                $this->uriCaller(0, 2);
            }

        } else {

            if ($this->args >= 2) {
                if (method_exists($this, $this->route[1])) {
                    $this->uriCaller(1, 2);
                } else {
                    $this->uriCaller(0, 1);
                }
            } else {
                $this->uriCaller(0, 1);
            }

        }

    }

    private function uriCaller ($method, $param) {

        for ($i = $param; $i < $this->args; $i++) {
            $this->params[$i] = $this->route[$i];
        }

        if ($method == 0)
            call_user_func_array(array($this, 'Index'), $this->params);
        else
            call_user_func_array(array($this, $this->route[$method]), $this->params);

    }

    abstract function Index ();

    function model ($path) {
        // $path = $path;

        $class = explode('/', $path);
        $class = $class[count($class)-1];

        $path = strtolower($path);

        require(ROOT . "/private/app/models/$path.php");

        $this->$class = new $class;
    }

    function view ($path, $data = []) {
        if (is_array($data))
            extract($data);

        require(ROOT . "/private/app/views/$path.php");

    }
}

?>