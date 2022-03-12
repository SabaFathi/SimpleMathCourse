<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hello Student</title>
    <style>
        body{direction: ltr; padding: 20px; display: flex; align-items: center; justify-content: center; flex-direction: column; position: relative;}
        h3{color: #ff8040}
        .green{color: #4CAF50;}
        .blue{color: #008CBA;}
        .red{color: #f44336;}
    </style>
</head>
<body>
    <script type="text/javascript">
        const root = "http://localhost/SimpleMathCourse";
        function redirect_to_level(level){
            window.location.href = root + "/levels/level" + level + ".php";
        }

        function logout(){
            window.location.href = root + "/logout.php";
        }
    </script>
    <?php
        $db = "hw_simple_math_course";
        $username = $_SESSION["username"];

        $connection = mysqli_connect("localhost", "root", "");
        if(! $connection){
            echo "<script type=\"text/javascript\">" . "console.log(" . mysqli_connect_error() . ")" . "</script>";
            die("Could not connect to database!");
        }
        mysqli_select_db($connection, $db);

        $query = "SELECT level FROM students WHERE username='$username'";
        $result = mysqli_query($connection, $query);
        $level = mysqli_fetch_array($result);
        $level = intval($level[0]);//convert string to integer

        echo "<h3>click on each row to continue</h3>";
        echo "<ul>";
        for($i=1; $i<6; $i++){
            $state = "";
            $color = "";
            if($i < $level){
                $state = "complete";
                $color = "green";
            }else if($i == $level){
                $state = "in progress";
                $color = "blue";
            }else{
                $state = "comming soon";
                $color = "red";
            }
            echo "<li onclick=redirect_to_level('$i') class='$color'> level " . $i . " (" . $state . ")</li>";
        }
        echo "</ul>";

        mysqli_close($connection);
    ?>

    <button onclick="logout()">logout</button>
</body>
</html>
