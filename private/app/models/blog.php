<?php

class Test extends Model {

    function __construct() {
        parent::__construct();
    }

    function getAll () {
        $sql = "SELECT * FROM `vw_blog_w_tags`";
        
        $stmt = $this->db->prepare($sql);

        $ret = $stmt->execute();

        return $stmt->fetchAll();
    } 

    function getById($id) {
        $sql = "SELECT * FROM `vw_blog_w_tags` WHERE `slug` = ?";
        
        $stmt = $this->db->prepare($sql);

        $ret = $stmt->execute(array($id));

        return $stmt->fetchAll();
    }

    function createBlogPost($title, $pub_date, $author, $content, $tags) {
        $sqlBlog = "INSERT INTO `blog` (`slug`, `title`, `pub_date`, `author`, `content`) VALUES (?, ?, ?, ?, ?)";
        $sqlTags = "INSERT INTO `tag` (`slug`, `tag`) VALUES (?, ?)";

        $slug = strtolower(str_replace(" ", "-", $title)) . "-" . rand(1000, 9999);
        $tagList = explode(",", $tags);

        $stmtBlog = $this->db->prepare($sqlBlog);
        $retBlog = $stmtBlog->execute(array($slug, $title, $pub_date, $author, $content));

        if ($retBlog === 0) {
            foreach ($tagList as $idx => $tag) {
                $stmtTags = $this->db->prepare($sqlTags);
                $retTags = $stmtTags->execute(array($slug, $tag));
                if ($retTags < 1) {
                    break;
                }
            }
        }
    }

}

?>