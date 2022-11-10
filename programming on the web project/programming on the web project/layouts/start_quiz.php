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

    $exams = $connection->query("SELECT id, name_exam, type_exam, time FROM exams"); // Selecting exam from Database
    $data = $connection->query("SELECT id, userId, start_time FROM start_quizes WHERE userId='$_SESSION[id]'"); // Selecting start quizes from Database

  // condition check on user
    if ($data->num_rows > 0) {
        header('Location: result.php');
        exit();
    }else {      
    
        // condition signup
        if(isset($_POST['choose'])) {
            $userId = $_POST['userId'];
            $examId = $_POST['examId'];
            $start_time = date('H:i:s');
            $correct_answers = $_POST['correct_answers'];
        
            $sql = "INSERT INTO start_quizes (userId, examId, correct_answers, start_time) VALUES ('$userId', '$examId', $correct_answers, '$start_time')";
        
            if (mysqli_query($connection, $sql)) {
                header('Location: start_quiz.php');
                header('Location: quiz.php');
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($connection);
            }
            mysqli_close($connection);
        }
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
		<meta name="description" content="make form">
		<title>Start Quiz</title>
        <!-- style css quiz -->
		<link rel="stylesheet" href="css/quiz.css">
        <link rel="stylesheet" href="css/header.css">
    
    </head>
    <body>
        <!-- main header -->
        <?php include('layouts/header.php'); ?>
        <!-- end haeder -->

        <h2>Choose the type of exam ...</h2>

		<h5 id="response"></h5>

        <!-- form quiz -->
        <?php 
            foreach ($exams as $value) { 
            $questions = $connection->query("SELECT id FROM questions WHERE examId='$value[id]'");
        ?>
        <form action="#" method="post" >
            <label> <?php echo $i++.') ';  echo $value['name_exam']; ?> </label>
            <ul>
                <li><?php if($questions->num_rows > 0) { echo 'Number of questions: '. $questions->num_rows ; }else{ echo '<p style="color:red;">There are no questions!!</p>';}?></li>
                <li>Time: <?php echo $value['time']; ?></li>
            </ul>

            <input type="hidden" class="userId" name="userId" id="userId" value="<?php echo $_SESSION['id'];?>">
            <input type="hidden" class="examId" name="examId" id="examId" value="<?php echo $value['id']; ?>">
            <input type="hidden" class="correct_answers" name="correct_answers" id="correct_answers" value="<?php echo $questions->num_rows; ?>">
            <?php if($questions->num_rows > 0) { ?>
                <input type="submit" class="choose" id="choose" name="choose" value="Choose">
            <?php }else { ?>
                <input type="submit" class="choose" id="choose"  value="Choose">
            <?php } ?>
            
        </form>
        <br><br><br>
        <?php } ?>
		<script src="js/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <!-- code start quiz ajax -->
		<!-- <script src="js/start_quiz.js" ></script> -->

    </body>
</html>