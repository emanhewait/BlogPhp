<?php
require("../../ink.php");
$message = [];
$formIsValid = checkForm($_POST, ['email', 'password']);
    echo "1";
if ($formIsValid) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $result = $authManager->getUserByEmail($email);
    if ($result) {
        if($result["password"] == $password){
            $message["success"] = "You Have Logged In Successfully";
            $_SESSION["userLog"] = $result["id"];
            $_SESSION["userName"] = $result["name"];
            $path = "../../controller/post/myPosts.php";
        } else {
            $message["error"] = "Invalid Email Or Password";
            $path = "../../views/auth/login.php";
        }
    } else {
        $message["error"] = "Invalid Email Or Password";
        $path = "../../views/auth/login.php";
    }
} else {
    $message["error"] = "All Fields Are Required";
    $path = "../../views/auth/login.php";
}

$_SESSION["message"] = $message;
header("location: $path");
