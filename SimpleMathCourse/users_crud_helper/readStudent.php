<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Info</title>
    <style>
        body{direction: ltr; padding: 20px; display: flex; align-items: center; justify-content: center; flex-direction: column; position: relative;}

        /*table styles from this resource: https://www.w3schools.com/css/css_table_style.asp*/
        table {border-collapse: collapse; width: 100%;}
        th, td {padding: 8px; text-align: left; border-bottom: 1px solid #ddd;}
    </style>
</head>
<body>
    <?php
        $username = $_GET["username"];
        $db = "hw_simple_math_course";

        $connection = mysqli_connect("localhost", "root", "");
        if(! $connection){
            echo "<script type=\"text/javascript\">" . "console.log(" . mysqli_connect_error() . ")" . "</script>";
            die("Could not connect to database!");
        }
        mysqli_select_db($connection, $db);

        $student_log = mysqli_query($connection, "SELECT level,questionParameters,expectedAnswer,studentAnswer FROM student" . $username);
        if(!$student_log || mysqli_num_rows($student_log) == 0){
            echo "no record is found.<br/><br/>";
        }else{
            echo "<table>";
            echo "<th>Level</th>";
            echo "<th>Question Parameters</th>";
            echo "<th>Expected Answer</th>";
            echo "<th>Student Answer</th>";
            while($log = mysqli_fetch_array($student_log)){
                echo "<tr>";
                echo "<td>" . $log["level"] . "</td>";
                echo "<td>" . $log["questionParameters"] . "</td>";
                echo "<td>" . $log["expectedAnswer"] . "</td>";
                echo "<td>" . $log["studentAnswer"] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        }

        mysqli_close($connection);
    ?>
    
    <script type="text/javascript">
        const root = "http://localhost/SimpleMathCourse";
        function teacher_page(){
            window.location.href = root + "/manageStudents.php";
        }
    </script>
    <button onclick="teacher_page()">Back To Student List</button>
</body>
</html>
