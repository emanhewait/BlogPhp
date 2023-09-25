<?php
include("../../shared/header.php");
require "../../ink.php";
$Id = $_GET['id'];
$row =$postManager->showPost($Id);
?>
<div class="card row" style="width: 50rem;">
    <div class="card-body bg-light">
        <h5 class="card-title ">
            <?php echo $row['title']; ?>
        </h5>
        <small id="article-meta">By
            <strong>
                <a href="">
                    <?php echo $row['name']; ?>
                </a>
            </strong>
        </small>
        
        <p class="card-text">
            <?php echo $row['body']; ?>
        </p>
        <h4>Comments : </h4>
        <?php foreach ($row['comments'] as $comment): ?>
            <small id="article-meta">User_name
                <strong class="text-primary">
                    <?php echo $comment['name'] ?>
                </strong>
            </small>
            <div class="card mb-4">
                <div class="card-body">
                    <?php echo $comment['description']; ?>
                </div>
            </div>
        <?php endforeach; ?>
        <div class=" d-flex justify-content-center">
        <a href="/controller/post/myPosts.php">
            <button class="btn btn-info" style="width:100% ;">
                Go Back
            </button>
        </a>
        </div>
    </div>
</div>
<?php
include("../../shared/footer.php");
?>