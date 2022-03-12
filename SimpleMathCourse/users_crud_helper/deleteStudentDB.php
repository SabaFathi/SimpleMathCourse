<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Student</title>
    <style>
        body{direction: ltr; padding: 20px;}
    </style>
</head>
<body>
    <?php
        $username = $_POST["username"];
        $db = "hw_simple_math_course";
        $table_name = "student" . $username;

        $connection = mysqli_connect("localhost", "root", "");
        if(! $connection){
            echo "<script type=\"text/javascript\">" . "console.log(" . mysqli_connect_error() . ")" . "</script>";
            die("Could not connect to database!");
        }
        mysqli_select_db($connection, $db);

        $query_delete_user = "DELETE FROM students WHERE username='$username'";
        if(! mysqli_query($connection, $query_delete_user)){
            die("can not delete student. error: " . mysqli_error($connection));
        }

        $query_delete_user_table = "DROP TABLE $table_name";
        if(! mysqli_query($connection, $query_delete_user_table)){
            die("can not delete student. error: " . mysqli_error($connection));
        }
        echo "student successfuly deleted.";

        mysqli_close($connection);

        header('Location: http://localhost/SimpleMathCourse/manageStudents.php');
    ?>
</body>
</html>
