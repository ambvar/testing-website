<?php

session_start();
require_once "connect.php";

//Checking to see if student is logged in, if yes then goes straight to test page. If not, stays.
//if (isset($_SESSION["username"] != "")) {
  //header("Location: test.php");
  //exit;
//}

?>
<!DOCTYPE>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Le Testing Center</title>
  <meta name="description" content="Front page of Superior Filament">
  <link rel="stylesheet" href="index.css">
  <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
</head>
<body>
  <!-- Not much needed for navigation. Just a tutorial link for navigation. -->
  <nav>
    <ul>
      <li><a href="tutorial.html">How To</a></li>
    </ul>
  </nav>

<!-- Login form for student to get to testing. -->
  <div class="container login-form">
    <h3>Please login to see your exams/quizzes/tests.</h3>
    <form method="post" action="login.php">
      Student ID: <input type="text" name="username" id="username" placeholder="ID" />
      Password: <input type="password" name="password" id="password" placeholder="Password" />
      Submit <input type="submit" name="submit" />
    </form>
  </div>

</body>

</html>
