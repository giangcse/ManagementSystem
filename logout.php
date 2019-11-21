<?php
    session_start();
    if(isset($_SESSION['account'])){
        session_destroy();
        header('Location: login.php');
    }
header('Location: login.php');
?>