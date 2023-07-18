<?php

function emptyInputSignup($name, $email, $password, $re_password): bool
{
    $result = false;

    if(empty($name) || empty($password) || empty($email) || empty($re_password)){
        $result = true;
    }
    return $result;

}
function emptyInputLogin($email, $password): bool
{
    $result = false;

    if(empty($email) || empty($password)){
        $result = true;
    }
    return $result;

}

function invalidEmail($email): bool
{
    $result = false;
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        $result = true;
    }

    return $result;
}

function passwordMatch($password, $re_password): bool
{
    $result = false;
    if($password !== $re_password){
        $result = true;
    }
    return $result;
}

function userExist($conn, $email){
    $sql = "SELECT * FROM user WHERE email = ?";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }
    else{
        return false;

    }

    mysqli_stmt_close($stmt);

}

function createUser($conn, $name, $email, $password): void
{
    $sql = "INSERT INTO user(name, email, password) VALUES (?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    $hashPass = password_hash($password, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sss", $name, $email, $hashPass);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../signup.php?error=none");
    exit();

}

function loginUser($conn, $email, $password){
    $userEx = userExist($conn, $email);

    if($userEx === false){
        header("location: ../login.php?error=wronglogin");
        exit();
    }

    $hashPass = $userEx["password"];
    $checkPass = password_verify($password, $hashPass);

    if($checkPass === false){
        header("location: ../login.php?error=wronglogin");
        exit();
    }
    elseif ($checkPass === true){
        session_start();
        $_SESSION["id"] = $userEx["id"];
        $_SESSION["id"] = $userEx["id"];
        header("location: ../index.php");
        exit();
    }
}

?>