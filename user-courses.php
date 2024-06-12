<?php

require "libs/variables.php";
require "libs/functions.php";
include 'partials/_message.php';

if (!isLoggedIn()) {
    header("Location: login.php");
}

?>

<?php include 'partials/_navbar.php' ?>
<?php include 'partials/_header.php' ?>


<div class="container my-3">
    <div class="row">
        <?php $result = getUserCourses($_SESSION['id']);while ($course = mysqli_fetch_assoc($result)) :  ?>
            <div class="col-md-4">
                <div class="card mb-3 course-card">
                    <img src="img/<?php echo $course['imageUrl'] ?>" alt="" class="img-fluid" style="height: 250px;">
                    <div class="card-body">
                        <h5 class="card-title">

                            <?php echo $course['title']  ?>
                        </h5>
                    </div>
                    <div class="card-footer text-center">
                        <small class="text-body-secondary"><a href="#" class="btn btn-primary" id="start" style="width: 150px;">Start Course</a></small>
                    </div>
                    
                </div>

            </div>
        <?php endwhile;  ?>
    </div>

</div>

<?php include 'partials/_footer.php' ?>