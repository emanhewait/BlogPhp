<?php
include("../../shared/header.php");
?>
<div class="col-lg-8">
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-3">
                    <p class="mb-0">Name</p>
                </div>
                <div class="col-sm-9">
                    <p class="text-muted mb-0">
                        <?php echo $row['name']; ?>
                    </p>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-3">
                    <p class="mb-0">Email</p>
                </div>
                <div class="col-sm-9">
                    <p class="text-muted mb-0">
                        <?php echo $row['email']; ?>
                    </p>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-3">
                    <p class="mb-0">Phone</p>
                </div>
                <div class="col-sm-9">
                    <p class="text-muted mb-0">
                        <?php echo $row['phone']; ?>
                    </p>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-3">
                    <p class="mb-0">Password</p>
                </div>
                <div class="col-sm-9">
                    <p class="text-muted mb-0">
                        <?php echo $row['password']; ?>
                    </p>
                </div>
            </div>
            <hr>
            <div class="row justify-content-center">
                <div class="col-md-4">
                   <a href="/views/auth/userUpdate.php?id=
                        <?php echo $_SESSION["userLog"]; ?>">
                        <button class="btn btn-primary" style="width:100%;">
                        Edit
                        </button>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="/controller/post/myPosts.php">
                        <button class="btn btn-danger" style="width:100%;">
                        Cancel
                        </button>
                </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include("../../shared/footer.php");
?>