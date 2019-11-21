<?php
    session_start();
    include 'sql_conn.php';

    if (isset($_POST['deleteCart'])) {
        $MSHH = $_POST['deleteCart'];
        unset($_SESSION['CART'][$MSHH]);
        header('Location: index.php');
    }
?>