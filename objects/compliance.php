<?php
// 'Compliance' object
class Compliance{
 	
	//Compliance Status Get Function
	function buyingPower(){
		include '../../config/dbconfig.php';
		
		// query to Get Compliance details
		$query = "SELECT trades.instrument_id, SUM(trades.trade_quantity) AS 'Quantity', CAST(AVG(trades.share_price)AS DECIMAL(10,2)) AS 'Average Price [Rs.]', 
				instrument.weightage AS 'Weightage [%]', 
				FORMAT(CAST(((SUM(trades.trade_quantity)*(AVG(trades.share_price))*instrument.weightage)/100)AS DECIMAL(10,2)),2) AS 'Weighted Value [Rs.]'
				  FROM trades, client, instrument
				  WHERE trades.cds_account = ? AND trades.cds_account = client.cds_account AND 
				  trades.instrument_id = instrument.instrument_id AND client.status = '1' AND instrument.company_share_volume > 0
				  GROUP BY instrument_id";

		// prepare the query
		$stmt = $conn->prepare($query);
		 // sanitize
		$this->cds_account=htmlspecialchars(strip_tags($_POST['cds_account']));
		// bind given Compliance Code value
		$stmt->bindParam(1, $this->cds_account);
		// execute the query
		$stmt->execute();
		// get number of rows
		$num = $stmt->rowCount();
		// if Compliance exists,
		if($num>0){
			// get record details / values
			$row = $stmt->fetchAll(PDO::FETCH_CLASS, 'Compliance');
			// return object
			return $row;
		}
		else{
			return false;
		}
	}

#########################################################################################
#########################################################################################

	//Compliance Status Get Function - Equity
	function securityExpose(){
		include '../../config/dbconfig.php';
		
		// query to Get Compliance details
		$query = "SELECT instrument_id, instrument_name, weightage AS 'Security Exposure [%]', FORMAT(market_share_volume,0) AS 'Market Share'
				  FROM instrument
				  WHERE instrument_id = ? AND status = '1'";

		// prepare the query
		$stmt = $conn->prepare($query);
		 // sanitize
		$this->instrument_id=htmlspecialchars(strip_tags($_POST['instrument_id']));
		// bind given Compliance Code value
		$stmt->bindParam(1, $this->instrument_id);
		// execute the query
		$stmt->execute();
		// get number of rows
		$num = $stmt->rowCount();
		// if Compliance exists,
		if($num>0){
				// get record details / values
				$row = $stmt->fetchAll(PDO::FETCH_CLASS, 'Compliance');
				// return object
				return $row;
		}
		else{
			return false;
		}
	}

#########################################################################################
#########################################################################################

	//Compliance Status Get Function - Debit
	function debtorReport(){
		include '../../config/dbconfig.php';
		
		// query to Get Compliance details
		$query = "SELECT trades.cds_account AS CDS_account, FORMAT((SUM(trades.total_value)),2) AS trade_summary, 
				FORMAT((SUM(payments.payment_amount)),2) AS payment_summary, FORMAT(((SUM(payments.payment_amount)-SUM(trades.total_value))),2) AS account_balance
				  FROM trades, client, payments
				  WHERE payments.receipt_date BETWEEN ? AND ? AND trades.settlement_date BETWEEN ? AND ? AND 
				  trades.cds_account = client.cds_account AND trades.cds_account = payments.cds_account AND client.status = '1'";

		// prepare the query
		$stmt = $conn->prepare($query);
		 // sanitize
		$this->from_date=htmlspecialchars(strip_tags($_POST['from_date']));
		$this->to_date=htmlspecialchars(strip_tags($_POST['to_date']));
		// bind given Compliance Code value
		$stmt->bindParam(1, $this->from_date);
		$stmt->bindParam(2, $this->to_date);
		$stmt->bindParam(3, $this->from_date);
		$stmt->bindParam(4, $this->to_date);
		// execute the query
		$stmt->execute();
		// get number of rows
		$num = $stmt->rowCount();
		// if Compliance exists,
		if($num>0){
				// get record details / values
				$row = $stmt->fetchAll(PDO::FETCH_CLASS, 'Compliance');
				// return object
				return $row;
		}
		else{
			return false;
		}
	}

#########################################################################################
#########################################################################################

// Security Exposure Update	
	function exposureUpdate(){
		include '../../config/dbconfig.php';
		//$this->updated_by=$_SESSION['login_id'];
		$this->updated_date=date('Y-m-d H:i:s');

		// update query
		$query = "UPDATE
					instrument
				  SET
					weightage = :weightage,
					updated_by = :updated_by,
					updated_date = :updated_date
				  WHERE
					instrument_id = :instrument_id";
	 
		// prepare the query
		$stmt = $conn->prepare($query);
	 
		// sanitize
		$this->weightage=htmlspecialchars(strip_tags($_POST['weightage']));
		$this->instrument_id=htmlspecialchars(strip_tags($_SESSION['instrument_id']));
					 
		// bind the values
		$stmt->bindParam(':weightage', $this->weightage);
		$stmt->bindParam(':instrument_id', $this->instrument_id);
		$stmt->bindParam(':updated_by', $this->updated_by);
		$stmt->bindParam(':updated_date', $this->updated_date);
				
		// execute the query, also check if query was successful
		if($stmt->execute()){
			return true;
		}else{
			$this->showError($stmt);
			return false;
		}
	 
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