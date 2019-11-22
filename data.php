<?php
header('Content-Type: application/json');

include 'sql_conn.php';
$this_month = date('Y-m').'-01 00:00:00'; //Lay du lieu tu ngay 1 thang hien tai;
$next_month = date('Y').'-'.(intval(date('m'))+1).'-01 00:00:00';
$sqlQuery = "SELECT SUM(detail_bill.DB_QUANTITY) AS quantity, product.P_NAME as product FROM detail_bill INNER JOIN product ON product.P_ID = detail_bill.P_ID INNER JOIN bill ON bill.B_ID = detail_bill.B_ID WHERE bill.B_TIME BETWEEN '".$this_month."' AND '".$next_month."' GROUP BY product.P_NAME";

// echo $sqlQuery;
$result = mysqli_query($conn,$sqlQuery);

$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

mysqli_close($conn);

echo json_encode($data);
?>