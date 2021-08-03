<?php 

//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type:application/json');

//Includes
include_once('../Db.php');
include_once('../models/Post.php');
include_once('../api/update.php');
include_once('../api/createComment.php');
include_once('../api/delete.php');


//Instanciaye DB and connect
$database = new Db();
$db = $database->connect();

//Instanciate Post
$post = new Post($db);

$method = $_SERVER['REQUEST_METHOD'];

if($method === 'GET'){
    //Post Query
    $result = $post->readData();
    //Get Post Count
    $count = $result->rowCount();


    if($count > 0){
        $post_arr = array();
        $post_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $post_item = array(
                'id' => $id,
                'name' => $name,
                'comment' => $comment
            );

            //Push to data
            array_push($post_arr['data'], $post_item);
        }
        //Convert into Json
        echo json_encode($post_arr);
    }else{
        echo json_encode(
            array('message' => 'There are no Posts Found')
        );
    }

    //Get Specific Comment Using ID
}else if($method === 'PUT'){
    //Call the Updater function
    dataUpdater();
}else if($method === 'POST'){
    //Call The Create Function
    createData();
}else if($method === 'DELETE'){
    //Delete Specified data
    deleteData();
}
else{
    //If your request Method is unknown in this context ypi'll get this Message
    echo 'Unkown Method: Chose either you want to: GET, POST, PUT or DELETE';
}

?>