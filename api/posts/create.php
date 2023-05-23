<?php

//Headers
header('Acess-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Post.php';

//Instantiate DB & connect
$database = new Database();
$db = $database->connect();

//Instantiate blog post object
$post = new Post($db);

//Get raw posted data 
$data = json_decode(file_get_contents("php://input"));

// Assign data to post object properties
$post->title = isset($data->title) ? $data->title : '';
$post->body = isset($data->body) ? $data->body : '';
$post->author = isset($data->author) ? $data->author : '';
$post->category_id = isset($data->category_id) ? $data->category_id : '';

//Create post
if($post->create()) {
    echo json_encode(
        array('message' => 'Post Created')
    );
} else {
    echo json_encode(
        array('message' => 'Post Not Created')
    );
}
