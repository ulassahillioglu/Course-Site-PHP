<?php

require "libs/variables.php";
require "libs/functions.php";
include 'partials/_message.php';

if(isset($_SESSION["loggedIn"])){
    header("Location: index.php");
}

$username  = $password   =  "";
$usernameErr =  $passwordErr = "";

if (isset($_POST["login"])) {

    if (empty($_POST['username'])) {
        $usernameErr = "Username is required" . "<br>";
    } else {
        $username = safe_html($_POST['username']);
    }

    if (empty($_POST['password'])) {
        $passwordErr = "Password is required" . "<br>";
    } else {
        $password = safe_html($_POST['password']);
    }

    if (empty($usernameErr) && empty($passwordErr)) {
        if (login($username, $password)) {
            $_SESSION["message"] = "Login successful.";
            $_SESSION["type"] = "success";
            header("Location: index.php");
            exit();
        } else {
            $loginErr = "Invalid username or password.";
        }
    }
}



?>

<?php include 'partials/_navbar.php' ?>
<?php include 'partials/_header.php' ?>

<div class="container my-3">
    <div class="row">
        <div class="col-12">
            <form action="login.php" method="post">

                <div class="mb-3">
                    <label for="username">Username</label>
                    <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                    <div class="text-danger"><?php echo $usernameErr ?></div>
                </div>

                <div class="mb-3">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control">
                    <div class="text-danger"><?php echo $passwordErr ?></div>
                </div>
                <?php if (!empty($loginErr)): ?>
                    <div class="alert alert-danger"><?php echo $loginErr; ?></div>
                <?php endif; ?>

                <button type="submit" class="btn btn-primary" name="login">Login</button>
            </form>

        </div>
    </div>

</div>

<?php include 'partials/_footer.php' ?>