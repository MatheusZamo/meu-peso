<?php 
    $conn = new mysqli("localhost", "root", "", "peso_app");

    if ($conn->connect_error) {
        die("Erro: " . $conn->connect_error);
    }
?>