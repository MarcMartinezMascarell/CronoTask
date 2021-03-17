<?php


function emptyInputSignup($name, $email, $password, $passwordRepeat){
    $result;
    if(empty($name) || empty($email) || empty($password) || empty($passwordRepeat)){
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function invalidName($name){
    $result;
    if(preg_match("/^[a-zA-Z0-9]*$/", $name )){
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function invalidEmail($email){
    $result;
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function pwdMatch($password, $passwordRepeat){
    $result;
    if($password !== $passwordRepeat){
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function emailExists($conn, $email){
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("loation: ../../signup.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    } else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function createUser($conn, $name, $email, $password){
    //HASH PASSWORD
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);


    $sql = "INSERT INTO users (name, email, password, creation_date) VALUES (?, ?, ?, now())";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("loation: ../../signup.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "sss", $name, $email, $hashed_password);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../../login.php");
    exit();

}


//LOGIN

function emptyInputLogin($email, $password) {
    $result;
    if(empty($email) || empty($password)){
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function loginUser($conn, $email, $password){
    $emailExists = emailExists($conn, $email);

    if($emailExists === false){
        header("location: ../../login.php?error=noemail");
        exit();
    }

    $password_hashed = $emailExists["password"];
    $checkPwd = password_verify($password, $password_hashed);

    if($checkPwd === false){
        header("location: ../../login.php?error=wronglogin");
        exit();
    } else if($checkPwd === true){
        session_start();
        $_SESSION["userid"] = $emailExists["user_id"];
        $_SESSION["username"] = $emailExists["name"];
        header("location: ../../index.php");
        exit();
    }

}