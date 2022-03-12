<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Submit And Verify Answer</title>
    <style>
        body{direction: ltr; padding: 20px; display: flex; align-items: center; justify-content: center; flex-direction: column; position: relative;}
        h3{color: red;}
    </style>
</head>
<body>
    <?php
        $username = $_SESSION["username"];
        $student_answer = $_POST["user_choice"];
        $question_parameter = $_POST["qparam"];
        $correct_answer = $_POST["answer"];
        $db = "hw_simple_math_course";

        $connection = mysqli_connect("localhost", "root", "");
        if(! $connection){
            echo "<script type=\"text/javascript\">" . "console.log(" . mysqli_connect_error() . ")" . "</script>";
            die("Could not connect to database!");
        }
        mysqli_select_db($connection, $db);

        $query_update = "UPDATE student" . $username . " SET studentAnswer='$student_answer' WHERE studentAnswer=\"unsolved\" AND questionParameters='$question_parameter' AND expectedAnswer='$correct_answer'";
        if(! mysqli_query($connection, $query_update)){
            die("can not update record. error: " . mysqli_error($connection));
        }

        if($student_answer == $correct_answer){
            echo "correct :D <br/><br/>";
        }else{
            echo "wrong :( <br/><br/>";
        }

        ///check for level up
        $query_level = "SELECT level FROM students WHERE username=\"$username\"";
        $level = mysqli_query($connection, $query_level);
        $level = intval(mysqli_fetch_array($level)[0]);
        $query_this_level_records = "SELECT id,expectedAnswer,studentAnswer FROM student" . $username . " WHERE level=$level";
        $this_level_records = mysqli_query($connection, $query_this_level_records);

        $question_count = 0;
        $score = 0;
        if(!$this_level_records || mysqli_num_rows($this_level_records) == 0){
            echo "no record is found.";
        }else{
            $question_count = mysqli_num_rows($this_level_records);
            while($record = mysqli_fetch_array($this_level_records)){
                $correct_answer = $record["expectedAnswer"];
                $student_answer = $record["studentAnswer"];
                if($student_answer == $correct_answer){
                    $score ++;
                }
            }
        }
        $score_percent = ($score * 100) / $question_count;

        echo "you answer " . round($score_percent) . "% of questions correct.";

        if(($question_count > 10) && ($score_percent > 90)){
            //unlocked next level!
            $level ++;
            $query_update_user = "UPDATE students SET level='$level' WHERE username='$username'";
            if(! mysqli_query($connection, $query_update_user)){
                die("can not update student. error: " . mysqli_error($connection));
            }
            echo "<h3>Congratulations! You reached next level!</h3>";
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
