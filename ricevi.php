<?php
session_start();
header('Content-Type: application/json');
require 'config.php';
$conn= new mysqli($DB_host,$DB_user,$DB_pass,$DB_name);

if($conn->connect_error)
    die("error".$conn->error);

$json=file_get_contents("php://input");
$json=json_decode($json,true);

$id=$json;



$sql="SELECT id,messaggio from messaggi_inviati where ricevente=? AND mittente=? AND id>?";

$stmt= $conn->prepare($sql);
$stmt->bind_param("ssi",$_SESSION["email"],$_SESSION["destinatario"],$id);
$stmt->execute();
$result=$stmt->get_result();

$messaggio=[];
while($row=$result->fetch_assoc())
{
    $results[]=[
        "id"=>$row["id"],
        "messaggio"=>$row["messaggio"]
    ];

}
echo json_encode($results);










?>