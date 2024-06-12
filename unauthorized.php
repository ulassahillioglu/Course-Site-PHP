<?php

    require "libs/variables.php";
    require "libs/functions.php";


    if(!isLoggedIn()){
        header("Location: login.php");
    }


?>

<?php include 'partials/_navbar.php' ?>

<?php include 'partials/_header.php' ?>



<div class="container my-3">
    <div class="row">
        <div class="col-12">
            <h3>Hello <?php echo $_SESSION["username"] ?></h3>
            <p class="alert alert-danger">Unauthorized Access!</p>
            <a href="index.php" class="badge bg-secondary"> Return to Homepage</a>


        </div>
    </div>

</div>

<?php include 'partials/_footer.php' ?>