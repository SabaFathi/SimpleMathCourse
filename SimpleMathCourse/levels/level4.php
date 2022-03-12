<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Level 4</title>
    <style>
        body{direction: ltr; padding: 20px; display: flex; align-items: center; justify-content: center; flex-direction: column; position: relative;}
        form{display: flex; align-items: center; justify-content: center; flex-direction: column; position: relative;}
        .line{display: flex; align-items: center; justify-content: center; flex-direction: row; position: relative;}
        .vertical{display: flex; align-items: center; justify-content: center; flex-direction: column; position: relative;}
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
        $level = 4;
        $first_num = rand(1, 9);
        $operator = "*";
        $second_num = rand(1, 9);
        $question_parameter = $first_num . $operator . $second_num;
        $correct_answer = $first_num * $second_num;
        $db = "hw_simple_math_course";
        $apple_img_src = "http://localhost/SimpleMathCourse/resources/apple.jpg";
        $mul_img_src = "http://localhost/SimpleMathCourse/resources/multiply.jpg";

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

            echo "<div class=\"line\">";
            for($i=0; $i<$first_num; $i++){
                echo "<img src=\"$apple_img_src\" width=\"50\" height=\"50\">";
            }
            echo "</div>";

            echo "<img src=\"$mul_img_src\" width=\"50\" height=\"50\">";

            echo "<div class=\"vertical\">";
            for($i=0; $i<$second_num; $i++){
                echo "<img src=\"$apple_img_src\" width=\"50\" height=\"50\">";
            }
            echo "</div>";

            echo "</div>";

            $choices[0] = $correct_answer;
            $choices[1] = rand(1, 81);//min value =1*1=1 //max value=9*9=81
            $choices[2] = rand(1, 81);
            $choices[3] = rand(1, 81);
            shuffle($choices);
            echo "<form action=\"submitAnswer.php\" method=\"POST\">";
            echo "<div class=\"line\">";
            for($i=0; $i<4; $i++){
                echo "<input type=\"radio\" name=\"user_choice\" value=" . $choices[$i] . ">" . $choices[$i];
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
