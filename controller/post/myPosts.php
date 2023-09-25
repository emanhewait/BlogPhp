<?php
require "../../ink.php";
if (!isset($_SESSION["userLog"])) {
    $message["success"] = "You must Login First";
    $_SESSION["message"] = $message;
    header("location:/views/auth/login.php");
    exit();
}
$posts= $postManager->showPosts();
include("../../views/posts/show.php");
?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const commentButtons = document.querySelectorAll('.comments-btn');

        commentButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                const postId = button.closest('.col-md-8').querySelector('.comments').id;
                const commentsSection = document.getElementById(postId);
                commentsSection.style.display = commentsSection.style.display === 'none' ? 'block' : 'none';
            });
        });
    });
</script>
