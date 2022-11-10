<?php
  session_start();
  // if already logged IN
  if (!isset($_SESSION['loggedIN'])) {
    header('Location: login.php');
    exit();
  }
  // include fiel database
  include('db.php');

  // count
  $i = 1;
  
  // condition check on user
//   $data = $connection->query("SELECT id, userId FROM start_quizes WHERE userId='$_SESSION[id]'"); // Selecting start quizes from Database
//   if ($data->num_rows <= 0) {
//       header('Location: start_quiz.php');
//       exit();
//   }

  $start_quizes = $connection->query("SELECT id, userId, examId FROM start_quizes WHERE userId='$_SESSION[id]'"); // Selecting start quizes from Database
  
//   condition insert quize


?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
		<meta name="description" content="make form">
		<title>Quiz</title>
        <!-- style css quiz -->
		<link rel="stylesheet" href="css/quiz.css">
        <link rel="stylesheet" href="css/header.css">
    
    </head>
    <body>
      <!-- main header -->
      <?php include('layouts/header.php'); ?>
      <!-- end haeder -->

        <h2 class="right">Start Quiz ...</h2>
        
        <!-- count time the quiz -->
        <div style="float:right;padding-left: 40px;padding: 20px 40px;font-size: 21px;background: red;"><label id="minutes">00</label>:<label id="seconds">00</label></div>

        <!-- form quiz -->
        <?php foreach($start_quizes as $start_quize){ 
            $questions = $connection->query("SELECT id, examId, name FROM questions WHERE examId='$start_quize[examId]'"); // Selecting exam from Database
            foreach ($questions as $question) {
                $answers = $connection->query("SELECT id, questionId,answer,type name FROM answers WHERE questionId='$question[id]'"); // Selecting exam from Database    
        ?>
        <form method="post" class="right">
            <label><?php echo $i++.') '. $question['name']; ?> </label>
            <br>
            
            <?php if($answers->num_rows > 0 ){ 
                foreach ($answers as $answer) { ?>
                    <input type="text" id="number_correct_answers" class="number_correct_answers"  placeholder="Pleas Answer" style="width: 34%;"><br>
                    <input type="hidden" id="start_date" class="start_date"  value="<?php echo date('H:i:s'); ?>" style="width: 34%;"><br>
                <?php } 
                }else{ ?>
                <label style="color: red;">There are no answers!!</label><br>
            <?php } ?>
            <?php if($answers->num_rows > 0 ){ ?>
            <input type="button" class="submit" id="submit" class="submit" value="Submit"><br><br><br>
            <?php }else{ echo '<br>'; } ?>
        </form>
        <?php 
            }
        } 
        ?>

		<script src="js/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <!-- code count time used javascript -->
        <script src="js/quiz.js" ></script>
    </body>
</html>