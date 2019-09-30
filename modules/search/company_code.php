<?php
$login_name = $_GET['company_code'];
$startFrom = 0;
$endTo = $startFrom + 5;
$dbtable = "company";
$dbcolumn = "company_code";
// make login_name search friendly
$like = $login_name.'%';
// open new mysql prepared statement

include '../../config/dbconfig.php';
// query to Get instrument details
$query = "SELECT " . $dbcolumn . "
		  FROM " . $dbtable . "
          WHERE " . $dbcolumn . " LIKE ?
		  GROUP BY " . $dbcolumn . "
          LIMIT ".$startFrom.",".$endTo."";
// prepare the query
$stmt = $conn->prepare($query);
// bind given instrument Code value
$stmt->bindParam(1, $like);
//$stmt->bindParam(2, $startFrom);
// execute the query
$stmt->execute();
// get number of rows
$num = $stmt->rowCount();
// if instrument exists, assign values to object
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