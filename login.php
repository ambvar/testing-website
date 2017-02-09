<?php

session_start();
require_once "connect.php";

//Checking to see if student is logged in, takes us to test.
if(isset($_SESSION["username"])) {
  header("Location: test.php");
  exit;
}

//Check for login form submit
if (isset($_POST["username"]) && isset($_POST["password"])) {
  $username = $_POST["username"];
  $password = $_POST["password"];

  //Make sure that both username and password fields are filled out.
  if (!empty($_POST["username"]) && !empty($_POST["password"])) {

    //Cutting away unnecessary whitespace, tags and special characters to avoid SQL injection.
    $username = trim($username);
    $username = strip_tags($username);
    $username = htmlspecialchars($username);

    $password = trim($password);
    $password = strip_tags($password);
    $password = htmlspecialchars($password);

    //Grabbing from database and checking for the username first.
    //Saving the information into result then getting the array.
    $sql = "SELECT name FROM student WHERE id = '$username' AND password = '$password'";
    $result = mysql_query($sql);
    $rows = mysql_fetch_array($result);
    $count = mysql_num_rows($result);


    //result will return 1 and only 1 if the password matches the username
    if ($count == 1) {
      
      //Starting session with the student with the ID, then takes us to the test page (where tests/quizzes will be).
      $_SESSION["username"] = $rows["id"];
      $_SESSION["name"] = $rows["name"];
      header("location: test.php");
    } else {
      header("location: index.php");
    }

  } else {
    header("location: index.php");
  }
}


?>
