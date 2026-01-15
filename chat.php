<?php
session_start();
require 'config.php';
$conn= new mysqli($DB_host,$DB_user,$DB_pass,$DB_name);

if($conn->connect_error)
    die("error");

$messaggio=$_POST["messaggio"];
$ora = $ora = date("Y-m-d H:i:s");

$sql="INSERT INTO messaggi_inviati (mittente,ricevente,messaggio,ora) VALUES (?,?,?,?)";

$invio= $conn->prepare($sql);
$invio->bind_param("ssss",$_SESSION["email"],$_SESSION["destinatario"],$messaggio,$ora);
$invio->execute();


$invio->close();
$conn->close();


?>