<?php

class APIBlog extends Controller {

    function __construct() {
        parent::__construct();
    }

    function Index ($id = null) {
        if ($_SERVER['REQUEST_METHOD'] !== "GET") {
            http_response_code(405);
            echo("GET is required to fetch records");
            return;
        }

        $blogdb = $this->model("blog");
        
        if (is_null($id)) {
            $data = $blogdb->getAll();
        } else {
            $data = $blogdb->getById($id);
        }

        header("content-type: application/json");
        echo(json_encode($data));
    }

    function Insert() {
        if ($_SERVER['REQUEST_METHOD'] !== "POST") {
            http_response_code(405);
            echo("POST is required to insert new records");
            return;
        }

        $title = htmlentities($_POST["title"]);
        $content = htmlentities($_POST["content"]);
        $author = htmlentities($_POST["author"]);
        $tags = explode(",", htmlentities($_POST["tags"]));
        $pub_date = htmlentities($_POST["pub_date"]);

        $blogdb = $this->model("blog");

        $blogdb->createBlogPost($title, $pub_date, $author, $content, $tags);

        http_response_code(200);
    }

}

?>