<?php
    $connection = mysqli_connect("localhost", "root", "");
    
    if (! $connection){
        die("Could not connect: Error no: " . mysqli_connect_errno() . " Error: " . mysqli_connect_error());
    }

    //Create database
    if (mysqli_query($connection,"CREATE DATABASE hw_simple_math_course")) {
        echo "Database created";
    }else {
        die("Error creating database: " . mysqli_error($connection));
    }

    // Create tables
    $query_teachers = "CREATE TABLE hw_simple_math_course.teachers (id int NOT NULL AUTO_INCREMENT PRIMARY KEY, firstname varchar(20), lastname varchar(20), username varchar(20) NOT NULL, password varchar(32) NOT NULL, CONSTRAINT uniqe_username UNIQUE (username));";
    if(mysqli_query($connection, $query_teachers)){
        echo "Table teachers created.";
    }else{
        echo "can not create teachers table. error: " . mysqli_error($connection);
    }
    echo "<br/>";

    $query_students = "CREATE TABLE hw_simple_math_course.students (id int NOT NULL AUTO_INCREMENT PRIMARY KEY, firstname varchar(20), lastname varchar(20), username varchar(20) NOT NULL, password varchar(32) NOT NULL, level int unsigned, CONSTRAINT uniqe_username UNIQUE (username));";
    if(mysqli_query($connection, $query_students)){
        echo "Table students created.";
    }else{
        echo "can not create students table. error: " . mysqli_error($connection);
    }
    echo "<br/>";

    //define teacher(s)
    $query_teach1 = "INSERT INTO hw_simple_math_course.teachers(firstname, lastname, username, password) values(\"t1name\", \"t1family\", \"teacher1\", \"qwerty1234\")";
    if(mysqli_query($connection, $query_teach1)){
        echo "The theacher added.";
    }else{
        echo "can not insert the teacher. error: " . mysqli_error($connection);
    }
    echo "<br/>";

    mysqli_close($connection);
?>
