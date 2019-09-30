<?php
// 'Trades' object
class Trades{
 
    // database connection and table name
    private $table_name = "trades";

	//Get Trades details
	function tradesView(){
		include '../../config/dbconfig.php';
		
		// query to Get Trades details
		$query = "SELECT *
				  FROM " . $this->table_name . "";

		// prepare the query
		$stmt = $conn->prepare($query);
		// execute the query
		$stmt->execute();
		// get number of rows
		$num = $stmt->rowCount();
		// if Trades exists,
		if($num>0){
				// get record details / values
				$row = $stmt->fetchAll(PDO::FETCH_CLASS, 'Trades');
				// return object
				return $row;
		}
	}

#########################################################################################
#########################################################################################

// create new Trades record
	function tradesUpload(){
		include '../../config/dbconfig.php';
		
		// insert query
		$query = "INSERT INTO
				 " . $this->table_name . "
				 SET
					trade_id = :trade_id,
					tranaction_date = :tranaction_date,
					trade_quantity = :trade_quantity,
					tranaction_type = :tranaction_type,
					share_price = :share_price,
					total_value = :total_value,
					brokerage = :brokerage,
					settlement_date = :settlement_date,
					cds_account = :cds_account,
					instrument_id = :instrument_id";
					
		// prepare the query
		$stmt = $conn->prepare($query);

		$filename=$_FILES['cse_trade_file']['tmp_name'];
		$row = 1;
		$rd = false;

		if($_FILES['cse_trade_file']['size'] > 0){
			
			$file = fopen($filename, "r");
			while (($getData = fgetcsv($file, 10000, ",")) !== FALSE){
				$num = count($getData);
				$row++;
				
				// bind the values
				$stmt->bindParam(':trade_id', $getData[0]);
				$stmt->bindParam(':tranaction_date', $getData[1]);
				$stmt->bindParam(':trade_quantity', $getData[2]);
				$stmt->bindParam(':tranaction_type', $getData[3]);
				$stmt->bindParam(':share_price', $getData[4]);
				$stmt->bindParam(':total_value', $getData[5]);
				$stmt->bindParam(':brokerage', $getData[6]);
				$stmt->bindParam(':settlement_date', $getData[7]);
				$stmt->bindParam(':cds_account', $getData[8]);
				$stmt->bindParam(':instrument_id', $getData[9]);
			
				$rd = $stmt->execute();			
				
			}
			fclose($file);
			// execute the query, also check if query was successful
				if($rd){
					$row = $row - 1;
					$result = array(true, $row, $num);
					return $result;
				}else{
					$this->showError($stmt);
					return false;
				}
		}
		else{
			return "filezero";
		}
		
		//$this->added_by=$_SESSION['login_id'];
		$this->added_date=date('Y-m-d H:i:s');
		$this->status="1";

	}

#########################################################################################
#########################################################################################

	//show additional details about an error
	public function showError($stmt){
    //echo "<pre>";
        //print_r($stmt->errorInfo());
    //echo "</pre>";
	}

}
?>