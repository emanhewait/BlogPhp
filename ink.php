<?php
if (!isset($_SESSION)){
    session_start();
}
if (isset($_SESSION["message"])) {
    $message = $_SESSION["message"];
    unset($_SESSION["message"]);
}
if (isset($_SESSION["name"])) {
    $name = $_SESSION["name"];
    unset($_SESSION["name"]);
} else {
    $name = "";
}
if (isset($_SESSION["email"])) {
    $email = $_SESSION["email"];
    unset($_SESSION["email"]);
} else {
    $email = "";
}
if (isset($_SESSION["phone"])) {
    $phone = $_SESSION["phone"];
    unset($_SESSION["phone"]);
} else {
    $phone = "";
}
if (isset($_SESSION["passwordInput"])) {
    $passwordInput = $_SESSION["passwordInput"];
    unset($_SESSION["passwordInput"]);
} else {
    $passwordInput = "";
}
if (isset($_SESSION["repeatedPasswordInput"])) {
    $repeatedPasswordInput = $_SESSION["repeatedPasswordInput"];
    unset($_SESSION["repeatedPasswordInput"]);
} else {
    $repeatedPasswordInput = "";
}
require("../../Model/dataBaseConnection.php");
include("../../validation.php");
include("../../Model/AuthManager.php");
include("../../Model/PostManager.php");
include("../../Model/CommentManager.php");
$authManager = new AuthManager($conn);
$postManager = new PostManager($conn);
$commentManager = new CommentManager($conn);
