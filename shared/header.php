<?php
if (!isset($_SESSION))
    session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/layout.css">
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
</head>

<body>
    <header>
        <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark scrolling-navbar">
            <div class="container">
                <a class="navbar-brand waves-effect">
                    <strong class="text-white">Blogger</strong>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <?php if (isset($_SESSION["userLog"])) { ?>
                            <li class="nav-item">
                                <a class="nav-link waves-effect" href="../../controller/post/myPosts.php">All Posts</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link waves-effect" href="../../views/posts/create.php">Create Post</a>
                            </li>
                            <li class="nav-item">
                                <form action="" method="GET">
                                    <input type="text" name="search" class="form-control" placeholder="Search">
                                </form>
                            </li>
                        <?php } ?>
                    </ul>

                    <?php if (!isset($_SESSION["userLog"])) { ?>
                        <ul class="navbar-nav nav-flex-icons">
                            <li class="nav-item">
                                <a href="/views/auth/login.php" class="nav-link waves-effect">Login</a>
                            </li>
                            <li class="nav-item">
                                <a href="/views/auth/register.php" class="nav-link waves-effect">Register</a>
                            </li>
                        </ul>
                    <?php } else { ?>

                        <ul class="navbar-nav nav-flex-icons">
                            <li class="nav-item">
                                <a href="../../controller/user/userData.php?id=<?php echo $_SESSION["userLog"]; ?>"
                                    class="nav-link waves-effect">
                                    Welcome
                                    <?= $_SESSION["userName"] ?>
                                </a>
                            </li>
                            <li class="nav-item">
                                <form action="../../controller/user/logout.php" method="post">
                                    <input type="hidden" name="logout" value="logout">
                                    <button type='submit' class="nav-link waves-effect bg-transparent border-0"
                                        style="cursor:pointer;">Logout</button>
                                </form>
                            </li>
                        </ul>
                    <?php } ?>
                </div>
            </div>
        </nav>
    </header>
    <main class="mt-5 pt-5">
        <div class="container">