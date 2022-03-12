<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Course Finished!</title>
    <style>
        body{direction: ltr; padding: 20px; display: flex; align-items: center; justify-content: center; flex-direction: column; position: relative;}
        .line{display: flex; align-items: center; justify-content: center; flex-direction: row; position: relative;}
        h1{color: green;}
    </style>
</head>
<body>
    <?php
        $username = $_SESSION["username"];
        $level = 5;
        $db = "hw_simple_math_course";

        $connection = mysqli_connect("localhost", "root", "");
        if(! $connection){
            echo "<script type=\"text/javascript\">" . "console.log(" . mysqli_connect_error() . ")" . "</script>";
            die("Could not connect to database!");
        }
        mysqli_select_db($connection, $db);

        $query_user_level = "SELECT level FROM students WHERE username=\"$username\"";
        $user_level = mysqli_query($connection, $query_user_level);
        $user_level = intval(mysqli_fetch_array($user_level)[0]);
        if($user_level < $level){
            //locked
            echo "<h3>This level is locked now.</h3>";
        }else{
            echo "<h1>Congratulations! You Pass All Levels :)</h1>";
        }

        mysqli_close($connection);
    ?>
    
    <script type="text/javascript">
        const root = "http://localhost/SimpleMathCourse";
        function go_to_lessons(){
            window.location.href = root + "/manageLessons.php";
        }
    </script>
    <button onclick="go_to_lessons()">Lessons List</button>
</body>
</html>
