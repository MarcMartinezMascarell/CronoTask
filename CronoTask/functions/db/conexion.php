<?php

$conn = mysqli_connect('localhost', 'root', '', 'cronotask');

if($conn->connect_error){
    echo $conn->connect_error;
}

if(!$conn){
    echo 'Conexion Error';
}