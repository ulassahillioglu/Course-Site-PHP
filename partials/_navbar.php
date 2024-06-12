
<nav class="navbar navbar-expand-lg bg-primary navbar-dark">
    <div class="container">
        <a href="index.php" class="navbar-brand">CourseApp</a>
        <ul class="navbar-nav me-auto">
            <li class="nav-item">
                <a href="index.php" class="nav-link">Home</a>
            </li>
            <?php if (isAdmin()) : ?>

                <li class="nav-item">
                    <a href="admin-categories.php" class="nav-link">Categories(Admin)</a>
                </li>
                <li class="nav-item">
                    <a href="admin-courses.php" class="nav-link">Courses(Admin)</a>
                </li>
            <?php endif;  ?>
            <li class="nav-item">
                <a href="contact.php" class="nav-link">Contact Us</a>
            </li>
        </ul>

        <ul class="navbar-nav me-2">

            <?php if (isLoggedIn()) : ?>


                <li class="nav-item" hidden>
                    <a href="logout.php" class="nav-link">Logout</a>

                </li>

                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img class="img-fluid rounded-circle mx-2" src="img/user/<?php echo $_SESSION['imageUrl'] ?>" alt="" style="width: 50px;">
                        Welcome, <?php echo $_SESSION["username"] ?>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a href="user-profile.php" class="dropdown-item">Profile</a></li>
                        <li><a href="user-courses.php" class="dropdown-item">My Courses</a></li>
                        <li><a href="settings.php" class="dropdown-item">Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a href="logout.php" class="dropdown-item">Logout</a></li>
                    </ul>
                </li>

                    <?php else :  ?>

                <li class="nav-item">
                    <a href="login.php" class="nav-link">Login</a>

                </li>

                <li class="nav-item">
                    <a href="register.php" class="nav-link">Register</a>

                </li>
            <?php endif;  ?>
        </ul>

        <form action="courses.php" method="get" class="d-flex my-3">
            <input type="text" name="q" class="form-control me-2" placeholder="Keyword">
            <button type="submit" class="btn btn-info">Search</button>
        </form>
    </div>
</nav>