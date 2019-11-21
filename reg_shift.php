<?php 
	session_start();
	include 'sql_conn.php';
	if (isset($_SESSION['account'])) {
		//Lay E_ID tu $_SESSION['account']
		$E_ID = 0;
		$getid = "SELECT E_ID FROM employees WHERE E_ACCOUNT = '".$_SESSION['account']."'";
		$result = mysqli_query($conn, $getid);
		if ($result->num_rows > 0) {
			while ($rows = mysqli_fetch_assoc($result)) {
				$E_ID = $rows['E_ID'];
			}
		}
		//Lay S_ID
		$S_ID = 0;
		
		if (isset($_GET['shift']) && isset($_GET['day'])) {
			foreach ($_GET['day'] as $key) {
				foreach ($_GET['shift'] as $value) {
					$sel = "SELECT DS_SHIFTNAME, DS_DAYOFSHIFT FROM detail_shift WHERE E_ID = '".$E_ID."'";
					$sel_query = mysqli_query($conn, $sel);
					if ($sel_query->num_rows > 0) {
						while ($row = mysqli_fetch_assoc($sel_query)) {
							if ($row['DS_SHIFTNAME'].$row['DS_DAYOFSHIFT']==$value.$key){ 
								// header('Location: emp.php');
								echo "Trùng";
								break 3;
								header('Location: emp.php');
							}
							else{
								// echo "Khong trung";
								$get_sid = "SELECT MAX(S_ID) AS S_ID FROM shift";
								$result_sid = mysqli_query($conn, $get_sid);
								$sid = mysqli_fetch_assoc($result_sid);
								if ($sid == "") {
									$S_ID = 1;
								} else {
									$S_ID = $sid['S_ID'] + 1;
								}
								$shift = "INSERT INTO shift VALUES ('".$S_ID."')";
								$detail_shift = "INSERT INTO detail_shift VALUES ('".$E_ID."', '".$S_ID."', '".$value."', '".$key."', '100000')";
							}
						}
						  mysqli_query($conn, $shift);
						  mysqli_query($conn, $detail_shift);
					}else{
						$get_sid = "SELECT MAX(S_ID) AS S_ID FROM shift";
						$result_sid = mysqli_query($conn, $get_sid);
						$sid = mysqli_fetch_assoc($result_sid);
						if ($sid == "") {
							$S_ID = 1;
						} else {
							$S_ID = $sid['S_ID'] + 1;
						}
						$shift = "INSERT INTO shift VALUES ('".$S_ID."')";
						$detail_shift = "INSERT INTO detail_shift VALUES ('".$E_ID."', '".$S_ID."', '".$value."', '".$key."', '100000')";
						// echo $reg;
						mysqli_query($conn, $shift);
						mysqli_query($conn, $detail_shift);
					}					
				}
			}
		}
		else
			header('Location: emp.php');
	}else
	  	header('Location: login.php');
	header('Location: emp.php');
 ?>