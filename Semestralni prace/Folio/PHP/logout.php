<?php
    //unsets the session and sends back to homepage
    session_start();
    session_unset();
    session_destroy();
    session_start();

    header('Location: ../homepage.php');
?>