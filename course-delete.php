<?php include 'partials/_navbar.php' ?>
<?php include 'partials/_header.php' ?>

<?php

    require "libs/variables.php";
    require "libs/functions.php";

    if(!isAdmin()){
        header("Location: unauthorized.php");
    }

    if (empty($_GET["id"])) {
        header("Location: admin-courses.php");
    }
    $id = $_GET["id"];

    $result = getCourseById($id);
    $course = mysqli_fetch_assoc($result);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (deleteCourse($id)) {
            $_SESSION["message"] = "Course with id: " . $id . " is deleted.";
            $_SESSION["type"] = "danger";
            header("Location: admin-courses.php");
        } else {
            $_SESSION["message"] = " An error occured while deleting";
            $_SESSION["type"] = "danger";
        }
    }



?>

<div class="container my-3">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <form method="post">
                            Do you want to delete <b><?php echo $course["title"];  ?></b>
                            <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>




<?php include 'partials/_footer.php' ?>