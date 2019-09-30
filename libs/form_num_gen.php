<?php
class Form_num {
	private $table_name = "client";
	public $gen_form_number;
	
	public function formNum(){
		include '../../config/dbconfig.php';
	
		// query to Get Company details
		$query = "SELECT MAX(application_number)
				  FROM " . $this->table_name . "
				  LIMIT 0,1";

		// prepare the query
		$stmt = $conn->prepare($query);
		// execute the query
		if($stmt->execute()){
			// get number of rows
			$num = $stmt->rowCount();
			//Assign values to object
			if($num>0){
				// get record details / values
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				// assign values to object properties
				$this->gen_form_number=$row['MAX(application_number)'];
				$this->gen_form_number=$this->gen_form_number+1529;
				return $this->gen_form_number;
			}
		}
		else{
			//$this->showError($stmt);
		}
	}
	
	function rcptNum(){
		include '../../config/dbconfig.php';
	
		// query to Get Company details
		$query = "SELECT MAX(receipt_id)
				  FROM payments
				  LIMIT 0,1";

		// prepare the query
		$stmt = $conn->prepare($query);
		// execute the query
		$stmt->execute();
		// get number of rows
		$num = $stmt->rowCount();
		// if Payment exists,
		if($num>0){
			// get record details / values
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$rcptval = $row['MAX(receipt_id)']+1326;
			// return object
			return $rcptval;
		}
		else{
			$this->showError($stmt);
		}
	}
	
	public function showError($stmt){
    echo "<pre>";
        //print_r($stmt->errorInfo());
    echo "</pre>";
	}
}
?>