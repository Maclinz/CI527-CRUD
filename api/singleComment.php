<?php 
    function getComment(){
        //Headers
        header('Access-Control-Allow-Origin: *');
        header('Content-Type:application/json');

        //Includes
        include_once('../Db.php');
        include_once('../models/Post.php');

        //Instanciaye DB and connect
        $database = new Db();
        $db = $database->connect();

        //Instanciate Post
        $post = new Post($db);

        //Get Id from Url
        $post->id = isset($_GET['id']) ? $_GET['id'] : die();

        //Read Single Comment
        $post->readSinglePost();
        
        //Return Json Array
        $post_arr = array(
            'id' => $post->id,
            'name' => $post->name,
            'comment' => $post->comment
        );

        print_r(json_encode($post_arr));
    }

?>