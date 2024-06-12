<?php

    require "libs/variables.php";
    require "libs/functions.php";

    if(!isAdmin()){
        header("Location: unauthorized.php");
    }

    if(!empty($_GET["id"])){
        $id = $_GET["id"];
    }

    if(deleteCategory($id)){
            $_SESSION["message"] = "Category with id: ". $id. " is deleted successfully.";
            $_SESSION["type"] = "success";
            header("Location: admin-categories.php");
    }else{
            $_SESSION["message"] =" An error occured while deleting";
            $_SESSION["type"] = "danger";
        }
        
    

?>

