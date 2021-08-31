<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
include_once'./config/database.php';

$table='ad';
$data=json_decode(file_get_contents('php://input'));
$title=$_POST['title'];
$description=$_POST['description'];
$drive=$_POST['driven'];
$price=$_POST['price'];
$location=$_POST['location'];
$customer=$_POST['customer'];
$id=$_POST['id'];
if($_FILES['picture'])
{
    $picture=$_FILES['picture'];
    $imgpath='images/'.$picture['name'];
    move_uploaded_file($picture['temp_name'],$imgpath);
    $query='insert into '.$table.'set title=:title,description=:description,driven=:driven,price=:price,location=:location,customer=:customer,picture=:picture where id=:id';
    $stmt=$pdo->prepare($query);
    $stmt->bindParam(':title',$title);
    $stmt->bindParam(':description',$description);
    $stmt->bindParam(':driven',$driven);
    $stmt->bindParam(':price',$price);
    $stmt->bindParam(':location',$location);
    $stmt->bindParam(':customer',$customer);
    $stmt->bindParam(':picture',$imgpath);
    $stmt->bindParam(':id',$id);
    if($stmt->execute())
    {
        $response['message']='AD details created';
        echo json_encode($response);
    }
    else
    {
        $response['message']='error occured';
        echo json_encode($response);
    }
}
}

?>