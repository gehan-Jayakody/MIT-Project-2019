<?php
// 'Payment' object
class Payment{
 
    // database connection and table name
    private $table_name = "payments";
	
	//Payment Status Get Function
	function paymentHistory($filter){
		include '../../config/dbconfig.php';
		if($filter=="1"){
			$this->to_date = date("Y-m-d");
			$this->from_date=htmlspecialchars(strip_tags($_POST['from_date']));	
		}
		elseif($filter=="2"){
			$this->from_date = date("Y-m-d",strtotime("-3 month"));
			$this->to_date=htmlspecialchars(strip_tags($_POST['to_date']));
		}
		elseif($filter=="3"){
			$this->from_date=htmlspecialchars(strip_tags($_POST['from_date']));
			$this->to_date=htmlspecialchars(strip_tags($_POST['to_date']));
		}
		elseif($filter=="0"){
			$this->from_date = date("Y-m-d",strtotime("-3 month"));
			$this->to_date = date("Y-m-d");		
		}
		// query to Get Payment details
		$query = "SELECT receipt_date, FORMAT(payment_amount,2) AS 'Payment Amount [Rs.]', payment_type, transaction_refernce
				  FROM " . $this->table_name . "
				  WHERE cds_account = ? AND status = '1' AND receipt_date BETWEEN ? AND ? ";

		// prepare the query
		$stmt = $conn->prepare($query);
		 // sanitize
		$this->cds_account=htmlspecialchars(strip_tags($_POST['cds_account']));
		// bind given Payment Code value
		$stmt->bindParam(1, $this->cds_account);
		$stmt->bindParam(2, $this->from_date);
		$stmt->bindParam(3, $this->to_date);
		// execute the query
		$stmt->execute();
		// get number of rows
		$num = $stmt->rowCount();
		// if Payment exists,
		if($num>0){
				// get record details / values
				$row = $stmt->fetchAll(PDO::FETCH_CLASS, 'Payment');
				// return object
				return $row;
		}
	}

#########################################################################################
#########################################################################################

	//Payment Status Get Function
	function paymentSummary(){
		include '../../config/dbconfig.php';
		
		// query to Get Payment details
		$query = "SELECT Sum(trades.total_value) AS 'trade_summary', Sum(payments.payment_amount) AS 'payment_summary'
				  FROM trades, payments, equity
				  WHERE trades.cds_account = payments.cds_account AND trades.instrument_id = equity.instrument_id AND trades.cds_account = ? ";

		// prepare the query
		$stmt = $conn->prepare($query);
		 // sanitize
		$this->cds_account=htmlspecialchars(strip_tags($_POST['cds_account']));
		// bind given Payment Code value
		$stmt->bindParam(1, $this->cds_account);
		// execute the query
		$stmt->execute();
		// get number of rows
		$num = $stmt->rowCount();
		// if Payment exists,
		if($num>0){
				// get record details / values
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				//$row_out = $row['SUM(payment_amount)'];
				// return object
				//return $row_out;
				return $row;
		}
		else{
			return false;
		}
	}

#########################################################################################
#########################################################################################

// create new Payment record
	function paymentAdd(){
		include '../../config/dbconfig.php';
		$this->status = "1";
		//$this->added_by = $_SESSION['login_id'];
		$this->added_date = date('Y-m-d H:i:s');
		$this->backoffice_code = "";

		// insert query
		$query = "INSERT INTO
					" . $this->table_name . "
				SET
					receipt_id = :receipt_id,
					receipt_date = :receipt_date,
					cds_account = :cds_account,
					payment_amount = :payment_amount,
					payment_type = :payment_type,
					transaction_refernce = :transaction_refernce,
					backoffice_code = :backoffice_code,
					status = :status,
					added_by = :added_by,
					added_date = :added_date";
	 
		// prepare the query
		$stmt = $conn->prepare($query);
	 
		// sanitize
		$this->receipt_id=htmlspecialchars(strip_tags($_POST['receipt_id']));
		$this->receipt_date=htmlspecialchars(strip_tags($_POST['receipt_date']));
		$this->cds_account=htmlspecialchars(strip_tags($_POST['cds_account']));
		$this->payment_amount=htmlspecialchars(strip_tags($_POST['payment_amount']));
		$this->payment_type=htmlspecialchars(strip_tags($_POST['payment_type']));
		$this->transaction_refernce=htmlspecialchars(strip_tags($_POST['transaction_refernce']));;
					 
		// bind the values
		$stmt->bindParam(':receipt_id', $this->receipt_id);
		$stmt->bindParam(':receipt_date', $this->receipt_date);
		$stmt->bindParam(':cds_account', $this->cds_account);
		$stmt->bindParam(':payment_amount', $this->payment_amount);
		$stmt->bindParam(':payment_type', $this->payment_type);
		$stmt->bindParam(':transaction_refernce', $this->transaction_refernce);
		$stmt->bindParam(':backoffice_code', $this->backoffice_code);
		$stmt->bindParam(':status', $this->status);
		$stmt->bindParam(':added_by', $this->added_by);
		$stmt->bindParam(':added_date', $this->added_date);
				
		// execute the query, also check if query was successful
		if($stmt->execute()){
			return true;
		}else{
			//$this->showError($stmt);
			return false;
		}
	 
	}

	//show additional details about an error
	public function showError($stmt){
    //echo "<pre>";
        //print_r($stmt->errorInfo());
    //echo "</pre>";
	}

}
?>