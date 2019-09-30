<?php
// 'Company' object
class Company{
 
    // database connection and table name
    private $table_name = "listed_company";
	
	//Company Status Get Function
	function companyInfo(){
		include '../../config/dbconfig.php';
		
		// query to Get Company details
		$query = "SELECT company_name, address
				  FROM " . $this->table_name . "
				  WHERE company_code = ? AND status = 'Active'";

		// prepare the query
		$stmt = $conn->prepare($query);
		 // sanitize
		$this->company_code=htmlspecialchars(strip_tags($_POST['company_code']));
		// bind given Company Code value
		$stmt->bindParam(1, $this->company_code);
		// execute the query
		$stmt->execute();
		// get number of rows
		$num = $stmt->rowCount();
		// if Company exists,
		if($num>0){
				// get record details / values
				$row = $stmt->fetchAll(PDO::FETCH_CLASS, 'Company');
				// return object
				return $row;
		}
	}

#########################################################################################
#########################################################################################

	//Company Status Get Function
	function companyContact(){
		include '../../config/dbconfig.php';
		
		// query to Get Company details
		$query = "SELECT telephone_number, fax_number, email, contact_person
				  FROM " . $this->table_name . "
				  WHERE company_code = ? AND status = 'Active'";

		// prepare the query
		$stmt = $conn->prepare($query);
		 // sanitize
		$this->company_code=htmlspecialchars(strip_tags($_POST['company_code']));
		// bind given Company Code value
		$stmt->bindParam(1, $this->company_code);
		// execute the query
		$stmt->execute();
		// get number of rows
		$num = $stmt->rowCount();
		// if Company exists,
		if($num>0){
				// get record details / values
				$row = $stmt->fetchAll(PDO::FETCH_CLASS, 'Company');
				// return object
				return $row;
		}
	}

#########################################################################################
#########################################################################################

	//Company Status Get Function
	function companyRegularity(){
		include '../../config/dbconfig.php';
		
		// query to Get Company details
		$query = "SELECT company_secretary, company_directors, quoted_date
				  FROM " . $this->table_name . "
				  WHERE company_code = ? AND status = 'Active'";

		// prepare the query
		$stmt = $conn->prepare($query);
		 // sanitize
		$this->company_code=htmlspecialchars(strip_tags($_POST['company_code']));
		// bind given Company Code value
		$stmt->bindParam(1, $this->company_code);
		// execute the query
		$stmt->execute();
		// get number of rows
		$num = $stmt->rowCount();
		// if Company exists,
		if($num>0){
				// get record details / values
				$row = $stmt->fetchAll(PDO::FETCH_CLASS, 'Company');
				// return object
				return $row;
		}
	}	
		
#########################################################################################
#########################################################################################

	//Company Report Get Function
	function companyReport(){
		include '../../config/dbconfig.php';
		
		// query to Get Company details
		$query = "SELECT company_code, company_name, contact_person, quoted_date, added_date, status
				  FROM " . $this->table_name ;

		// prepare the query
		$stmt = $conn->prepare($query);
		// execute the query
		$stmt->execute();
		// get number of rows
		$num = $stmt->rowCount();
		// if Company exists,
		if($num>0){
				// get record details / values
				$row = $stmt->fetchAll(PDO::FETCH_CLASS, 'Company');
				// return object
				return $row;
		}
	}

	
#########################################################################################
#########################################################################################

	//Portfolio Status Get Function - Equity
	function companyHistory(){
		include '../../config/dbconfig.php';
		
		// query to Get Portfolio details
		$query = "SELECT instrument.company_code, trades.tranaction_date, trades.share_price
				  FROM trades, instrument
				  WHERE instrument.company_code = ? AND 
				  trades.instrument_id = instrument.instrument_id ";

		// prepare the query
		$stmt = $conn->prepare($query);
		 // sanitize
		$this->company_code=htmlspecialchars(strip_tags($_POST['company_code']));
		//$this->tranaction_date=htmlspecialchars(strip_tags($_POST['tranaction_date']));
		// bind given Portfolio Code value
		$stmt->bindParam(1, $this->company_code);
		//$stmt->bindParam(2, $this->tranaction_date);
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

	//Company Code and Name Get Function
	function companyCode(){
		include '../../config/dbconfig.php';
		
		// query to Get Company details
		$query = "SELECT company_code, company_name
				  FROM " . $this->table_name ."
				  WHERE status = 'Active'";

		// prepare the query
		$stmt = $conn->prepare($query);
		// execute the query
		$stmt->execute();
		// get number of rows
		$num = $stmt->rowCount();
		// if Company exists,
		if($num>0){
				// get record details / values
				$row = $stmt->fetchAll(PDO::FETCH_CLASS, 'Company');
				// return object
				return $row;
		}
	}

#########################################################################################
#########################################################################################


// create new Company record
	function companyAdd(){
		include '../../config/dbconfig.php';
		$this->status = "Active";
		//$this->added_by = $_SESSION['login_id'];
		$this->added_date = date('Y-m-d H:i:s');

		// insert query
		$query = "INSERT INTO
					" . $this->table_name . "
				SET
					company_code = :company_code,
					company_name = :company_name,
					address = :address,
					telephone_number = :telephone_number,
					fax_number = :fax_number,
					email = :email,
					contact_person = :contact_person,
					company_secretary = :company_secretary,
					company_directors = :company_directors,
					quoted_date = :quoted_date,
					status = :status,
					added_by = :added_by,
					added_date = :added_date";
	 
		// prepare the query
		$stmt = $conn->prepare($query);
	 
		// sanitize
		$this->company_code=htmlspecialchars(strip_tags($_POST['company_code']));
		$this->company_name=htmlspecialchars(strip_tags($_POST['company_name']));
		$this->address=htmlspecialchars(strip_tags($_POST['address']));
		$this->telephone_number=htmlspecialchars(strip_tags($_POST['telephone_number']));
		$this->fax_number=htmlspecialchars(strip_tags($_POST['fax_number']));
		$this->email=htmlspecialchars(strip_tags($_POST['email']));
		$this->contact_person=htmlspecialchars(strip_tags($_POST['contact_person']));
		$this->company_secretary=htmlspecialchars(strip_tags($_POST['company_secretary']));
		$this->company_directors=htmlspecialchars(strip_tags($_POST['company_directors']));
		$this->quoted_date=htmlspecialchars(strip_tags($_POST['quoted_date']));
					 
		// bind the values
		$stmt->bindParam(':company_code', $this->company_code);
		$stmt->bindParam(':company_name', $this->company_name);
		$stmt->bindParam(':address', $this->address);
		$stmt->bindParam(':telephone_number', $this->telephone_number);
		$stmt->bindParam(':fax_number', $this->fax_number);
		$stmt->bindParam(':email', $this->email);
		$stmt->bindParam(':contact_person', $this->contact_person);
		$stmt->bindParam(':company_secretary', $this->company_secretary);
		$stmt->bindParam(':company_directors', $this->company_directors);
		$stmt->bindParam(':quoted_date', $this->quoted_date);
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