<?php

session_start();
require_once "connect.php";

//Checking to see if student is logged in, if not, takes us back to login page.
//if(!isset($_SESSION['username'])) {
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
  <h2>Goodluck! You'll need it.</h2>

  <!-- This is where all the action is. This form has PHP inside that will loop through the database and find -->
  <!-- all the questions for the exam_name and then print out all the choices. The values are all within an -->
  <!-- input type (radio) for safe keeping until the quiz/exam is submitted. -->
  <form action="grade.php" method="post">
    <ul>
      <?php
      //Creating some variables here with a query
      $exam = $_POST["exam"];
      $_SESSION["exam"] = $exam;
      $i = 1;
      $quesSQL = "SELECT info FROM question WHERE exam_name = '$exam'";
      $resultQues = mysql_query($quesSQL);
      $amount = mysql_num_rows($resultQues);
      $_SESSION["amount"] = $amount;

      //Loop through the query result
      while ($ques = mysql_fetch_array($resultQues)) {

        ?>
        <li>
          <h3><?php echo $ques["info"]; ?></h3>
          <?php
          //This is where the magic happens. Checking to make sure there is at least 1 question.
          if ($amount > 0 ) {

            //Query that checks for the choices asscoiated with the question
            $choiceSQL = "SELECT * FROM choice WHERE exam_name = '$exam' AND num = $i";
            $resultChoice = mysql_query($choiceSQL);

            //Loops through the choice query
            while ($choice = mysql_fetch_array($resultChoice)) {

              //Inside the HTML:
              //  Creating a form input style of a radio to select a choice per question.
              //  Creates a unique name and value to check answers.
              //  Echos out the identifier and choice info per radio
              ?>
              <div>
                <input type="radio" name="question-<?php echo $i; ?>-answers" value="<?php echo $choice["identifier"]; ?>" />
                <label><?php echo $choice["identifier"]; echo ") "; echo $choice["info"]; ?> </label>
              </div>
              <?php
            }

          } else {
            echo "There are no questions for this exam. Oops!";
          }

          ?>
        </li>
        <?php

        //Incrementing the i for question number.
        $i++;

      }
      ?>
      <input type="submit" value="Submit" />
    </ul>
    <form>

    </body>
    </html>
