<?php
  session_start();
  // if already logged IN
  if (!isset($_SESSION['loggedIN'])) {
    header('Location: login.php');
    exit();
  }
?>
<!DOCTYPE html >
<html>
  <head>
    <meta charset="UTF-8">
    <title>start quiz</title>
    <!-- style css start quiz -->
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/header.css">
    
  </head>
  <body>
    <!-- main header -->
    <?php include('layouts/header.php'); ?>
    <!-- end haeder -->

    <h1>Read instructions ....</h1>

    <p class="p1">Attempts allowed:1</p>
    <p class="p2"> This quiz closed when the end time</p>
    <p class="p3">Grading method: Highest grade</p>
    <center>
    <a href="start_quiz.php"> <input type="button" id="start_quiz" value="Attempt the quiz"></a>
    </center>

  </body>
</html>