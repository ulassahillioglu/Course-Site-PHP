<?php

    require "libs/variables.php";
    require "libs/functions.php";
    include 'partials/_message.php';


    if(!isAdmin()){
        header("Location: unauthorized.php");
    }

?>

<?php include 'partials/_navbar.php' ?>
<?php include 'partials/_header.php' ?>

<div class="container my-3">
    <div class="row">
        <div class="col-12">
            <div class="border p-2 mb-2">
                <a href="category-create.php" class="btn btn-primary">Add Category</a>
            </div>
            <table class="table table-bordered table-dark">
                <thead>
                    <tr>
                        <th style="width: 50px;">ID</th>
                        <th>Category Name</th>
                        <th style="width: 150px;"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $result = getCategories(); while($category = mysqli_fetch_assoc($result)):  ?>
                    <tr>
                        <td><?php echo $category["id"]  ?></td>
                        <td><?php echo $category["categoryName"]  ?></td>
                        <td>
                            <a href="category-edit.php?id=<?php echo  $category["id"];  ?>" class="btn btn-primary btn-sm">Edit</a>
                            <a href="category-delete.php?id=<?php echo  $category["id"];  ?>" class="btn btn-danger btn-sm">Remove</a>
                        </td>
                    </tr>
                    <?php endwhile  ?>
                </tbody>
            </table>

        </div>
    </div>

</div>

<?php include 'partials/_footer.php' ?>