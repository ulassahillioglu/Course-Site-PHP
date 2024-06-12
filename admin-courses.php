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
                <a href="course-create.php" class="btn btn-primary">Add Course</a>
            </div>
            <table class="table table-bordered table-dark table-striped table-hover">
                <thead>
                    <tr>
                        <th style="width: 50px;">ID</th>
                        <th style="width: 120px;">Image</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th style="width: 50px;">Verified</th>
                        <th style="width: 50px;">Homepage</th>
                        <th style="width: 150px;"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $result = getCoursesAdmin(); while($course = mysqli_fetch_assoc($result)):  ?>
                    <tr>
                        <td><?php echo $course["id"]  ?></td>
                        <td><img class="img-fluid" src="img/<?php echo $course["imageUrl"] ?>"></td>
                        <td><?php echo $course["title"]  ?></td>
                        <td>
                            <?php 

                                echo "<ul>";
                                $categoryNames = getCategoriesByCourseId($course["id"]);
                                
                                if(mysqli_num_rows($categoryNames)>0){
                                    while($category = mysqli_fetch_assoc($categoryNames)){
                                        echo "<li>". $category["categoryName"] . "</li>";
                                    }
                                }else{
                                    echo "<li>Category not found</li>";
                                }
                                
                               echo "</ul>";

                            ?>
                        </td>
                        <td>
                            <?php if  ($course["verified"]):  ?>
                                <i class="fas fa-check"></i>
                            <?php else: ?>
                                <i class="fas fa-cancel"></i>
                            <?php endif;  ?>
                        </td>
                        <td>
                            <?php if  ($course["homepage"]):  ?>
                                <i class="fas fa-check"></i>
                            <?php else: ?>
                                <i class="fas fa-cancel"></i>
                            <?php endif;  ?>
                        </td>
                        <td>
                            <a href="course-edit.php?id=<?php echo  $course["id"];  ?>" class="btn btn-primary btn-sm">Edit</a>
                            <a href="course-delete.php?id=<?php echo  $course["id"];  ?>" class="btn btn-danger btn-sm">Remove</a>
                        </td>
                    </tr>
                    <?php endwhile  ?>
                </tbody>
            </table>

        </div>
    </div>

</div>

<?php include 'partials/_footer.php' ?>