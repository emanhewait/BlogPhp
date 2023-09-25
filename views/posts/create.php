<?php
include("../../shared/header.php");
if (!isset($_SESSION["userLog"])) {
    $message["success"] = "You must Login First";
    $_SESSION["message"] = $message;
    header("location:./views/auth/login.php");
    exit();
}
?>
<div class="row">
    <h1>Create Post</h1>
    <div class="col-md-8 col-md-offset-2">
        <br>
        <?php
        if (isset($message["error"])) {
            echo "<p class='alert alert-danger  mt-2'>"
             . $message["error"] . "</p>";
        }
        ?>
        <form action="../../controller/post/createPost.php" method="POST"
         id="postForm">
            <div class="form-group">
                <label for="title">Title <span class="require">*</span></label>
                <input type="text" id="title" name="title"
                 class="form-control" />
            </div>
            <div class="form-group">
                <label for="body">Body</label>
                <textarea id="userText" rows="5" name="body"
                 class="form-control">
                </textarea>
            </div>

            <div class="form-group">
                <input type="submit" name='createPost' id="post-btn"
                 class="btn btn-primary" value='Create'>
                <a href="/controller/post/myPosts.php"
                 class="btn btn-danger">Cancel</a>
            </div>
        </form>
    </div>
</div>
<?php
include("../../shared/footer.php");
?>