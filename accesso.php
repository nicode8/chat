<?php
session_start();
require 'config.php';
$conn= new mysqli($DB_host,$DB_user,$DB_pass,$DB_name);

if($conn->connect_error)
    echo json_decode("error");

$email=$_POST["email"];
$password=$_POST["password"];


$sql="SELECT * FROM accessi WHERE email=? AND passw=? ";

$stmt= $conn->prepare($sql);
$stmt->bind_param("ss", $email, $password);
$stmt->execute();
$result= $stmt->get_result();


if($row= $result->fetch_assoc())
{   $_SESSION["email"]=$_POST["email"];
    header("Location: destinatario.html");
}
else
{
    header("location:index.html");
    echo"<script type='text/javascript> alert('questo account non esiste');</script>";

}


$stmt->close();
$conn->close();












?>