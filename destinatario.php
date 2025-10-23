<?php
session_start();
require 'config.php';
$conn= new mysqli($DB_host,$DB_user,$DB_pass,$DB_name);

if($conn->connect_error)
    die("errore". $conn->error);

$_SESSION["destinatario"]=$_POST["dest"];


?>