<?php
header('Content-Type: application/json');

include 'sql_conn.php';

$sqlQuery = "SELECT SUM(detail_bill.DB_QUANTITY) AS quantity, product.P_NAME as product FROM detail_bill INNER JOIN product ON product.P_ID = detail_bill.P_ID GROUP BY product.P_NAME";

$result = mysqli_query($conn,$sqlQuery);

$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

mysqli_close($conn);

echo json_encode($data);
?>