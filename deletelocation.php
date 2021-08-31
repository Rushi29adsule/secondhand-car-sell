<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
include_once'./config/database.php';

$table='location';
$data=json_decode(file_get_contents('file://input'));
$id=$data->id;
$query='delete from '.$table.'where id=:id';
$stmt=$pdo->prepare($query);
$stmt->bindParam(':id',$id);
if($stmt->exeucte())
{
    $response['message']='Location details deleted';
    echo json_encode($response);
}
else
{
    $resposne['message']='error occured';
    echo json_encode($response);
}

?>