<?php 

    if (isset($_SESSION["message"])) {
        echo "<div class='alert alert-".$_SESSION["type"]." alert-dismissible fade show mb-0 text-center'>" . $_SESSION["message"]
            . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' . "</div>";
        unset($_SESSION["message"]);
    }
    

?>