<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require 'db_connect.php';

// POST DATA
$data = json_decode(file_get_contents("php://input"));

if(isset($data->dict_cuvant) && isset($data->dict_predefinitie) && isset($data->dict_definitie) && !empty(trim($data->dict_cuvant)) && !empty(trim($data->dict_predefinitie)) && !empty(trim($data->dict_definitie)))
{
    $cuvant = mysqli_real_escape_string($db_conn, trim($data->dict_cuvant));
    $predefinitie = mysqli_real_escape_string($db_conn, trim($data->dict_predefinitie));
	$definitie = mysqli_real_escape_string($db_conn, trim($data->dict_definitie));
    
	$insertWord = mysqli_query($db_conn,"INSERT INTO `cuvinte`(`cuvant`,`predefinitie`,`definitie`) VALUES('$cuvant','$predefinitie','$definitie')");
	
	if($insertWord){
		$last_id = mysqli_insert_id($db_conn);
		echo json_encode(["success"=>1,"msg"=>"Cuvantul a fost adaugat cu success!","id"=>$last_id]);
	}
	else{
		echo json_encode(["success"=>0,"msg"=>"Cuvantul nu a fost adaugat!"]);
	}

}
else{
    echo json_encode(["success"=>0,"msg"=>"Va rog sa completati casutele goale!"]);
}