<?php 
    function dataUpdater(){
        //Update Our Data
        header('Access-Control-Allow-Origin: *');
        header('Content-Type:application/json');
        header('Access-Control-Allow-Methods: PUT');
        header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Authorization, X-Requested-With');

        //Includes
        include_once('../Db.php');
        include_once('../models/Post.php');

        //Instanciate DB and connect
        $database = new Db();
        $db = $database->connect();

        //Instanciate Post
        $post = new Post($db);

        //Get Posted Raw Data
        $raw_data = json_decode(file_get_contents("php://input"));

        //Set Id to update
        $post->id = $raw_data->id;

        $post->name = $raw_data->name;
        $post->comment = $raw_data->comment;

        //Update Post
        if($post->udpatePost()){
            echo json_encode(
                array('message' => 'Post Updated.')
            );
        }else{
            echo json_encode(
                array('message' => 'Post Not Updated.')
            );
        }

    }

    

?>