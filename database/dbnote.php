<?php
session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    require_once "dbconnection.php";
    require_once "functions.php";

    $title = $_POST["title"];
    $text = $_POST["text"];
    $user_id = $_SESSION["id"];


    if(emptyInputNote($title, $text)){
        header("location: ../writenote.php?error=emptyinput");
    }

    submitNote($conn, $title, $text, $user_id);


} else {
    header("location: ../writenote.php");
}


?>