<?php



if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    require_once "dbconnection.php";
    require_once "functions.php";

    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $re_password = $_POST["re_password"];

    if(emptyInputSignup($name, $email, $password, $re_password)){
        header("location: ../signup.php?error=emptyinput");
    }

    if(invalidEmail($email)){
        header("location: ../signup.php?error=invalidEmail");
    }

    if(passwordMatch($password, $re_password)){
        header("location: ../signup.php?error=passworddonotmatch");
    }

    createUser($conn, $name, $email, $password);


} else {
    header("location: ../signup.php");
}


?>