<?php 
	session_start();
	error_reporting(E_PARSE);
	include 'sql_conn.php';
	if (isset($_SESSION['account']) && $_SESSION['user_group']=="admin") { //Kiểm tra có login hay chưa, nếu có thì biết $_SESSION sẽ có giá trị là tài khoản vừa nhập
		if(isset($_GET['delete'])){    
        $delete = "DELETE FROM product WHERE P_ID = '".$_GET['delete']."'";
        $delete_query = mysqli_query($conn, $delete);
        // echo $_GET['delBtn'];
        header('Location: product.php');
    	}
	} else {
		header('Location: login.php'); //Nếu không phải tài khoản admin thì chuyển về trang login.php
	}
 ?>