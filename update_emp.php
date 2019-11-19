<?php 
	session_start();
	error_reporting(E_PARSE);
	include 'sql_conn.php';
	if (isset($_SESSION['account']) && $_SESSION['user_group']=="admin") { //Kiểm tra có login hay chưa, nếu có thì biết $_SESSION sẽ có giá trị là tài khoản vừa nhập
		
		if (isset($_GET['update'])) {
			$select = "SELECT * FROM employees WHERE E_ID = '".$_GET['update']."'";
			$select_query = mysqli_query($conn, $select);
			if ($select_query->num_rows > 0) {
				while ($row = mysqli_fetch_assoc($select_query)){
					$phone = $row['E_PHONE'];
					$address = $row['E_ADDRESS'];
					$job = $row['E_JOB'];
				}
			}
			if ($_GET['ephone']=="") 
				$_GET['ephone']=$phone;
			if ($_GET['eaddress']=="")
				$_GET['eaddress']=$address;
			if ($_GET['ejob']=="")
				$_GET['ejob']=$job;
			if ($_GET['ejob']=="Order")
				$order="order";
			else
				$order="";
			$update = "UPDATE employees SET E_PHONE = '".trim($_GET['ephone'])."', E_ADDRESS = '".trim($_GET['eaddress'])."', E_JOB = '".trim($_GET['ejob'])."', E_USERGROUP='".$order."' WHERE E_ID = '".trim($_GET['update'])."'";
			// echo $update;
			$update_query = mysqli_query($conn, $update);
			header('Location: employee.php');
		}
	} else {
		header('Location: login.php'); //Nếu không phải tài khoản admin thì chuyển về trang login.php
	}
 ?>