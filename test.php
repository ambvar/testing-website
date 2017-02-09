<?php

session_start();
require_once "connect.php";

//Checking to see if student is logged in, if not, takes us back to login page.
//if(!isset($_SESSION["username"])) {
  //header("Location: index.php");
  //exit;
//}

$userID = $_SESSION["username"];
$name = $_SESSION["name"];

//Getting logged in student's information, saved into current
//$sql = "SELECT * FROM student WHERE id = $userID";
//$result = mysql_query($sql);
//$current = mysql_fetch_array($result)

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
      <li><a href="logout.php">Logout</a></li>
      <li>Welcome, <?php echo $_SESSION["name"]; ?></li>
    </ul>
  </nav>

  <h3>Here are your current exams/quizzes/tests. Select one and then hit submit to begin.</h3>
  <h4>You cannot come back once you hit submit.</h4>

  <table>
    <tr>
      <th>Name</th>
      <th>Points</th>
    </tr>
    <form method="post" action="take.php">
      <?php

      //Getting all active exams/quizzes/test for student and printing it out into a pretty-ish HTML table
      $testSQL = "SELECT * FROM exam";
      $result = mysql_query($testSQL);

      //Checking to make sure there is at least 1 exam
      if (mysql_num_rows($result) > 0) {

        //Loop through query result
        while ($row = mysql_fetch_array($result)) {

          //Prints out a neat table with exams/quizzes with the total points
          ?>
          <tr>
            <td><input type="radio" value="<?php echo $row["exam_name"]; ?>" name="exam"><?php echo $row["exam_name"]; ?></td>
            <td><?php echo $row["total_points"]; ?></td>
          </tr>
          <?php
        }
      }
       ?>
       <input type="submit" name="Submit" />
  </form>
  </table>

</body>
</html>
