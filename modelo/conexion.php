<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "srgjl";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("La conexión a la base de datos ha fallado: " . mysqli_connect_error());
}
?>