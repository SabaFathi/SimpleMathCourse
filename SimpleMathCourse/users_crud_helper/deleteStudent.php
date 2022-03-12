<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Student</title>
    <style>
        body{direction: ltr; padding: 20px; display: flex; align-items: center; justify-content: center; flex-direction: column; position: relative;}
        form{display: grid; grid-template-columns: 1fr 2fr; grid-template-rows: 1fr; width: 50%;}
        #submit{grid-column-start: 1; grid-column-end: 3; background-color: red;}
        label{margin: 10px;}
        input{margin: 10px;}
    </style>
</head>
<body>
    <form action="deleteStudentDB.php" method="POST">
        <label for="username">Username of the student which need to delete</label>
        <input type="text" name="username">

        <input type="submit" value="DELETE this student" id="submit">
    </form>
</body>
</html>
