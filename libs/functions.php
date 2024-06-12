<?php
    session_start();

    function joinCourse(int $id,int $courseId){
        include "settings.php"; 

        $query = "INSERT INTO user_course(userId, courseId) VALUES(?, ?)";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("ii", $id, $courseId);

        // Execute the statement
        if ($stmt->execute()) {
            // Update the session courses
            $query2 = "SELECT courseId FROM user_course WHERE userId=?";
            $stmt2 = $connection->prepare($query2);
            $stmt2->bind_param("i", $id);
            $stmt2->execute();
            $result = $stmt2->get_result();

            $courses = [];
            while ($row = $result->fetch_assoc()) {
                $courses[] = $row['courseId'];
            }
            session_start(); // Ensure session is started
            $_SESSION['courses'] = $courses;

            $stmt2->close();
            $stmt->close();
            $connection->close();

            return true;
        } else {
            $stmt->close();
            $connection->close();
            return false;
        }
    }
    
    function isAdmin(){
        return (isLoggedIn() && isset($_SESSION["user_type"]) && $_SESSION["user_type"]=="admin" );
    }

    function isLoggedIn(){
        return (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == true);
    }

    function login(string $username, string $password) {
        include "settings.php"; 

        $query = "SELECT id, username, userPass,user_type,imageUrl FROM users WHERE username=?";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        
        // Check if the username exists
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $db_username, $db_password, $user_type, $db_imageUrl);
            $stmt->fetch();

            // Verify the password
            if (password_verify($password, $db_password)) {
                // Password is correct, create session
                session_start();
                $_SESSION['id'] = $id;
                $_SESSION['username'] = $username;
                $_SESSION['loggedIn'] = true;
                $_SESSION['user_type'] = $user_type;
                $_SESSION['courses'] = $courseId;
                $_SESSION['imageUrl'] = $db_imageUrl;
                
                $query2 = "SELECT courseId FROM user_course WHERE userId=?";
                $stmt2 = $connection->prepare($query2);
                $stmt2->bind_param("i", $id);
                $stmt2->execute();
                $result = $stmt2->get_result();

                $courses = [];
                while ($row = $result->fetch_assoc()) {
                    $courses[] = $row['courseId'];
                }
                $_SESSION['courses'] = $courses;

                $stmt2->close();
                $stmt->close();
                $connection->close();

                echo $_SESSION["username"]." ".$_SESSION["loggedIn"] ;
                return true; // Login successful
            } else {
                $stmt->close();
                $connection->close();
                return false; // Incorrect password
            }
        } else {
            $stmt->close();
            $connection->close();
            return false; // Username does not exist
        }
    }

    function registerUser(string $username,string $password,string $email){
        include "settings.php";

        $query = "INSERT INTO users(username,userPass,email) VALUES(?,?,?)";
        
        $stmt = mysqli_prepare($connection, $query);
        
        if ($stmt === false) {
            
            mysqli_close($connection);
            return false;
        }
        
        $password = password_hash($password,PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt, 'sss', $username, $password, $email );
        $result = mysqli_stmt_execute($stmt);
        
        mysqli_stmt_close($stmt);
        mysqli_close($connection);
        
        return $result;

    }

    function usernameOrEmailExists(string $username="",string $email=""){
        include "settings.php";

        $params = [];
        $types = '';

        $query = "SELECT id from users";

        if(!empty($username)){
            $query .= " WHERE username=?";
            $types .= 's';
            $params[] = $username;
        }
        
        if(!empty($email)){
            if(str_contains($query,"WHERE")){
                $query .= " AND email=?";
                $types .= 's';
                $params[] = $email;
            }else{
                $query .= " WHERE email=?";
                $types .= 's';
                $params[] = $email;
            }
            

        }

        
        $stmt = $connection->prepare($query);
        $stmt->bind_param($types,...$params);

        $stmt->execute();
        $stmt->bind_result($result);
        $stmt->fetch();
        $stmt->close();

        $connection->close();

        return $result;

    }

    function getCategories(){
        include "settings.php";

        $query = "SELECT * FROM categories";
        $result = mysqli_query($connection,$query);

        mysqli_close($connection);

        return $result;
    }

    function getCategoriesByCourseId(int $courseId){
        include "settings.php";

        $query = "SELECT * FROM course_category cc 
        INNER JOIN categories ct on cc.categoryId = ct.id where cc.courseId = $courseId";

        $result = mysqli_query($connection,$query);

        mysqli_close($connection);

        return $result;

    }

    function filterCourses(string $keyword){
        include "settings.php";

        $query = "SELECT * FROM courses where title like %'$keyword'% or subtitle like %'$keyword'%";
        $result = mysqli_query($connection,$query);

        mysqli_close($connection);

        return $result;
    }

    function getUserInfo(int $id){
        include "settings.php";

        $query = "SELECT username,userPass,email,imageUrl FROM users Where id=$id";
        $result = mysqli_query($connection,$query);

        mysqli_close($connection);

        return $result;
    }

    function updateUserInfo(int $id, string $username, string $password, string $email, string $imageUrl) {
        include "settings.php"; 
        
        $password = password_hash($password,PASSWORD_DEFAULT);
        $query = "UPDATE users SET username = ?, userPass = ?, email = ?, imageUrl = ? WHERE id = ?";
        $stmt = $connection->prepare($query);
    
        
        if ($stmt === false) {
            mysqli_close($connection);
            return false;
        }
    
        
        $stmt->bind_param('ssssi', $username, $password, $email, $imageUrl, $id);
        $result = $stmt->execute();
    
       
        if ($result === false) {
            $stmt->close();
            mysqli_close($connection);
            return false;
        }
    
        $stmt->close();
    
        
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        $_SESSION['imageUrl'] = $imageUrl; 
    
        mysqli_close($connection);
        return true;
    }

    function getCourses(){
        include "settings.php";

        $query = "SELECT * FROM courses where verified=1";
        $result = mysqli_query($connection,$query);

        mysqli_close($connection);

        return $result;
    }

    function getCoursesToHomepage(){
        include "settings.php";

        $query = "SELECT * FROM courses where homepage=1 and verified = 1";
        $result = mysqli_query($connection,$query);

        mysqli_close($connection);

        return $result;
    }

    function getCoursesAdmin(){
        include "settings.php";

        $query = "SELECT * FROM courses";
        $result = mysqli_query($connection,$query);

        mysqli_close($connection);

        return $result;
    }

    function getCoursesByCategoryId(int $id){
        include "settings.php";

        $query = "SELECT * FROM course_category cc 
        INNER JOIN courses c on cc.courseId=c.id where cc.categoryId=$id and verified=1";
        $result = mysqli_query($connection,$query);

        mysqli_close($connection);

        return $result;
    }

    function getUserCourses(int $id){
        include "settings.php";
        
        $query = "SELECT * FROM user_course uc 
        INNER JOIN courses c on uc.courseId = c.id where uc.userId = $id";
        $result = mysqli_query($connection,$query);

        mysqli_close($connection);

        return $result;
    }

    function getCoursesByKeyword(string $keyword) {
        include "settings.php";

        $query = "SELECT * FROM courses where (title like '%$keyword%' 
        or  subtitle like '%$keyword%') and verified = 1";
        $result = mysqli_query($connection,$query);

        mysqli_close($connection);

        return $result;
    }

    function getCoursesByFilters(string $categoryId, string $keyword, int $page) {
        include "settings.php";
    
        $pageCount = 2;
        $offset = ($page - 1) * $pageCount;
        $params = [];
        $types = '';
    
        $query = "";
        if (!empty($categoryId)) {
            $query = " FROM course_category cc 
            INNER JOIN courses c ON cc.courseId=c.id WHERE cc.categoryId=? AND verified=1";
            $types .= 's';
            $params[] = $categoryId;
        } else {
            $query = " FROM courses WHERE verified=1";
        }
    
        if (!empty($keyword)) {
            $query .= " AND (title LIKE ? OR subtitle LIKE ?)";
            $types .= 'ss';
            $params[] = '%' . $keyword . '%';
            $params[] = '%' . $keyword . '%';
        }
    
        // Total count query
        $total_sql = "SELECT COUNT(*)" . $query;
        $stmt = $connection->prepare($total_sql);
        if (!empty($types)) {
            $stmt->bind_param($types, ...$params);
        }
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
    
        $total_pages = ceil($count / $pageCount);
    
        // Main data query
        $main_sql = "SELECT *" . $query . " LIMIT ?, ?";
        $stmt = $connection->prepare($main_sql);
        $types .= 'ii';
        $params[] = $offset;
        $params[] = $pageCount;
        $stmt->bind_param($types, ...$params);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
    
        $connection->close();
    
        return array(
            "total_pages" => $total_pages,
            "data" => $result
        );
    }
    

    function createCategory(string $category){
        include "settings.php";

        $query = "INSERT INTO categories(categoryName) VALUES(?)";

        $stmt = mysqli_prepare($connection,$query);

        mysqli_stmt_bind_param($stmt,'s',$category);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        return $stmt;


    }

    function createCourse(string $title,string $subtitle, string $descr,string $imageUrl ,int $comments=0,int $likes=0,$verified=0){
        include "settings.php";

        $query = "INSERT INTO courses(title, subtitle, cDescription, imageUrl, comments, likes,verified) VALUES(?,?,?,?,?,?,?)";

        $stmt = mysqli_prepare($connection,$query);

        mysqli_stmt_bind_param($stmt,'ssssiii',$title, $subtitle, $descr, $imageUrl, $comments, $likes,$verified);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        return $stmt;


    }

    function updateCategory(string $category, int $id){
        include "settings.php";
        
        $query = "UPDATE categories SET categoryName = ? WHERE id = ?";
        
        $stmt = mysqli_prepare($connection, $query);
        
        if ($stmt === false) {
            
            mysqli_close($connection);
            return false;
        }
    
        mysqli_stmt_bind_param($stmt, 'si', $category, $id);
        $result = mysqli_stmt_execute($stmt);
        
        mysqli_stmt_close($stmt);
        mysqli_close($connection);
        
        return $result;
    }

    function updateCourse(int $id,string $title,string $subtitle, string $desc, string $imageUrl,int $verified,int $homepage){
        include "settings.php";
        
        $query = "UPDATE courses SET title = ?,subtitle=?,cDescription=?, imageUrl=?,verified=?,homepage=? WHERE id = ?";
        
        $stmt = mysqli_prepare($connection, $query);
        
        if ($stmt === false) {
            
            mysqli_close($connection);
            return false;
        }
    
        mysqli_stmt_bind_param($stmt, 'ssssiii', $title, $subtitle, $desc, $imageUrl,$verified, $homepage,$id);
        $result = mysqli_stmt_execute($stmt);
        
        mysqli_stmt_close($stmt);
        mysqli_close($connection);
        
        return $result;
    }
    
    function deleteCategory(int $id) {
        include "settings.php";
        
        $query = "DELETE FROM categories where id = ?";

        $stmt = mysqli_prepare($connection,$query);

        mysqli_stmt_bind_param($stmt,'i',$id);

        $result = mysqli_stmt_execute($stmt);
        
        mysqli_stmt_close($stmt);
        mysqli_close($connection);
        
        return $result;
    }

    function deleteCourse(int $id){
        include "settings.php";
        
        $query = "DELETE FROM courses where id = ?";

        $stmt = mysqli_prepare($connection,$query);

        mysqli_stmt_bind_param($stmt,'i',$id);

        $result = mysqli_stmt_execute($stmt);
        
        mysqli_stmt_close($stmt);
        mysqli_close($connection);
        
        return $result;
    }

    function clearCourseCategories(int $id){
        include "settings.php";
        
        $query = "DELETE FROM course_category where courseId = ?";

        $stmt = mysqli_prepare($connection,$query);

        mysqli_stmt_bind_param($stmt,'i',$id);

        $result = mysqli_stmt_execute($stmt);
        
        mysqli_stmt_close($stmt);
        mysqli_close($connection);
        
        return $result;
    }

    function addCourseCategories(int $id, array $categories) {
        include "settings.php";
    
        $query = "INSERT INTO course_category(courseId, categoryId) VALUES (?, ?)";
        $stmt = mysqli_prepare($connection, $query);
    
        if ($stmt === false) {
            mysqli_close($connection);
            return false;
        }
    
        mysqli_stmt_bind_param($stmt, 'ii', $id, $categoryId);
    
        foreach($categories as $cat) {
            $categoryId = $cat;
            $result = mysqli_stmt_execute($stmt);
    
            if ($result === false) {
                mysqli_stmt_close($stmt);
                mysqli_close($connection);
                return false;
            }
        }
    
        mysqli_stmt_close($stmt);
        mysqli_close($connection);
    
        return true;
    }
    

    function getCategoryById(int $id){
        include "settings.php";
        
        $query = "SELECT * FROM categories WHERE id='$id' ";
        $result = mysqli_query($connection,$query);

        mysqli_close($connection);
        return $result;
    }

    function getCourseById(int $id){
        include "settings.php";
        
        $query = "SELECT * FROM courses WHERE id='$id' ";
        $result = mysqli_query($connection,$query);

        mysqli_close($connection);
        return $result;
    }

    function getDb($file)
    {
        $my_file = fopen($file, "r");
        $size = filesize($file);

        $jsonData = fread($my_file, $size);
        $categories = json_decode($jsonData, true);

        fclose($my_file);


        return $categories;
    }



    function addCourse(string $title, string $subtitle, string $image, string $dateAdded, int $comments = 0, int $likes = 0, bool $verified = true)
    {

        $db = getDb("db.json");

        array_push($db["courses"], array(

            "title" => $title,
            "subtitle" => $subtitle,
            "image" => $image,
            "publishDate" => $dateAdded,
            "comments" => $comments,
            "likes" => $likes,
            "verified" => $verified
        ));
        $myFile = fopen("db.json", "w");
        fwrite($myFile, json_encode($db, JSON_PRETTY_PRINT));
        fclose($myFile);
    }

    function countVerified($courseList)
    {
        $i = 0;
        foreach ($courseList as $course) {
            if ($course['verified']) {
                $i += 1;
            }
        }
        return $i;
    }

    function createURL($title)
    {
        return strtolower(str_replace([".", " "], ["-", "-"], $title));
    }

    function shortDesc($subtitle)
    {
        if (strlen($subtitle) > 30) {
            return substr($subtitle, 0, 30) . "...";
        } else {
            return $subtitle;
        }
    }


    function safe_html($data)
    {

        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);

        return $data;
    }

    function checkExtension(string $fileName){
        $file_extensions = ["jpg", "jpeg", "png"];
        $fileInfo = explode(".", $fileName);
        $fileExtension = $fileInfo[1];

        if (!in_array($fileExtension, $file_extensions)) {

            echo "File format is not supported." . "<br>" . "Supported formats  " . implode(",", $file_extensions) . "<br>";
            return false;
            
        }

        return true;
    }

    function uploadImage(array $file){
        $file_extensions = ["jpg", "jpeg", "png"];
        $fileSize = $file["size"];
        if ($fileSize > 500000) {

            echo '<div class="text-danger">File size can\'t be greater than 500KB' . "<br>";
            return false;
        }


        if(isset($file)){
            
            $destPath = "./img/";
            $fileName = $file["name"];
            $fileInfo = explode(".", $fileName);
            $fileNameRaw = $fileInfo[0];
            $fileExtension = $fileInfo[1];
           

            if (!in_array($fileExtension, $file_extensions)) {

                echo "File format is not supported." . "<br>" . "Supported formats  " . implode(",", $file_extensions) . "<br>";
                return false;
                
            }

            $newFileName = $fileNameRaw ."-".rand(0,999999). ".$fileExtension";      
            $fileSourcePath = $file["tmp_name"];
            $fileDestPath = $destPath . $newFileName;

            if(move_uploaded_file($fileSourcePath, $fileDestPath)){
                return $newFileName; // Return the new file name on success
            } else {
                echo "Failed to move the uploaded file.<br>";
                return false;
            }
        }
    }

    function uploadUserImage(array $file){
        $file_extensions = ["jpg", "jpeg", "png"];
        $fileSize = $file["size"];
        if ($fileSize > 500000) {

            echo '<div class="text-danger">File size can\'t be greater than 500KB' . "<br>";
            return false;
        }


        if(isset($file)){
            
            $destPath = "./img/user/";
            $fileName = $file["name"];
            $fileInfo = explode(".", $fileName);
            $fileNameRaw = $fileInfo[0];
            $fileExtension = $fileInfo[1];
           

            if (!in_array($fileExtension, $file_extensions)) {

                echo "File format is not supported." . "<br>" . "Supported formats  " . implode(",", $file_extensions) . "<br>";
                return false;
                
            }

            $newFileName = $fileNameRaw ."-".rand(0,999999). ".$fileExtension";      
            $fileSourcePath = $file["tmp_name"];
            $fileDestPath = $destPath . $newFileName;

            if(move_uploaded_file($fileSourcePath, $fileDestPath)){
                return $newFileName; // Return the new file name on success
            } else {
                echo "Failed to move the uploaded file.<br>";
                return false;
            }
        }
    }