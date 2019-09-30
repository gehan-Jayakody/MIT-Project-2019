<?php
// 'Portfolio' object
class Portfolio{
 	
	//Portfolio Status Get Function
	function portfolioValuation(){
		include '../../config/dbconfig.php';
		
		// query to Get Portfolio details
		$query = "SELECT trades.instrument_id AS 'Instrument Name', FORMAT(SUM(trades.trade_quantity),0) AS 'Quantity', 
		CAST(AVG(trades.share_price)AS DECIMAL(10,2)) AS 'Average Price', FORMAT(SUM(trades.total_value),2) AS 'Total Value'
				  FROM trades, client
				  WHERE trades.cds_account = ? AND trades.cds_account = client.cds_account AND client.status = '1'
				  GROUP BY instrument_id";

		// prepare the query
		$stmt = $conn->prepare($query);
		 // sanitize
		$this->cds_account=htmlspecialchars(strip_tags($_POST['cds_account']));
		// bind given Portfolio Code value
		$stmt->bindParam(1, $this->cds_account);
		// execute the query
		$stmt->execute();
		// get number of rows
		$num = $stmt->rowCount();
		// if Portfolio exists,
		if($num>0){
			// get record details / values
			$row = $stmt->fetchAll(PDO::FETCH_CLASS, 'Portfolio');
			// return object
			return $row;
		}
		else{
			return false;
		}
	}

#########################################################################################
#########################################################################################

	//Portfolio Status Get Function - Equity
	function portfolioViewE(){
		include '../../config/dbconfig.php';
		
		// query to Get Portfolio details
		$query = "SELECT trades.tranaction_date, trades.trade_id AS 'Trade ID', trades.tranaction_type, 
						 trades.instrument_id AS 'Instrument ID', FORMAT(trades.trade_quantity,0) AS 'Trade Quantity', trades.settlement_date
				  FROM trades, client, equity
				  WHERE trades.cds_account = ? AND trades.cds_account = client.cds_account AND 
				  trades.instrument_id = equity.instrument_id AND client.status = '1'";

		// prepare the query
		$stmt = $conn->prepare($query);
		 // sanitize
		$this->cds_account=htmlspecialchars(strip_tags($_POST['cds_account']));
		// bind given Portfolio Code value
		$stmt->bindParam(1, $this->cds_account);
		// execute the query
		$stmt->execute();
		// get number of rows
		$num = $stmt->rowCount();
		// if Portfolio exists,
		if($num>0){
				// get record details / values
				$row = $stmt->fetchAll(PDO::FETCH_CLASS, 'Portfolio');
				// return object
				return $row;
		}
		else{
			return false;
		}
	}
	
#########################################################################################
#########################################################################################

	//Portfolio Status Get Function - Debit
	function portfolioViewD(){
		include '../../config/dbconfig.php';
		
		// query to Get Portfolio details
		$query = "SELECT trades.tranaction_date, trades.trade_id, trades.tranaction_type, 
						 trades.instrument_id, trades.trade_quantity, trades.settlement_date
				  FROM trades, client, debenture
				  WHERE trades.cds_account = ? AND trades.cds_account = client.cds_account AND 
				  debenture.instrument_id = trades.instrument_id AND client.status = '1'";

		// prepare the query
		$stmt = $conn->prepare($query);
		 // sanitize
		$this->cds_account=htmlspecialchars(strip_tags($_POST['cds_account']));
		// bind given Portfolio Code value
		$stmt->bindParam(1, $this->cds_account);
		// execute the query
		$stmt->execute();
		// get number of rows
		$num = $stmt->rowCount();
		// if Portfolio exists,
		if($num>0){
				// get record details / values
				$row = $stmt->fetchAll(PDO::FETCH_CLASS, 'Portfolio');
				// return object
				return $row;
		}
		else{
			return false;
		}
	}

#########################################################################################
#########################################################################################

// Portfolio record Update	
	function portfolioTran(){
		include '../../config/dbconfig.php';
		//$this->updated_by=$_SESSION['login_id'];
		$this->updated_date=date('Y-m-d H:i:s');

		// update query
		$query = "UPDATE
						trades
				  SET
					cds_account = :new_cds_account
				  WHERE
					cds_account = :old_cds_account";
					
		$query2 = "INSERT INTO
						portfolio_tranfer
				  SET
					old_cds_account = :old_cds_account,
					new_cds_account = :new_cds_account,
					updated_by = :updated_by,
					updated_date = :updated_date";
					
		// prepare the query
		$stmt = $conn->prepare($query);
		$stmt2 = $conn->prepare($query2);
	 
		// sanitize
		$this->old_cds_account=htmlspecialchars(strip_tags($_SESSION['cds_account']));
		$this->new_cds_account=htmlspecialchars(strip_tags($_POST['new_cds_account']));
					 
		// bind the values
		$stmt->bindParam(':old_cds_account', $this->old_cds_account);
		$stmt->bindParam(':new_cds_account', $this->new_cds_account);
		$stmt2->bindParam(':old_cds_account', $this->old_cds_account);
		$stmt2->bindParam(':new_cds_account', $this->new_cds_account);
		$stmt2->bindParam(':updated_by', $this->updated_by);
		$stmt2->bindParam(':updated_date', $this->updated_date);
				
		// execute the query, also check if query was successful
		if($stmt->execute() && $stmt2->execute()){
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