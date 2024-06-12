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


if(!empty($_GET["id"])){
    $id = $_GET["id"];
}


$result = getCategoryById($id);
$selectedCategory = mysqli_fetch_assoc($result);


$category = $categoryErr = "";

if($_SERVER["REQUEST_METHOD"]=="POST"){

    
    if (empty($_POST["category"])) {
        $categoryErr = "Category name is required.";
    }else{
        $category = safe_html($_POST["category"]);
        
    }

    if(empty($categoryErr)){
        if(updateCategory($category,$id)){
            $_SESSION["message"] = $category. " updated successfully.";
            $_SESSION["type"] = "success";
            header("Location: admin-categories.php");
        }else{
            $_SESSION["message"] =" An error occured while updating";
            $_SESSION["type"] = "danger";
        }
        
    }
    
}

?>





<div class="container my-3">
    <div class="row">
        <div class="col-12">
            <div class="card card-body">
                <form method="post">
                    <div class="mb-3">
                        <label for="category">Category Name</label>
                        <input type="text" name="category" class="form-control" value="<?php echo $selectedCategory["categoryName"]; ?>">
                        <div class="text-danger"><?php echo $categoryErr ?></div>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>

                </form>
            </div>
        </div>
    </div>

</div>



<?php include 'partials/_footer.php' ?>