<?php
if (!isset($_SESSION)) {
    session_start();
}
require("./dataBaseConnection.php");
include("./validation.php");

if (isset($_POST["regForm"])) {
    $message = [];
    $path = "/pages/auth/register.php";
    $formIsValid = checkForm($_POST, ["name", "email", "phone", "password", "passwordConfirm"]);
    if ($formIsValid) {
        $_SESSION["name"] = $_POST["name"];
        $_SESSION["email"] = $_POST["email"];
        $_SESSION["phone"] = $_POST["phone"];
        $_SESSION["passwordInput"] = $_POST["password"];
        $_SESSION["repeatedPasswordInput"] = $_POST["passwordConfirm"];
        $query = mysqli_query($conn, "SELECT * from users where email = '" . $_SESSION['email'] . "'");
        $result = mysqli_fetch_array($query);
        if (!checkLength($_SESSION["name"], 3, 100)) {
            $message["nameError"] = "Invalid User Name . Please Try Again";
        }
        if (!filter_var($_SESSION["email"], FILTER_VALIDATE_EMAIL)) {
            $message["emailError"] = "Invalid Email Address .";
        }
        if (mysqli_num_rows($query) > 0) {
            $message["emailError"] = "Email Already Exist";
        }
        if (!checkLength($_SESSION["passwordInput"], 8)) {
            $message["passwordError"] = "Invalid Password . Please Enter At Least 8 Character";

        }
        if ($_SESSION["passwordInput"] != $_SESSION["repeatedPasswordInput"]) {
            $message["confirmPasswordError"] = "Password Is No Match";
        }
        if(!preg_match("/^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]\d{4}[\s.-]\d{4}$/", $_SESSION["phone"])) {
            $message["phoneError"] = "Please Enter A Valid Phone Number";
          }
        if (empty($message)) {
            $sql = "INSERT INTO users(name,email,phone,password)VALUES('" . $_SESSION['name'] . "','" . $_SESSION['email'] . "','" . $_SESSION['phone'] . "'," . $_SESSION['password'] . ")";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $message["success"] = "Account Is Created Successfully . Please Login";
                $path = "/pages/auth/login.php";
            } else {
                $message["error"] = "SomeThing Went Wrong .";

            }
        }
    } else {
        $message["error"] = "All Field Is Required";
    }
    $_SESSION["message"] = $message;
    header("location: $path");
}
if (isset($_POST["loginForm"])) {
    $message = [];
    $formIsValid = checkForm($_POST, ['email', 'password']);
    if ($formIsValid) {
        $email = $_POST["email"];
        $password = $_POST["password"];
        $query = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password ='$password'");
        $result = mysqli_fetch_array($query);
        if (mysqli_num_rows($query) > 0) {
            $message["success"] = "You Have Logged In Successfully";
            $_SESSION["userLog"] = $result["id"];
            $_SESSION["userName"] = $result["name"];
            $path = "/myPosts.php";
        } else {
            $message["error"] = "Invalid Email Or Password";
            $path = "/pages/auth/login.php";
        }
    } else {
        $message["error"] = "Data Is Missing";
        $path = "/pages/auth/login.php";
    }
    $_SESSION["message"] = $message;
    header("location: $path");
}
if (isset($_POST["logout"])) {
    unset($_SESSION["userLog"]);
    $_SESSION["message"] = "You've Signed out.";
    header("location: /pages/auth/login.php");
}
?>