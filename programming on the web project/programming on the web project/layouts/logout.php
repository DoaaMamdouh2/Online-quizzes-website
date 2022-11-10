<?php
    session_start();

    // logout
    unset($_SESSION['loggedIN']);
    session_destroy();
    header('Location: login.php');
    exit();
?>