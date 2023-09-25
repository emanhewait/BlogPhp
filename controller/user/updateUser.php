<?php
require "../../ink.php";
$formIsValid = checkForm($_POST,["Name","email","phone","password"]);
$path = "../user/userData.php?id=" . $_POST['id'] . "";
if ($formIsValid) {
    $message = [];
    $name = $_POST["Name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $password = $_POST["password"];
    $result = $authManager->updateUser($name,$email,$phone,$password,$_POST['id']);
    if ($result) {
        $message["success"] = "userData Updated Successfully";
        $_SESSION["userName"]=$name;
    }
} else {
    $message["error"] = "All Field Is Required";
    $path = "/views/auth/userUpdate.php?id='" . $_POST['id'] . "'";
}
$_SESSION["message"] = $message;
header("location: $path");