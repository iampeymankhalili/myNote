<?php



if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    require_once "dbconnection.php";
    require_once "functions.php";

    $email = $_POST["email"];
    $password = $_POST["password"];

    if(emptyInputLogin($email, $password)){
        header("location: ../signup.php?error=emptyinput");
    }

    if(invalidEmail($email)){
        header("location: ../signup.php?error=invalidEmail");
    }

    loginUser($conn, $email, $password);


} else {
    header("location: ../signup.php");
}


?>