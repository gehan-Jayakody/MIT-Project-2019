<?php
// 'Client' object
class Client{
 
    // database connection and table name
    private $table_name = "client";

	//Client Details Get Function
	function clientDetails(){
		include '../../config/dbconfig.php';
		
		// query to Get Client details
		$query = "SELECT client_type
				  FROM " . $this->table_name . "
				  WHERE cds_account = ? AND status = '1'";

		// prepare the query
		$stmt = $conn->prepare($query);
		 // sanitize
		$this->cds_account=htmlspecialchars(strip_tags($_POST['cds_account']));
		// bind given Client Code value
		$stmt->bindParam(1, $this->cds_account);
		// execute the query
		$stmt->execute();
		// get number of rows
		$num = $stmt->rowCount();
		// if Client exists,
		if($num>0){
			// get record details values
			$row = $stmt->fetchAll(PDO::FETCH_CLASS, 'Client');
			// Check for Client type
			if($row[0]->client_type == "Individual"){
				
				// query to Get Individual Client details
				$query = "SELECT client.*, individual.*
						  FROM client ,individual
						  WHERE client.cds_account = individual.cds_account AND client.cds_account = ? AND status = '1'";

				// prepare the query
				$stmt = $conn->prepare($query);
				 // sanitize
				$this->cds_account=htmlspecialchars(strip_tags($_POST['cds_account']));
				// bind given Client Code value
				$stmt->bindParam(1, $this->cds_account);
				// execute the query
				$stmt->execute();
				// get number of rows
				$num = $stmt->rowCount();
				// if Client exists,
				if($num>0){
					// get record details / values
					$row = $stmt->fetchAll(PDO::FETCH_CLASS, 'Client');
					return $row;
				}
				else{
					//$this->showError($stmt);
					return false;
				}

			}
			elseif($row[0]->client_type == "Company"){
				
				// query to Get Company Client details
				$query = "SELECT client.*, company.*
						  FROM client ,company
						  WHERE client.cds_account = company.cds_account AND client.cds_account = ? AND status = '1'";

				// prepare the query
				$stmt = $conn->prepare($query);
				 // sanitize
				$this->cds_account=htmlspecialchars(strip_tags($_POST['cds_account']));
				// bind given Client Code value
				$stmt->bindParam(1, $this->cds_account);
				// execute the query
				$stmt->execute();
				// get number of rows
				$num = $stmt->rowCount();
				// if Client exists,
				if($num>0){
					// get record details / values
					$row = $stmt->fetchAll(PDO::FETCH_CLASS, 'Client');
					return $row;
				}
				else{
					//$this->showError($stmt);
					return false;
				}

			}
		}
		else{
			//$this->showError($stmt);
			return false;
		}
	}
	
	
#########################################################################################
#########################################################################################

// create new Client record
	function clientAdd(){
		include '../../config/dbconfig.php';
		//$this->added_by=$_SESSION['login_id'];
		$this->added_date=date('Y-m-d H:i:s');
		$this->status="1";

		// insert query
		$query = "INSERT INTO
					" . $this->table_name . "
				SET
					application_number = :application_number,
					date_of_application = :date_of_application,
					registered_through = :registered_through,
					cds_account = :cds_account,
					client_type = :client_type,
					custodial = :custodial,
					margin_account = :margin_account,
					address = :address,
					contact_number = :contact_number,
					email = :email,
					advisor_code = :advisor_code,
					status = :status,
					added_by = :added_by,
					added_date = :added_date";
	 
		// prepare the query
		$stmt = $conn->prepare($query);
	 
		// sanitize
		$this->application_number=htmlspecialchars(strip_tags($_POST['application_number']));
		$this->date_of_application=htmlspecialchars(strip_tags($_POST['date_of_application']));
		$this->registered_through=htmlspecialchars(strip_tags($_POST['registered_through']));
		$this->cds_account=htmlspecialchars(strip_tags($_POST['cds_account']));
		$this->client_type=htmlspecialchars(strip_tags($_POST['client_type']));
		$this->custodial=htmlspecialchars(strip_tags($_POST['custodial']));
		$this->margin_account=htmlspecialchars(strip_tags($_POST['margin_account']));
		$this->address=htmlspecialchars(strip_tags($_POST['address']));
		$this->contact_number=htmlspecialchars(strip_tags($_POST['contact_number']));
		$this->email=htmlspecialchars(strip_tags($_POST['email']));
		$this->advisor_code=htmlspecialchars(strip_tags($_POST['advisor_code']));
					 
		// bind the values
		$stmt->bindParam(':application_number', $this->application_number);
		$stmt->bindParam(':date_of_application', $this->date_of_application);
		$stmt->bindParam(':registered_through', $this->registered_through);
		$stmt->bindParam(':cds_account', $this->cds_account);
		$stmt->bindParam(':client_type', $this->client_type);
		$stmt->bindParam(':custodial', $this->custodial);
		$stmt->bindParam(':margin_account', $this->margin_account);
		$stmt->bindParam(':address', $this->address);
		$stmt->bindParam(':contact_number', $this->contact_number);
		$stmt->bindParam(':email', $this->email);
		$stmt->bindParam(':advisor_code', $this->advisor_code);
		$stmt->bindParam(':status', $this->status);
		$stmt->bindParam(':added_by', $this->added_by);
		$stmt->bindParam(':added_date', $this->added_date);
				
		if(isset($_POST["surname"]) && !empty($_POST["surname"])) {
			// insert query for client Type Individual
			$query2 = "INSERT INTO individual
					SET
						title = :title,
						initials = :initials,
						surname = :surname,
						date_of_birth = :date_of_birth,
						NIC_number = :NIC_number,
						citizenship = :citizenship,
						cds_account = :cds_account";
		 
			// prepare the query
			$stmt2 = $conn->prepare($query2);
		 
			// sanitize
			$this->title=htmlspecialchars(strip_tags($_POST['title']));
			$this->initials=htmlspecialchars(strip_tags($_POST['initials']));
			$this->surname=htmlspecialchars(strip_tags($_POST['surname']));
			$this->date_of_birth=htmlspecialchars(strip_tags($_POST['date_of_birth']));
			$this->NIC_number=htmlspecialchars(strip_tags($_POST['NIC_number']));
			$this->citizenship=htmlspecialchars(strip_tags($_POST['citizenship']));
			$this->cds_account=htmlspecialchars(strip_tags($_POST['cds_account']));
						 
			// bind the values
			$stmt2->bindParam(':title', $this->title);
			$stmt2->bindParam(':initials', $this->initials);
			$stmt2->bindParam(':surname', $this->surname);
			$stmt2->bindParam(':date_of_birth', $this->date_of_birth);
			$stmt2->bindParam(':NIC_number', $this->NIC_number);
			$stmt2->bindParam(':citizenship', $this->citizenship);
			$stmt2->bindParam(':cds_account', $this->cds_account);
					
			// execute the query, also check if query was successful
			if($stmt->execute() && $stmt2->execute()){
				return true;
			}else{
				//$this->showError($stmt);
				return false;
			}
		}
		
		elseif(isset($_POST["company_name"]) && !empty($_POST["company_name"])) {
			// insert query for client Type Company
			$query2 = "INSERT INTO company
					SET
						company_name = :company_name,
						business_registration = :business_registration,
						date_of_incorporation = :date_of_incorporation,
						cds_account = :cds_account";
		 
			// prepare the query
			$stmt2 = $conn->prepare($query2);
		 
			// sanitize
			$this->company_name=htmlspecialchars(strip_tags($_POST['company_name']));
			$this->business_registration=htmlspecialchars(strip_tags($_POST['business_registration']));
			$this->date_of_incorporation=htmlspecialchars(strip_tags($_POST['date_of_incorporation']));
			$this->cds_account=htmlspecialchars(strip_tags($_POST['cds_account']));
						 
			// bind the values
			$stmt2->bindParam(':company_name', $this->company_name);
			$stmt2->bindParam(':business_registration', $this->business_registration);
			$stmt2->bindParam(':date_of_incorporation', $this->date_of_incorporation);
			$stmt2->bindParam(':cds_account', $this->cds_account);
					
			// execute the query, also check if query was successful
			if($stmt->execute() && $stmt2->execute()){
				return true;
			}else{
				//$this->showError($stmt);
				return false;
			}
		}
		
		else {
			// execute the query, also check if query was successful
			if($stmt->execute()){
				return true;
			}else{
				//$this->showError($stmt);
				return false;
			}	
		}
	 
	}

#########################################################################################
#########################################################################################

	//Client Update Function
	function clientUpdate(){
		include '../../config/dbconfig.php';
		//$this->updated_by=$_SESSION['login_id'];
		$this->updated_date=date('Y-m-d H:i:s');

		// Update query
		$query = "Update
					" . $this->table_name . "
				  SET
					address = :address,
					contact_number = :contact_number,
					email = :email,
					advisor_code = :advisor_code,
					updated_by = :updated_by,
					updated_date = :updated_date
				  WHERE 
				    cds_account = :cds_account";
	 
		// prepare the query
		$stmt = $conn->prepare($query);
	 
		// sanitize
		$this->cds_account=htmlspecialchars(strip_tags($_POST['cds_account']));
		$this->address=htmlspecialchars(strip_tags($_POST['address']));
		$this->contact_number=htmlspecialchars(strip_tags($_POST['contact_number']));
		$this->email=htmlspecialchars(strip_tags($_POST['email']));
		$this->advisor_code=htmlspecialchars(strip_tags($_POST['advisor_code']));
					 
		// bind the values
		$stmt->bindParam(':cds_account', $this->cds_account);
		$stmt->bindParam(':address', $this->address);
		$stmt->bindParam(':contact_number', $this->contact_number);
		$stmt->bindParam(':email', $this->email);
		$stmt->bindParam(':advisor_code', $this->advisor_code);
		$stmt->bindParam(':updated_by', $this->updated_by);
		$stmt->bindParam(':updated_date', $this->updated_date);
	
		if($_POST["client_type"] == "Individual") {
			// Update query for client Type Individual
			$query2 = "Update individual
					SET
						title = :title,
						initials = :initials,
						surname = :surname,
						date_of_birth = :date_of_birth,
						NIC_number = :NIC_number,
						citizenship = :citizenship
					WHERE 
						cds_account = :cds_account";
		 
			// prepare the query
			$stmt2 = $conn->prepare($query2);
		 
			// sanitize
			$this->title=htmlspecialchars(strip_tags($_POST['title']));
			$this->initials=htmlspecialchars(strip_tags($_POST['initials']));
			$this->surname=htmlspecialchars(strip_tags($_POST['surname']));
			$this->date_of_birth=htmlspecialchars(strip_tags($_POST['date_of_birth']));
			$this->NIC_number=htmlspecialchars(strip_tags($_POST['NIC_number']));
			$this->citizenship=htmlspecialchars(strip_tags($_POST['citizenship']));
			$this->cds_account=htmlspecialchars(strip_tags($_POST['cds_account']));
						 
			// bind the values
			$stmt2->bindParam(':title', $this->title);
			$stmt2->bindParam(':initials', $this->initials);
			$stmt2->bindParam(':surname', $this->surname);
			$stmt2->bindParam(':date_of_birth', $this->date_of_birth);
			$stmt2->bindParam(':NIC_number', $this->NIC_number);
			$stmt2->bindParam(':citizenship', $this->citizenship);
			$stmt2->bindParam(':cds_account', $this->cds_account);
			
			// execute the query, also check if query was successful
			if($stmt->execute() && $stmt2->execute()){
				return true;
			}else{
				//$this->showError($stmt);
				return false;
			}
		}
		
		elseif($_POST["client_type"] == "Company") {
			// Update query for client Type Company
			$query2 = "Update company
					SET
						company_name = :company_name,
						business_registration = :business_registration,
						date_of_incorporation = :date_of_incorporation
					WHERE 
						cds_account = :cds_account";
		 
			// prepare the query
			$stmt2 = $conn->prepare($query2);
		 
			// sanitize
			$this->company_name=htmlspecialchars(strip_tags($_POST['company_name']));
			$this->business_registration=htmlspecialchars(strip_tags($_POST['business_registration']));
			$this->date_of_incorporation=htmlspecialchars(strip_tags($_POST['date_of_incorporation']));
			$this->cds_account=htmlspecialchars(strip_tags($_POST['cds_account']));
						 
			// bind the values
			$stmt2->bindParam(':company_name', $this->company_name);
			$stmt2->bindParam(':business_registration', $this->business_registration);
			$stmt2->bindParam(':date_of_incorporation', $this->date_of_incorporation);
			$stmt2->bindParam(':cds_account', $this->cds_account);
					
			// execute the query, also check if query was successful
			if($stmt->execute() && $stmt2->execute()){
				return true;
			}else{
				//$this->showError($stmt);
				return false;
			}
		}
		
		else {
			// execute the query, also check if query was successful
			if($stmt->execute()){
				return true;
			}else{
				//$this->showError($stmt);
				return false;
			}	
		}
	 
	}

#########################################################################################
#########################################################################################
	
	//Client Tranfer Function
	function clientTrans(){
		include '../../config/dbconfig.php';
		//$this->updated_by=$_SESSION['login_id'];
		$this->updated_date=date('Y-m-d H:i:s');

		// Update query
		$query = "Update
					" . $this->table_name . "
				  SET
					status = :status,
					updated_by = :updated_by,
					updated_date = :updated_date
				  WHERE 
				    cds_account = :cds_account";
	 
		// prepare the query
		$stmt = $conn->prepare($query);
	 
		// sanitize
		$this->cds_account=htmlspecialchars(strip_tags($_POST['cds_account']));
		$this->status=htmlspecialchars(strip_tags($_POST['status']));
					 
		// bind the values
		$stmt->bindParam(':cds_account', $this->cds_account);
		$stmt->bindParam(':status', $this->status);
		$stmt->bindParam(':updated_by', $this->updated_by);
		$stmt->bindParam(':updated_date', $this->updated_date);
				
		// Insert query - Justification
		$this->transfer_status="1";
		
		$query2 = "INSERT INTO client_tranfer
				  SET
					cds_account = :cds_account,
					new_broker = :new_broker,
					client_trans_justification = :client_trans_justification,
				    transfer_status = :transfer_status";
	 
		// prepare the query
		$stmt2 = $conn->prepare($query2);
	 
		// sanitize
		$this->cds_account=htmlspecialchars(strip_tags($_POST['cds_account']));
		$this->new_broker=htmlspecialchars(strip_tags($_POST['new_broker']));
		$this->client_trans_justification=htmlspecialchars(strip_tags($_POST['client_trans_justification']));
					 
		// bind the values
		$stmt2->bindParam(':cds_account', $this->cds_account);
		$stmt2->bindParam(':new_broker', $this->new_broker);
		$stmt2->bindParam(':client_trans_justification', $this->client_trans_justification);
		$stmt2->bindParam(':transfer_status', $this->transfer_status);
		
		
		// execute the query, also check if query was successful
		if($stmt->execute() && $stmt2->execute()){
			return true;
		}else{
			$this->showError($stmt);
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