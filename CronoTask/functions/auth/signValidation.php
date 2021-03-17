<?php

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordRepeat = $_POST['passwordRepeat'];

    require_once '../db/conexion.php';
    require_once 'validationFunctions.php';

    if(emptyInputSignup($name, $email, $password, $passwordRepeat) !== false){
        header("location: ../../signup.php?error=emptyinput");
        exit();
    }else if(invalidEmail($email) !== false){
        header("location: ../../signup.php?error=invalidemail");
        exit();
    }else if(pwdMatch($password, $passwordRepeat) !== false){
        header("location: ../../signup.php?error=dontmatch");
        exit();
    }else if(emailExists($conn, $email) !== false){
        header("location: ../../signup.php?error=emailtaken");
        exit();
    } else{
        createUser($conn, $name, $email, $password);
    }



} else {
    header("location: ../../signup.php");
}
