<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Student</title>
    <style>
        body{direction: ltr; padding: 20px; display: flex; align-items: center; justify-content: center; flex-direction: column; position: relative;}
        form{display: grid; grid-template-columns: 1fr 2fr; grid-template-rows: 1fr; width: 50%;}
        #submit{grid-column-start: 1; grid-column-end: 3;}
        label{margin: 10px;}
        input{margin: 10px;}
    </style>
</head>
<body>
    <form action="createStudentDB.php" method="POST">
        <label for="firstname">First Name</label>
        <input type="text" name="firstname">

        <label for="lastname">Last Name</label>
        <input type="text" name="lastname">

        <label for="username">User Name</label>
        <input type="text" name="username">

        <label for="password">Password</label>
        <input type="text" name="password">

        <input type="submit" value="submit" id="submit">
    </form>
</body>
</html>
