<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Student</title>
    <style>
        body{direction: ltr; padding: 20px;}
    </style>
</head>
<body>
    <?php
        $username = $_POST["username"];
        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $password = $_POST["password"];
        $db = "hw_simple_math_course";

        $connection = mysqli_connect("localhost", "root", "");
        if(! $connection){
            echo "<script type=\"text/javascript\">" . "console.log(" . mysqli_connect_error() . ")" . "</script>";
            die("Could not connect to database!");
        }
        mysqli_select_db($connection, $db);

        $query_update_user = "UPDATE students SET firstname='$firstname', lastname='$lastname', password='$password' WHERE username='$username'";
        if(! mysqli_query($connection, $query_update_user)){
            die("can not update student. error: " . mysqli_error($connection));
        }
        echo "student successfuly updated.";

        mysqli_close($connection);

        header('Location: http://localhost/SimpleMathCourse/manageStudents.php');
    ?>
</body>
</html>
