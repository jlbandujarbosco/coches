<?php
$servername = "localhost";
$username = "gestion_coches";
$password = "2CAnlKWEdH8aIdQF"; // Cambia esto según tu configuración
$dbname = "gestion_coches";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
