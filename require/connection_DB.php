<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "gestion_des_soutenances1";
$conn = mysqli_connect($hostname, $username, $password, $database);
if (mysqli_connect_errno()) {
    die("La connexion a échoué : " . mysqli_connect_error());
}
?>