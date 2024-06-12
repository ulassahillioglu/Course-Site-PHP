<h1 class="mb-3"><?php echo title ?></h1>
<p class="lead">
    

    <?php 

    $categoryCount = 0;

    foreach(getCategories() as $category){
        $categoryCount +=1;
    }

    $coursesTitle = countVerified(getCoursesToHomepage()) . " courses listed in " . $categoryCount . " categories." ;
    
    echo $coursesTitle ;
    
    
    ?>
</p>