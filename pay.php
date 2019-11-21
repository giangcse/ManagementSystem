<?php
	session_start(); 
  if(!isset($_SESSION['account']))
    header('Location: login.php');

	include 'sql_conn.php';
	date_default_timezone_set("Asia/Ho_Chi_Minh");

  $select_id = "SELECT MAX(CAST(B_ID AS int)) AS id FROM bill";
  $select_id_result = mysqli_query($conn, $select_id);

  if ($select_id_result->num_rows > 0) {
    while ($row1 = mysqli_fetch_assoc($select_id_result)) {
    	$id = $row1['id'];
    	if ($id=="") {
    		$id = 1;
    	} else {
    		$id = $row1['id'] + 1;
    	}
    }
  }

    //Lay $S_ID tu shift
  $get_sid = "SELECT MAX(detail_shift.S_ID) AS S_ID, employees.E_ACCOUNT FROM employees INNER JOIN detail_shift ON detail_shift.E_ID = employees.E_ID WHERE employees.E_ACCOUNT = '".$_SESSION['account']."'";
  $result_sid = mysqli_query($conn, $get_sid);
  $sid = mysqli_fetch_assoc($result_sid);
  $S_ID = $sid['S_ID'];
  $E_ACCOUNT = $sid['E_ACCOUNT'];

if ($_SESSION['CART']['TOTAL'] > 0) {
	$add_bill = "INSERT INTO bill VALUES ('".$id."', '".date("Y-m-d h:m:s")."', '".$_SESSION['CART']['TOTAL']."')";
    $add_bill_query = mysqli_query($conn, $add_bill); //Them vao bang bill
    // echo $add_bill;
	foreach($_SESSION['CART'] as $key=>$value){
      $cart_select = "SELECT * FROM product WHERE P_ID = '".$key."'";
      $cart_query = mysqli_query($conn, $cart_select);
      if($cart_query->num_rows > 0){
        while($row0 = mysqli_fetch_assoc($cart_query)){ 
            $add = "INSERT INTO detail_bill VALUES ('".$key."' ,'".$id."', '".$S_ID."', '".$_SESSION['CART'][$row0['P_ID']]."', '".$_SESSION['CART'][$row0['P_ID']]*$row0['P_PRICE']."')";
            $add_query = mysqli_query($conn, $add);
            // echo $add.'<br>';
            unset($_SESSION['CART'][$row0['P_ID']]);
        }
        $_SESSION['paid'] = "yes";
      }else{
        $_SESSION['paid'] = "no";
      }
    }
}
else{
    $_SESSION['paid'] = "no";
        
}
header('Location: index.php');	
?>