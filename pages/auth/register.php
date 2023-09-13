<?php
include("../../shared/header.php");
include("../../validation.php");
if (!isset($_SESSION))
    session_start();
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
?>
<br>.<br>
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="auth-form">
            <?php if (isset($message["error"])) {
                echo "<p class='alert alert-danger  mt-2'>" . $message["error"] . "</p>";
            }
            ?>
            <form action="/auth.php" method="POST">
                <h2 class="text-center">Sign Up</h2>
                <br>
                <div class="form-group">
                    <input type="text" name='name' class="form-control" placeholder="Username"
                        value="<?php echo $name; ?>">
                    <?php if (isset($message["nameError"])) {
                        echo "<p class='alert alert-danger  mt-2'>" . $message["nameError"] . "</p>";
                    }
                    ?>
                </div>
                <div class="form-group">
                    <input type="text" name='email' class="form-control" placeholder="email"
                        value="<?php echo $email; ?>">
                    <?php if (isset($message["emailError"])) {
                        echo "<p class='alert alert-danger  mt-2'>" . $message["emailError"] . "</p>";
                    }
                    ?>
                </div>

                <div class="form-group">
                    <input type="tel" name='phone' class="form-control" placeholder="Phone"
                        value="<?php echo $phone; ?>">
                        <?php if (isset($message["phoneError"])) {
                        echo "<p class='alert alert-danger  mt-2'>" . $message["phoneError"] . "</p>";
                    }
                    ?>
                </div>
                <div class="form-group">
                    <input type="password" name='password' class="form-control" placeholder="Password"
                        value="<?php echo $passwordInput; ?>">
                    <?php if (isset($message["passwordError"])) {
                        echo "<p class='alert alert-danger  mt-2'>" . $message["passwordError"] . "</p>";
                    }
                    ?>
                </div>
                <div class="form-group">
                    <input type="password" name='passwordConfirm' class="form-control" placeholder="Confirm Password"
                        value="<?php echo $repeatedPasswordInput; ?>">
                    <?php if (isset($message["confirmPasswordError"])) {
                        echo "<p class='alert alert-danger  mt-2'>" . $message["confirmPasswordError"] . "</p>";
                    }
                    ?>
                </div>
                <div class="form-group">
                    <input type="submit" name="regForm" class="btn btn-primary btn-block" value="Create Account">
                </div>
            </form>
        </div>
    </div>
</div>
<?php
include("../../shared/footer.php");
?>