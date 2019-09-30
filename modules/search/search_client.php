<?php
$login_name = $_GET['client_account'];
$startFrom = 0;
$endTo = $startFrom + 5;
$dbtable = "client";
$dbcolumn = "client_ac_number";
// make login_name search friendly
$like = $login_name.'%';
// open new mysql prepared statement

include '../../config/dbconfig.php';
// query to Get Portfolio details
$query = "SELECT " . $dbcolumn . "
		  FROM " . $dbtable . "
          WHERE " . $dbcolumn . " LIKE ? AND client_status = '1'
		  GROUP BY " . $dbcolumn . "
          LIMIT ".$startFrom.",".$endTo."";
// prepare the query
$stmt = $conn->prepare($query);
// bind given Portfolio Code value
$stmt->bindParam(1, $like);
//$stmt->bindParam(2, $startFrom);
// execute the query
$stmt->execute();
// get number of rows
$num = $stmt->rowCount();
// if Portfolio exists, assign values to object
if($num>0){
	// get record details / values
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
	echo json_encode($row);
	exit();
}

else{
	$dbsearch = new stdClass();
	$dbsearch->client_account = 'No Record Found';
	$row = array($dbsearch);
	echo json_encode($row);
	exit();
}
?>