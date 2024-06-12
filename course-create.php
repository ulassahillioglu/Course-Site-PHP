<?php

    require "libs/variables.php";
    require "libs/functions.php";

    if(!isAdmin()){
        header("Location: unauthorized.php");
    }


?>

<?php include 'partials/_navbar.php' ?>
<?php include 'partials/_header.php' ?>


<?php


$title = $subtitle = $imageUrl = $description ="";
$titleErr = $subtitleErr = $imageUrlErr  = $descErr = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {


    if (empty($_POST["title"])) {
        $titleErr = "Title is required.";
    } else {
        $title = safe_html($_POST["title"]);
    }

    if (empty($_POST["subtitle"])) {
        $subtitleErr = "Subtitle is required.";
    } else {
        $subtitle = safe_html($_POST["subtitle"]);
    }

    if (empty($_POST["description"])) {
        $descErr = "Description is required.";
    } else {
        $description = safe_html($_POST["description"]);
    }

    if (empty($_FILES["imageFile"]["name"])) {
        $imageUrlErr = "Image is required.";
    } else {
        $uploaded = uploadImage($_FILES["imageFile"]);
        $imageUrl = $uploaded;
    }

   
    if (empty($titleErr) && empty($subtitleErr) && empty($imageUrlErr) && empty($descErr)) {
        if ($uploaded) {

            createCourse($title, $subtitle, $description ,$imageUrl );
            $_SESSION["message"] = $title . " added to courses.";
            $_SESSION["type"] = "success";
            header("Location: admin-courses.php");
        }
    }
}

?>





<div class="container my-3">
    <div class="row">
        <div class="col-12">
            <div class="card card-body mb-3">
                <form method="post" enctype="multipart/form-data">
                    
                    <div class="mb-3">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-control" value="<?php echo $title; ?>">
                        <div class="text-danger"><?php echo $titleErr ?></div>
                    </div>

                    <div class="mb-3">
                        <label for="subtitle">Subtitle</label>
                        <textarea name="subtitle" class="form-control"><?php echo $subtitle; ?></textarea>
                        <div class="text-danger"><?php echo $subtitleErr ?></div>
                    </div>

                    <div class="mb-3">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control"><?php echo $description; ?></textarea>
                        <div class="text-danger"><?php echo $descErr ?></div>
                    </div>

                    <div class="input-group mb-3">
                        <input class="form-control" type="file" name="imageFile" id="imageFile">
                        <label for="imageFile" class="input-group-text">Yükle</label>
                    </div>
                    <div class="text-danger"><?php echo $imageUrlErr ?></div>
                    
            </div>
            <button type="submit" class="btn btn-primary">Save</button>

            </form>
        </div>
    </div>
</div>

</div>

<?php include 'partials/_editor.php' ?>
<?php include 'partials/_footer.php' ?>
