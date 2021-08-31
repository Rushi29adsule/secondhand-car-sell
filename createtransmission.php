<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
include_once'./config/database.php';

$table='transmission';
$data=json_encode(file_get_contents('php://input'));
$name=$data->name;
$id=$data->id;
$query='insert into '.$table.' set name=:name where id=:id ';
$stmt=$pdo->prepare($query);
$stmt->bindParam(':name',$name);
$stmt->bindParam(':id',$id);
if($stmt->execute())
{
 $response['message']='Transmission created';
 echo json_encode($response);
}
else
{
    $response['message']='error occured';
    echo json_encode($response);
}
?>