<?php
require("../../ink.php");
$message = [];
$path = "../../views/auth/register.php";
$formIsValid = checkForm($_POST, ["name", "email", "phone", "password", "passwordConfirm"]);
if ($formIsValid) {
    $_SESSION["name"] = $_POST["name"];
    $_SESSION["email"] = $_POST["email"];
    $_SESSION["phone"] = $_POST["phone"];
    $_SESSION["passwordInput"] = $_POST["password"];
    $_SESSION["repeatedPasswordInput"] = $_POST["passwordConfirm"];
        $result= $authManager->getUserByEmail($_SESSION["email"]);
    if (!checkLength($_SESSION["name"], 3, 100)) {
        $message["nameError"] = "Invalid User Name. Please Try Again";
    }
    if (!filter_var($_SESSION["email"], FILTER_VALIDATE_EMAIL)) {
        $message["emailError"] = "Invalid Email Address.";
    }
    if ($result) {
        $message["emailError"] = "Email Already Exists";
    }
    if (!checkLength($_SESSION["passwordInput"], 8)) {
        $message["passwordError"] = "Invalid Password. Please Enter At Least 8 Characters";
    }
    if ($_SESSION["passwordInput"] != $_SESSION["repeatedPasswordInput"]) {
        $message["confirmPasswordError"] = "Passwords Do Not Match";
    }
    if (!preg_match("/^01[0-2]{1}[0-9]{8}$/", $_SESSION["phone"])) {
        $message["phoneError"] = "Please Enter A Valid Phone Number";
    }
    if(empty($message)) {
        $result=$authManager->Register( $_SESSION['name'], $_SESSION['email'], $_SESSION['phone'],$_SESSION['passwordInput']);
        if ($result) {
            $message["success"] = "Account Created Successfully. Please Login";
            $path = "../../views/auth/login.php";
        } else {
            $message["error"] = "Something Went Wrong.";
        }
    }
} else {
    $message["error"] = "All Fields Are Required";
}
$_SESSION["message"] = $message;
header("location: $path");