<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Student</title>
    <style>
        body{direction: ltr; padding: 20px; display: flex; align-items: center; justify-content: center; flex-direction: column; position: relative;}
        form{display: grid; grid-template-columns: 1fr 2fr; grid-template-rows: 1fr; width: 50%;}
        .span_line{grid-column-start: 1; grid-column-end: 3;}
        label{margin: 10px;}
        input{margin: 10px;}
    </style>
</head>
<body>
    <form action="updateStudentDB.php" method="POST">
        <label for="username">Username of the student which you want to update</label>
        <input type="text" name="username">

        <h4 class="span_line">now update fields(fill all):</h4>

        <label for="firstname">First Name</label>
        <input type="text" name="firstname">

        <label for="lastname">Last Name</label>
        <input type="text" name="lastname">

        <label for="password">Password</label>
        <input type="text" name="password">

        <input type="submit" value="submit" class="span_line">
    </form>
</body>
</html>
