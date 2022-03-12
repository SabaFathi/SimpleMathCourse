# SimpleMathCourse
A simple math course about counting and basic operators

There is a single teacher who can manage students' account.
Teacher(admin): username = "teacher1" , password = "qwerty1234"  (Hardcoded in the file: initialDB.php)
To add any new student, the teacher should login and create an account for the student.

The **Teacher** can manage students and see how is doing any student.

Each **Student** can access her/his course. The course has 4 levels of training. At the first level, the student will learn about counting (0-9). At the second level, the student will learn about counting (10-99). At the third level, the student will learn about the addition and subtracion of one-digit numbers. At the Last (4th) level, the student will learn about the multiplication of one-digit numbers.
The student should answer at least 10 questions with an average of 90% correct answers to finish each level. (Questions are generated dynamically by the program)

**To run the program, you can put "SimpleMathCourse" directory to "htdocs" directory of XAMPP.**
To initialize the database, please run /SimpleMathCourse/initialDB.php  once for the first time.
Then start with this url: "/SimpleMathCourse/index.php" and then follow the buttons and instructions.

**Captures of the program will be shown bellow:**

Login page:

![login](https://github.com/SabaFathi/SimpleMathCourse/blob/main/Captures/login.JPG?raw=true)

Teacher View:

![teacher](https://github.com/SabaFathi/SimpleMathCourse/blob/main/Captures/TeacherView.JPG?raw=true)

Student1's results (is shown to the teacher):

![student's result](https://github.com/SabaFathi/SimpleMathCourse/blob/main/Captures/Student1Results.JPG?raw=true)

Studnet View:

![student](https://github.com/SabaFathi/SimpleMathCourse/blob/main/Captures/StudentView_Courses.JPG?raw=true)

Level 1 - sample question

![level1](https://github.com/SabaFathi/SimpleMathCourse/blob/main/Captures/StudentView_Level1.JPG?raw=true)

Level 2 - sample question

![level2](https://github.com/SabaFathi/SimpleMathCourse/blob/main/Captures/StudentView_Level2.JPG?raw=true)

Level 3 - sample question

![level3](https://github.com/SabaFathi/SimpleMathCourse/blob/main/Captures/StudentView_Level3.JPG?raw=true)

Level 4 - sample question

![level4](https://github.com/SabaFathi/SimpleMathCourse/blob/main/Captures/StudentView_Level4.JPG?raw=true)
