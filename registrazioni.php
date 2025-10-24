<?php
session_start();
require 'config.php';
$conn= new mysqli($DB_host,$DB_user,$DB_pass,$DB_name);

if($conn->connect_error)
    die("errore");



$nome=$_POST["nome"];
$cognome=$_POST["cognome"];
$_SESSION["email"]=$_POST["email"];
$password=$_POST["passw"];


$sql="INSERT INTO accessi (nome,cognome,email,passw) VALUES (?,?,?,?)";

$stmt= $conn->prepare($sql);
$stmt-> bind_param("ssss", $nome, $cognome, $_SESSION["email"], $password);
if(!$stmt->execute()) die("Errore: " . $stmt->error);

header("Location: index.html");
    


$stmt->close();
$conn->close();


?>