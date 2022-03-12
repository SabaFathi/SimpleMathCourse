<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hello Teacher</title>
    <style>
        body{direction: ltr; padding: 20px; display: flex; align-items: center; justify-content: center; flex-direction: column; position: relative;}
        h3{color: #ff8040}

        /*colors from this resource: https://www.w3schools.com/css/css3_buttons.asp*/
        .green_btn{background-color: #e7e7e7; color: black; border: 2px solid #4CAF50;}
        .blue_btn{background-color: #e7e7e7; color: black; border: 2px solid #008CBA;}
        .red_btn{background-color: #e7e7e7; color: black; border: 2px solid #f44336;}
    </style>
</head>
<body>
    <script type="text/javascript">
        const root = "http://localhost/SimpleMathCourse";
        function create_student(){
            window.location.href = root + "/users_crud_helper/createStudent.php";
        }
        function read_student(username){
            window.location.href = root + "/users_crud_helper/readStudent.php?username=" + username;
        }
        function update_student(){
            window.location.href = root + "/users_crud_helper/updateStudent.php";
        }
        function delete_student(){
            window.location.href = root + "/users_crud_helper/deleteStudent.php";
        }

        function logout(){
            window.location.href = root + "/logout.php";
        }
    </script>
    <div>
        <button onclick="create_student()" class="green_btn">Add New Studend</button>
        <button onclick="update_student()" class="blue_btn">Edit Existing Studend</button>
        <button onclick="delete_student()" class="red_btn">Delete Existing Studend</button>
    </div>

    <?php
        $db = "hw_simple_math_course";

        $connection = mysqli_connect("localhost", "root", "");
        if(! $connection){
            echo "<script type=\"text/javascript\">" . "console.log(" . mysqli_connect_error() . ")" . "</script>";
            die("Could not connect to database!");
        }
        mysqli_select_db($connection, $db);

        $query = "SELECT firstname,lastname,username,level FROM students";
        $students = mysqli_query($connection, $query);
        echo "<ul>";
        if(!$students || mysqli_num_rows($students) == 0){
            echo "no student is found.";
        }else{
            echo "<h3>click on each row to see logs</h3><br/>";
            while($student = mysqli_fetch_array($students)){
                $firstname = $student["firstname"];
                $lastname = $student["lastname"];
                $username = $student["username"];
                $student_info = $firstname . " " . $lastname . " (username: " . $username . ")";
                echo "<li onclick=\"read_student('$username')\">" . $student_info . "</li>";
            }
        }
        echo "</ul>";

        mysqli_close($connection);
    ?>

    <button onclick="logout()">logout</button>
</body>
</html>
