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


if (!empty($_GET["id"])) {
    $id = $_GET["id"]; //id of the selected course
}


$result = getCourseById($id);
$selectedCourse = mysqli_fetch_assoc($result);

$categories = [];
$title = $subtitle = $imageUrl = $verified = $description = "";
$titleErr = $subtitleErr = $imageUrlErr  = $verifiedErr  = $descErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    if (empty($_POST["title"])) {
        $titleErr = "Title is required.";
    } else {
        $title = safe_html($_POST["title"]);
    }
    //---------------------------------------
    if (empty($_POST["subtitle"])) {
        $subtitleErr = "Subtitle is required.";
    } else {
        $subtitle = safe_html($_POST["subtitle"]);
    }
    //---------------------------------------
    if (empty($_POST["description"])) {
        $descErr = "Description is required.";
    } else {
        $description = safe_html($_POST["description"]);
    }
    //---------------------------------------
  
    if(isset($_POST["categories"])){
        $categories = $_POST["categories"];
    } 
    //-----------------------------------------
    $uploaded = false;
    if (empty($_FILES["imageFile"]["name"])) {
        $imageUrl = $selectedCourse["imageUrl"]; //if the user does not upload a new file, php uses the current file
    } else{
        $uploaded = uploadImage($_FILES["imageFile"]); // if user uploads a new image, binds the new filename to $uploaded variable

    }

    if ($uploaded) {
        $newImageUrl = $uploaded;

    } 
    

    $verified = isset($_POST["verified"]) && $_POST["verified"] == "on" ? 1 : 0;
    $homepage = isset($_POST["homepage"]) && $_POST["homepage"] == "on" ? 1 : 0;
    



    if (empty($titleErr) && empty($subtitleErr) && empty($imageUrlErr) && empty($descErr) ) {

        if ($uploaded) {
            updateCourse($id, $title, $subtitle,$description, $newImageUrl,  $verified, $homepage);
        } else {

            updateCourse($id, $title, $subtitle,$description, $imageUrl, $verified, $homepage);
        }
        clearCourseCategories($id);
        if(count($categories)>0){
            addCourseCategories($id,$categories);
        }
        $_SESSION["message"] = $title . " is updated.";
        $_SESSION["type"] = "success";
        header("Location: admin-courses.php");
    } else {
        $_SESSION["message"] = "An error occured";
        $_SESSION["type"] = "danger";
    }
}

?>





<div class="container my-3">
    <div class="card card-body">
        <form method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-9">
                    <div class="mb-3">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-control" value="<?php echo $selectedCourse["title"]; ?>">
                        <div class="text-danger"><?php echo $titleErr ?></div>
                    </div>

                    <div class="mb-3">
                        <label for="subtitle">Subtitle</label>
                        <input type="text" name="subtitle" class="form-control" value="<?php echo $selectedCourse["subtitle"]; ?>">
                        <div class="text-danger"><?php echo $subtitleErr ?></div>
                    </div>

                    <div class="mb-3">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control">
                            <?php echo $selectedCourse["cDescription"]; ?></textarea>
                        <div class="text-danger"><?php echo $descErr ?></div>
                    </div>
                    
                    <div>
                        <div class="input-group mb-3">
                            <input class="form-control" type="file" name="imageFile" id="imageFile">
                            <label for="imageFile" class="input-group-text">Upload</label>
                            <div class="text-danger"><?php echo $imageUrlErr ?></div>
                        </div>
                    </div>


                    <button type="submit" class="btn btn-primary">Save</button>

                </div>
                <div class="col-3">
                    <img src="img/<?php echo $selectedCourse["imageUrl"]; ?>" class="img-fluid">
                    <hr>
                    <?php foreach (getCategories() as $c) :  ?>
                        <div class="form-check">
                            <label for="category_<?php echo $c["id"]; ?>"> <?php echo $c["categoryName"]; ?></label>
                            <input type="checkbox" name="categories[]" value="<?php echo $c["id"]?>" id="category_<?php echo $c["id"]; ?>" class="form-check-input" <?php

                                    $isChecked = false;
                                    $selectedCategories = getCategoriesByCourseId($selectedCourse["id"]);

                                    foreach ($selectedCategories as $selectedCategory) {
                                        if ($selectedCategory["id"] == $c["id"]) {
                                            $isChecked = true;
                                        }
                                    }

                                    if ($isChecked) {
                                            echo "checked";
                                    }

                            ?>>

                        </div>
                    <?php endforeach;  ?>

                    <hr>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="verified" name="verified" <?php echo $selectedCourse["verified"] ? "checked" : "";  ?>>
                        <label class="form-check-label" for="verified">
                            Verified
                        </label>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="homepage" name="homepage"
                         <?php echo $selectedCourse["homepage"] ? "checked" : "";  ?>>
                        <label class="form-check-label" for="homepage">
                            Homepage
                        </label>
                    </div>
                </div>
            </div>
        </form>

    </div>

</div>

<?php include 'partials/_editor.php' ?>
<?php include 'partials/_footer.php' ?>