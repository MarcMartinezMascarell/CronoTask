<?php

$conn = new mysqli('rdbms.strato.de', 'U4429143', 'gua18361742jma', 'DB4429143');

if($conn->connect_error){
    echo $conn->connect_error;
}

$conn->set_charset('utf8');
