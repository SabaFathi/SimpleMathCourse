<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome To Simple Math Course</title>
    <style>
        body{direction: ltr; padding: 20px; display: flex; align-items: center; justify-content: center; flex-direction: column; position: relative;}
    </style>
</head>
<body>
    <?php
        $role = $_POST["role"];
        $username = $_POST["username"];
        $password = $_POST["password"];

        $db = "hw_simple_math_course";
        $table = "";
        $next_page = "";
        switch($role){
            case "teacher":
                $table = "teachers";
                $next_page = "manageStudents.php";
                break;
            case "student":
                $table = "students";
                $next_page = "manageLessons.php";
                break;
        }

        $connection = mysqli_connect("localhost", "root", "");
        if(! $connection){
            echo "<script type=\"text/javascript\">" . "console.log(" . mysqli_connect_error() . ")" . "</script>";
            die("Could not connect to database!");
        }
        mysqli_select_db($connection, $db);

        $query = "SELECT * FROM $table WHERE username='$username' AND password='$password'";
        $result = mysqli_query($connection, $query);
        if(!$result || mysqli_num_rows($result) == 0){
            echo "Invalid username or password. Please return and try again";
            session_unset();
            session_destroy();
        }else{
            $_SESSION["username"] = $username;

            echo "<h3>Welcome " . $username . "</h3>";
            echo "<form action='$next_page' method=\"GET\"> <input type=\"submit\" value=\"continue as a $role...\"> </form>";
        }

        mysqli_close($connection);
    ?>
</body>
</html>
