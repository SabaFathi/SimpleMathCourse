<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Level 1</title>
    <style>
        body{direction: ltr; padding: 20px; display: flex; align-items: center; justify-content: center; flex-direction: column; position: relative;}
        form{display: flex; align-items: center; justify-content: center; flex-direction: column; position: relative;}
        .line{display: flex; align-items: center; justify-content: center; flex-direction: row; position: relative;}
        label{margin: 5px;}
        input{margin: 5px;}
    </style>
</head>
<body>
    <script type="text/javascript">
        const root = "http://localhost/SimpleMathCourse";
        function go_to_lessons(){
            window.location.href = root + "/manageLessons.php";
        }
    </script>
    
    <?php
        $username = $_SESSION["username"];
        $level = 1;
        $question_parameter = rand(1, 9);
        $correct_answer = $question_parameter;
        $db = "hw_simple_math_course";
        $img_src = "http://localhost/SimpleMathCourse/resources/apple.jpg";

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
            echo "<button onclick=\"go_to_lessons()\">Lessons List</button>";
        }else if($user_level > $level){
            //compeleted
            echo "<h3>This level was completed.</h3>";
            echo "<button onclick=\"go_to_lessons()\">Lessons List</button>";
        }else{
            $query_insert_question = "INSERT INTO student" . $username . "(level, questionParameters, expectedAnswer, studentAnswer) VALUES ($level , '$question_parameter' , '$correct_answer', \"unsolved\")";
            if(! mysqli_query($connection, $query_insert_question)){
                die("can not insert question. error: " . mysqli_error($connection));
            }

            echo "<div class=\"line\">";
            for($i=0; $i<$question_parameter; $i++){
                echo "<img src=\"$img_src\" width=\"50\" height=\"50\">";
            }
            echo "</div>";

            echo "<form action=\"submitAnswer.php\" method=\"POST\">";
            echo "<div class=\"line\">";
            for($i=1; $i<10; $i++){
                echo "<input type=\"radio\" name=\"user_choice\" value='$i'>" . $i;
            }
            echo "</div>";

            echo "<input type=\"hidden\" name=\"qparam\" value='$question_parameter'>";
            echo "<input type=\"hidden\" name=\"answer\" value='$correct_answer'>";

            echo "<input type=\"submit\" value=\"submit\" id=\"submit\">";
            echo "</form>";
        }

        mysqli_close($connection);
    ?>
</body>
</html>
