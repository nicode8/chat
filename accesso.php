<?php
session_start();
header('Content-Type: application/json');
require 'config.php';
$conn= new mysqli($DB_host,$DB_user,$DB_pass,$DB_name);

if($conn->connect_error)
    echo json_encode($conn->connect_error);

$json=file_get_contents("php://input");
$call_api=json_decode($json,true);

$email=$call_api["email"];
$password=$call_api["password"];


$sql="SELECT * FROM accessi WHERE email=? AND passw=? ";

$stmt= $conn->prepare($sql);
$stmt->bind_param("ss", $email, $password);
$stmt->execute();
$result= $stmt->get_result();


if($result->fetch_assoc())
{   $_SESSION["email"]=$email;
    echo json_encode(["success"=>true,"message"=>"fatto"]);

 
}
/*else
{
    header("location:index.html");
    echo"<script type='text/javascript> alert('questo account non esiste');</script>";

}*/


$stmt->close();
$conn->close();




?>