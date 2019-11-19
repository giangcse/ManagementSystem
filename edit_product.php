<?php 
	session_start();
	error_reporting(E_PARSE);
	include 'sql_conn.php';
	if (isset($_SESSION['account']) && $_SESSION['user_group']=="admin") { //Kiểm tra có login hay chưa, nếu có thì biết $_SESSION sẽ có giá trị là tài khoản vừa nhập
		if (isset($_GET['edit'])) {
			$select = "SELECT * FROM product WHERE P_ID = '".$_GET['edit']."'";
			$select_query = mysqli_query($conn, $select);
			if ($select_query->num_rows > 0) {
				while ($row = mysqli_fetch_assoc($select_query)) {
					$price = $row['P_PRICE'];
					$specie = $row['P_SPECIES'];
					$link = $row['P_THUMB_IMG'];
				}
			}
			if ($_GET['product-price']=="")
				$_GET['product-price']=$price;
			if ($_GET['product-link']=="")
				$_GET['product-link']=$link;
			if ($_GET['product-specie']=="")
				$_GET['product-specie']=$specie;
			$_GET['product-price'] = trim($_GET['product-price']);
			$_GET['product-link'] = trim($_GET['product-link']);
			$_GET['product-specie'] = trim($_GET['product-specie']);
		    $update = "UPDATE product SET P_PRICE = '".$_GET['product-price']."', P_THUMB_IMG = '".$_GET['product-link']."', P_SPECIES = '".$_GET['product-specie']."' WHERE P_ID = '".$_GET['edit']."'";
		    $update_query = mysqli_query($conn, $update);
		    // echo $update;
		    header('Location: product.php');
		}
	} else {
		header('Location: login.php'); //Nếu không phải tài khoản admin thì chuyển về trang login.php
	}
 ?>