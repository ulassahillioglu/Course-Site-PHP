<?php

require "libs/variables.php";
require "libs/functions.php";


?>
<?php include 'partials/_message.php' ?>

<?php
    

    $result = getCoursesToHomepage(true,true);



?>


<?php include 'partials/_navbar.php' ?>
<?php include 'partials/_header.php' ?>

<div class="container my-3">
    <div class="row">
        <div class="col-3">
            <?php include 'partials/_menu.php' ?>

        </div>
        <div class="col-9">
            <?php include 'partials/_title.php' ?>


            <?php if (mysqli_num_rows($result) > 0) : ?>
                <?php while ($course = mysqli_fetch_assoc($result)) : ?>

                    <div class="card mb-3">
                        <div class="row">

                            <div class="col-4">
                                <img src="img/<?php echo $course["imageUrl"] ?>" alt="" class="img-fluid rounded-start">
                            </div>
                            <div class="col-8">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <a href="course-details.php?id=<?php echo $course["id"] ?>"><?php echo $course["title"] ?></a>

                                    </h5>
                                    <p class="card-text">
                                        <?php echo shortDesc($course["subtitle"]) ?>

                                    </p>
                                    <p>
                                        <?php if ($course["likes"] > 0) : ?>

                                            <span class="badge rounded-pill text-bg-primary">
                                                Likes:<?php echo $course["likes"] ?>
                                            </span>
                                        <?php else : ?>
                                            <span class="badge rounded-pill text-bg-warning">

                                                Be the first to like
                                            </span>
                                        <?php endif ?>

                                        <?php if ($course["comments"] > 0) : ?>
                                            <span class="badge rounded-pill text-bg-danger">

                                                Comments:<?php echo $course["comments"] ?>
                                            </span>
                                        <?php else : ?>
                                            <span class="badge rounded-pill text-bg-warning">

                                                Be the first to comment
                                            </span>

                                        <?php endif ?>

                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>
                <?php endwhile ?>
            <?php else :  ?>
                <div class="alert alert-warning">
                    Course not found
                </div>
            <?php endif;  ?>



        </div>
    </div>

</div>

<?php include 'partials/_footer.php' ?>