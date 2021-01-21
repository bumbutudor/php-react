<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require 'db_connect.php';

// POST DATA
$data = json_decode(file_get_contents("php://input"));
echo $data;

if( isset($data->cuvant) 
	&& isset($data->predefinitie)
	&& isset($data->definitie) 
	&& !empty(trim($data->cuvant))
	&& !empty(trim($data->predefinitie))
	&& !empty(trim($data->definitie))	
	){
    $cuvant = mysqli_real_escape_string($db_conn, trim($data->cuvant));
    $predefinitie = mysqli_real_escape_string($db_conn, trim($data->predefinitie));
	$definitie = mysqli_real_escape_string($db_conn, trim($data->definitie));
    
	$insertWord = mysqli_query($db_conn,"INSERT INTO `cuvinte`(`cuvant`,`predefinitie`, `definitie`, `dictionar_id`, `lexicograf_id` ) VALUES('$cuvant','$predefinitie', '$definitie', '1', '1')");
	
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