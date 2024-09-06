<?php

    require "libs/variables.php";
    require "libs/functions.php";



?>

<?php

    if (!isset($_GET["id"]) or !is_numeric($_GET["id"])) {
        header("Location: index.php");
    }

    $courseId = $_GET["id"];
    $result = getCourseById($courseId);
    if($_SERVER["REQUEST_METHOD"]=="POST"){

        if (!isset($_SESSION["id"]) or !is_numeric($_SESSION["id"])) {
            header("Location: login.php");
        }
        $userId = $_SESSION["id"];

        if (joinCourse($userId,$courseId)) {
            $_SESSION["message"] = "Enrolled successfully.";
            $_SESSION["type"] = "success";
            header("Location: index.php");
            exit();
        }else {
            $_SESSION["message"] = "An error occured.";
            $_SESSION["type"] = "danger";
        }
        
    }
?>



<?php include 'partials/_navbar.php' ?>

<?php include 'partials/_header.php' ?>


<?php if (mysqli_num_rows($result) > 0) : ?>
    <?php while ($course = mysqli_fetch_assoc($result)) : ?>
        <div class="container my-3">
            <div class="card">
                <div class="row">

                    <div class="col-4">
                        <img class="img-fluid course-image" src="img/<?php echo $course["imageUrl"] ?>" alt="<?php echo $course["title"] ?>">
                    </div>

                    <div class="col-8">
                        <div class="card-body">
                            <h1 class="h4 card-title"><?php echo $course["title"] ?></h1>
                            <p class="card-text"><?php echo $course["subtitle"] ?></p>
                            <hr>
                            <div class="card-footer alert alert-info courseDesc"><?php echo html_entity_decode($course["cDescription"])?></div>
                        </div>
                    </div>

                </div>
                </div>
                <?php 
                if (!isset($_SESSION['courses'])) {
                    $_SESSION['courses'] = []; // Initialize courses as an empty array if not set
                }
                
                if(!in_array($courseId,$_SESSION['courses'])) : ?>
                    <form action="" method="post">
                        <button type="submit" name="join" id="join" class="btn btn-primary mt-3" style="float: right;">Enroll Now</button>
                    </form>
                <?php else : ?>
                    <button type="submit" name="joined" id="joined" class="btn btn-secondary mt-3 disabled" style="float: right;" >Enrolled</button>
                <?php endif;  ?>
        </div>

        </div>
    <?php endwhile ?>
<?php else :  ?>
    <div class="alert alert-warning">
        Course not found
    </div>
<?php endif;  ?>

<?php include 'partials/_footer.php' ?>