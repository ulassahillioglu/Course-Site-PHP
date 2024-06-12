<?php

require "libs/variables.php";
require "libs/functions.php";

?>

<?php include 'partials/_header.php' ?>
<?php include 'partials/_navbar.php' ?>

<?php

$username = $email = $password = $repassword  =  "";
$usernameErr = $emailErr = $passwordErr = $repasswordErr = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {


    if (empty($_POST['username'])) {
        $usernameErr =  "Username is required" . "<br>";
    } elseif (strlen($_POST["username"])<5 or strlen($_POST["username"])>20 ) {
        $usernameErr = "Username must be between 5-20 characters.";
    } elseif ( !preg_match('/^[A-Za-z][A-Za-z0-9]{4,19}$/', $_POST['username']) ) {
        $usernameErr = "Please use only letters,numbers or underscore(_)";
    } else {

        if(usernameOrEmailExists(safe_html($_POST['username']),"")){
            $usernameErr ="Username already exists. Please choose a different username.";
        }else{
            $username = safe_html($_POST['username']);

        }
        
    }
    //------------------------------------------
    if (empty($_POST['password'])) {
        $passwordErr = "Passowrd is required" . "<br>";
    } else {
        $password = safe_html($_POST['password']);
    }
    //------------------------------------------

    if ($_POST['password'] != $_POST['repassword']) {
        $repasswordErr = "Passwords do not match" . "<br>";
    } else {
        $repassword = safe_html($_POST['repassword']);
    }
    //------------------------------------------

    if (empty($_POST['email'])) {
        $emailErr = "Email is required" . "<br>";
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $emailErr =  "Invalid email format";
    } else {

        if(usernameOrEmailExists("" ,safe_html($_POST['email']))){
            $emailErr ="E-mail already in use. Please choose a different email.";
        }else{
            $email = safe_html($_POST['email']);
        }
        
    }
    //------------------------------------------

    if(empty($usernameErr)  && empty($passwordErr) && empty($repasswordErr) && empty($emailErr)){
        
        if(registerUser($username,$password,$email)){

            $_SESSION["message"] = "Successfully registered to website.";
            $_SESSION["type"] = "success";
            header("Location: login.php");
            exit();
        }else{
            $_SESSION["message"] =" An error occured while registering.";
            $_SESSION["type"] = "danger";
        }
    }

}

?>

<div class="container my-3">
    <div class="row">
        <div class="col-12">
            <form action="register.php" method="post" novalidate>
                <div class="mb-3">
                    <label for="username">Username</label>
                    <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                    <div class="text-danger"><?php echo $usernameErr ?></div>
                </div>
                <div class="mb-3">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
                    <div class="text-danger"><?php echo $emailErr ?></div>

                </div>
                <div class="mb-3">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                    <div class="text-danger"><?php echo $passwordErr ?></div>

                </div>
                <div class="mb-3">
                    <label for="repassword">Re-Password</label>
                    <input type="password" name="repassword" class="form-control">
                    <div class="text-danger"><?php echo $repasswordErr ?></div>

                </div>
                

                <button type="submit" class="btn btn-primary">Register</button>
            </form>

        </div>
    </div>

</div>

<?php include 'partials/_footer.php' ?>