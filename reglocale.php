<?php


$conn=new mysqli("localhost","root","","chat",3308);

$nome=$_POST["nome"];
$cognome=$_POST["cognome"];
$email=$_POST["email"];
$password=$_POST["passw"];
$sql='INSERT INTO ACCESSI (nome,cognome,email,passw) VALUES (?,?,?,?) ';
$stmt= $conn->prepare($sql);
$stmt-> bind_param("ssss", $nome, $cognome, $email, $password);
if(!$stmt->execute()) die("Errore: " . $stmt->error);


$stmt->close();
$conn->close();

?>