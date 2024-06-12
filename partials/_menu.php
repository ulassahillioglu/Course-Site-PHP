<?php 
    if(isset($_GET["categoryId"])&&is_numeric($_GET["categoryId"])){
        $id = $_GET["categoryId"];
    }

?>





<div class="list-group">
    <a href="courses.php" class="list-group-item list-group-item-action">All Courses</a>
    <?php foreach (getCategories() as $category) : ?>
        <a href="<?php echo 'courses.php?categoryId='. $category["id"]; ?>" class="list-group-item list-group-item-action     
        <?php 
            if($id == $category["id"]){
                echo "active";
            }   
        ?>      
        ">
            <?php echo $category["categoryName"] ?>
        </a>
    <?php endforeach ?>
</div>