<?php
  session_start();
  // if already logged IN
  if (!isset($_SESSION['loggedIN'])) {
    header('Location: login.php');
    exit();
  }

  // include fiel database
  include('db.php');

  // condition check on user
  $data = $connection->query("SELECT id, userId FROM start_quizes WHERE userId='$_SESSION[id]'"); // Selecting start quizes from Database
  if ($data->num_rows <= 0) {
      header('Location: index.php');
      exit();
  }

  $start_quizes = $connection->query("SELECT id, userId, examId, correct_answers, number_correct_answers FROM start_quizes WHERE userId='$_SESSION[id]'"); // Selecting start quizes from Database

?>
<Html>
  <head>
    <title>result</title>
    <link rel="stylesheet" href="css/result.css">
    <link rel="stylesheet" href="css/header.css">
    
  </head>
  <body>
      <!-- main header -->
      <?php include('layouts/header.php'); ?>
      <!-- end haeder -->
    <Center>
      <strong>
        <br><br><br><br><br><br><br><br><br><br><br>
      </strong>
      <br>

      <strong>
        <div class="h">Result </div>
      </strong>
      <br><br>

      <div class="x">No. of Correct Answers : 
      <?php if($start_quizes->num_rows > 0){ 
        foreach ($start_quizes as $value) {
        echo $value['correct_answers'];
      } 
      }else{ echo '0';} ?></div>
      <br><br>

      <div class="y">Your Score : 
      <?php if($start_quizes->num_rows > 0){ 
        foreach ($start_quizes as $value) {
        echo $value['number_correct_answers'];
      } 
      }else{ echo '0';} ?>
      </div>
    </center>
  </body>
</Html>