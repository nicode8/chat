<?php
session_start();
require 'config.php';
$conn= new mysqli($DB_host,$DB_user,$DB_pass,$DB_name);

if($conn->connect_error)
    die("error");

$messaggio=$_POST["messaggio"];
$_SESSION["mittente"]=$_POST["email"];

$_SESSION["time"]= new DateTime();
$_SESSION["time"]= $_SESSION["time"]->format("Y-m-d H:i:s");

$sql="INSERT INTO messaggi_inviati (mittente,ricevente,messaggio,ora) VALUES (?,?,?,?)";

$invio= $conn->prepare($sql);
$invio->bind_param("ssss",$_SESSION["mittente"],$_SESSION["destinatario"],$messaggio,$_SESSION["time"]);
$invio->execute();


$invio->close();
$conn->close();













?>