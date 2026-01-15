<?php
session_start();
header('Content-Type: application/json');
require 'config.php';
$conn= new mysqli($DB_host,$DB_user,$DB_pass,$DB_name);

if($conn->connect_error)
    die("error".$conn->error);

$json=file_get_contents("php://input");
$json=json_decode($json,true);

$id=$json["last_id"];



$sql="SELECT id,messaggio,mittente FROM messaggi_inviati 
        WHERE ((ricevente=? AND mittente=?) OR (ricevente=? AND mittente=?)) 
        AND id > ? ORDER BY id ASC";

$stmt= $conn->prepare($sql);
$stmt->bind_param("ssssi",$_SESSION["email"],$_SESSION["destinatario"],$_SESSION["destinatario"],$_SESSION["email"],$id);
$stmt->execute();
$result=$stmt->get_result();

$results=[];
while($row=$result->fetch_assoc())
{
    $results[]=[
        "id"=>$row["id"],
        "messaggio"=>$row["messaggio"],
        "mittente"=>$row["mittente"],
        "miaEmail"=>$_SESSION["email"],
    ];

}
echo json_encode($results);










?>