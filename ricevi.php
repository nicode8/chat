<?php
session_start();
require 'config.php';
$conn= new mysqli($DB_host,$DB_user,$DB_pass,$DB_name);

if($conn->connect_error)
    die("error".$conn->error);


$sql="SELECT messaggio from messaggi_inviati where ricevente=? AND mittente=?";

$stmt= $conn->prepare($sql);
$stmt->bind_param("ss",$_SESSION["email"],$_SESSION["destinatario"]);
$stmt->execute();
$result=$stmt->get_result();

$messaggio=[];
while($row=$result->fetch_assoc())
{
    $messaggio[]=$row["messaggio"];

}
header('Content-Type: application/json');
echo json_encode($messaggio);






?>