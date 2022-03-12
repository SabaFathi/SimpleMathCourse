<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Student</title>
    <style>
        body{direction: ltr; padding: 20px;}
    </style>
</head>
<body>
    <?php
        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        $level = 1;
        $db = "hw_simple_math_course";

        $connection = mysqli_connect("localhost", "root", "");
        if(! $connection){
            echo "<script type=\"text/javascript\">" . "console.log(" . mysqli_connect_error() . ")" . "</script>";
            die("Could not connect to database!");
        }
        mysqli_select_db($connection, $db);

        $query_insert_user = "INSERT INTO students (firstname, lastname, username, password, level) VALUES ('$firstname', '$lastname', '$username', '$password', $level);";
        if(! mysqli_query($connection, $query_insert_user)){
            die("can not insert student. error: " . mysqli_error($connection));
        }

        $query_create = "CREATE TABLE student" . $username . "(id int NOT NULL AUTO_INCREMENT PRIMARY KEY, level int unsigned, questionParameters varchar(10), expectedAnswer varchar(10), studentAnswer varchar(10));";
        if(! mysqli_query($connection, $query_create)){
            die("can not create student table. error: " . mysqli_error($connection));
        }

        echo "student successfuly added.";

        mysqli_close($connection);

        header('Location: http://localhost/SimpleMathCourse/manageStudents.php');
    ?>
</body>
</html>
