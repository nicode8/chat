<?php
session_start();
header('Content-Type: application/json');
require 'config.php';
$conn= new mysqli($DB_local_host,$DB_local_user,$DB_local_pass,$DB_local_name);
if($conn->connect_error)
    echo json_encode("errore");
$json=file_get_contents("php://input");
$dati=json_decode($json,true);


$nome=$dati["nome"];
$username=$dati["username"];
$_SESSION["email"]=$dati["email"];
$password=$dati["passw"];



$sql_check="SELECT * FROM accessi WHERE email=? OR username=?";
$stmt2= $conn->prepare($sql_check);
$stmt2->bind_param("ss",$_SESSION["email"],$username);
$stmt2->execute();
$stmt2_result= $stmt2->get_result();

if($stmt2_result->num_rows>0)
{
    echo json_encode(["message"=> "email o username già esistenti"]);
    $stmt2->close();
    $conn->close();
    exit();
}


$stmt2->close();



$sql="INSERT INTO accessi (nome,username,email,passw) VALUES (?,?,?,?)";


$stmt= $conn->prepare($sql);
$stmt-> bind_param("ssss", $nome, $username, $_SESSION["email"], $password);
$stmt->execute();
/*if(!$stmt->execute()) 
    $printmessage=$stmt->error;
else
    $printmessage=["message"=>"Registrazione completata"];
*/
echo json_encode(["message"=>"Registrazione completata"]);




$stmt->close();
$conn->close();


?>