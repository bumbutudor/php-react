<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require 'db_connect.php';

$allWords = mysqli_query($db_conn,"SELECT * FROM `cuvinte`");
if(mysqli_num_rows($allWords) > 0){
    $all_words = mysqli_fetch_all($allWords,MYSQLI_ASSOC);
    echo json_encode(["success"=>1,"words"=>$all_words]);
}
else{
    echo json_encode(["success"=>0]);
}