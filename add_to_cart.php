<?php
    session_start();
    include 'sql_conn.php';
    //Kiem tra dang nhap
    if (!isset($_SESSION['account']))
        header('Location: index.php');

    if (isset($_POST['addToCart']) && $_POST['quantity'] > 0) {
        $MSHH = $_POST['addToCart'];
        $SLHH = $_POST['quantity'];
        //Kiem tra SP da co trong gio hang chua
        if(isset($_SESSION['CART'][$MSHH]))
            $SoLuong = $_SESSION['CART'][$MSHH] + $SLHH; //Neu co thi cong them
        else
            $SoLuong = $SLHH; //Neu chua co thi gan so moi nhap la so luong

        $_SESSION['CART'][$MSHH] = $SoLuong;
        header('Location: index.php');
        // print_r($_SESSION['CART'][$MSHH]);
        // echo $SLHH;
    }
    header('Location: index.php');
?>