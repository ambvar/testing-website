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
      <li><a href="test.php">All Tests To Be Done</a></li>
    </ul>
  </nav>

  <h2>Here are your results.</h2>

  <ul>
    <?php
    //Creating some variables
    $exam = $_SESSION["exam"];
    $amount = $_SESSION["amount"];
    $qn = 1;
    $earned = 0;
    //Query for questions for the exam
    $quesSQL = "SELECT info FROM question WHERE exam_name = '$exam'";
    $resultQues = mysql_query($quesSQL);

    //Loop through query results
    while ($ques = mysql_fetch_array($resultQues)) {

      //This query will give us the identifier of the correct answer, instead of check the entire text.
      $correctSQL = "SELECT identifier FROM choice WHERE exam_name = '$exam' and correct_ans = 'y' and num = $qn";
      $resultCorrect = mysql_query($correctSQL);
      $correct = mysql_fetch_array($resultCorrect);

      //Recieves selected answer from the quiz per each question
      $ans = $_POST["question-$qn-answers"];

      //Setting whether the answer they selected or not as false (to start)
      $right = false;

      //Query recvies the amount of points the questions are worth
      $scoreSQL = "SELECT score FROM question WHERE num = $qn and exam_name = '$exam'";
      $resultScore = mysql_query($scoreSQL);
      $score = mysql_fetch_array($resultScore);

      //Check to see if the selected answer is the correct answer.
      //  If true, changes $right to true, else false.
      if ($ans == array_values($correct)[0]) {
        $right = true;
      } else {
        $right = false;
      }

      ?>

      <li>
        <h3><?php echo $ques["info"]; ?></h3>
        <p>
          <?php

          //This checks if they got it right.
          //  If yes, echos out correct and the amount of points earned and adds it to a total score.
          //  If no, echos out Wrong and 0 points, doesn't add anything to total points.
          if ($right == true) {
            echo "Correct! "; echo array_values($score)[0];
            $earned = $earned + array_values($score)[0];
            $right = false;
          } else {
            echo "Wrong. 0";
          }
          ?>
        </p>
      </li>
      <?php

      //Increments question number
      $qn = $qn + 1;
    }
    ?>
  </ul>

  <?php

  //Checks for the total points of the entire exam/quiz
  $totSQL = "SELECT total_points FROM exam WHERE exam_name = '$exam'";
  $tot = array_values(mysql_fetch_array(mysql_query($totSQL)))[0];

  //Inserts final score with student id and exam name into table
  $finScoreSQL = "INSERT INTO takes VALUES ($userID, '$exam', $earned)";

  //Echo out the final score.
  echo "Total Score: ";
  echo $earned; echo "/"; echo $tot;
  ?>

</body>
</html>
