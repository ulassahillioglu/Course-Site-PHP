<?php

require "libs/variables.php";
require "libs/functions.php";
include 'partials/_message.php';

if (!isLoggedIn()) {
    header("Location: login.php");
}

?>

<?php include 'partials/_navbar.php' ?>
<?php include 'partials/_header.php' ?>

<?php

if (!isset($_SESSION['id']) or !is_numeric($_SESSION["id"])) {
    header("Location: login.php");
}

$id = $_SESSION['id'];

$username = $email = $password = $imageUrl =  "";
$usernameErr = $emailErr = $passwordErr  = $imageUrlErr = "";

$result = getUserInfo($_SESSION['id']);
$user = mysqli_fetch_assoc($result);


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST['username'])) {
        $usernameErr =  "Username is required" . "<br>";
    } elseif (strlen($_POST["username"]) < 5 or strlen($_POST["username"]) > 20) {
        $usernameErr = "Username must be between 5-20 characters.";
    } elseif (!preg_match('/^[A-Za-z][A-Za-z0-9]{4,19}$/', $_POST['username'])) {
        $usernameErr = "Please use only letters,numbers or underscore(_)";
    } else {
        $username = safe_html($_POST['username']);
    }


    //------------------------------------------
    if (empty($_POST['password'])) {
        $passwordErr = "Passowrd is required" . "<br>";
    } else {
        $password = safe_html($_POST['password']);
    }
    //------------------------------------------

    //------------------------------------------

    if (empty($_POST['email'])) {
        $emailErr = "Email is required" . "<br>";
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $emailErr =  "Invalid email format";
    } else {
        $email = safe_html($_POST['email']);
    }

    $uploaded = false;
    if (empty($_FILES["imageFile"]["name"])) {
        $imageUrl = $user["imageUrl"]; //if the user does not upload a new file, php uses the current file
    } else {
        $uploaded = uploadUserImage($_FILES["imageFile"]); // if user uploads a new image, binds the new filename to $uploaded variable

    }

    if ($uploaded) {
        $newImageUrl = $uploaded;
    }

    if (empty($usernameErr) && empty($emailErr) && empty($imageUrlErr) && empty($passwordErr)) {

        if ($uploaded) {
            updateUserInfo($id, $username, $password, $email, $newImageUrl);
        } else {

            updateUserInfo($id, $username, $password, $email, $imageUrl);
        }

        $_SESSION["message"] = "User info is updated.";
        $_SESSION["type"] = "success";
        header("Location: user-profile.php");
    } else {
        $_SESSION["message"] = "An error occured";
        $_SESSION["type"] = "danger";
    }
}


?>


<div class="container my-3">

    <div class="row">
            <div class="col-2">

                <img style="width: 150px;" src="img/user/<?php echo $user['imageUrl'] ?>" alt="...">
            </div>
            <div class="col-10">

                <form method="post" enctype="multipart/form-data">

                    <div class="mb-3">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control" value="<?php echo $user['username']; ?>">
                        <div class="text-danger"><?php echo $usernameErr ?></div>
                    </div>

                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" value="<?php echo $user['email']; ?>">
                        <div class="text-danger"><?php echo $emailErr ?></div>

                    </div>

                    <div class="mb-3">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" value="<?php echo $user['userPass']; ?>">
                        <div class="text-danger"><?php echo $passwordErr ?></div>

                    </div>

                    <div class=" col-md-4">
                        <div class="input-group mb-3">
                            <input class="form-control" type="file" name="imageFile" id="imageFile">
                            <div class="text-danger"><?php echo $imageUrlErr ?></div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>

                </form>
            </div>
        </div>
    </div>

</div>

<?php include 'partials/_footer.php' ?>