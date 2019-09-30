<?php
// 'Message' object
class Message{
 
    // database connection and table name
    private $table_name = "cse_messages";
	
	//Message Status Get Function
	function messageInfo(){
		include 'config/dbconfig.php';
		
		// query to Get Message details
		$mquery = "SELECT *
				  FROM cse_messages ";

		// prepare the query
		$mstmt = $conn->prepare($mquery);
		$mstmt->execute();
		// get number of rows
		$mnum = $mstmt->rowCount();
		// if Message exists,
		if($mnum>0){
				// get record details / values
				$mrow = $mstmt->fetchAll(PDO::FETCH_CLASS, 'Message');
				// return object
				return $mrow;
		}
	}
}
?>