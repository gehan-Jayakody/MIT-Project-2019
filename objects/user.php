<?php
// 'user' object
class User{
 
    // database connection and table name
    private $table_name = "user";
      
    // check if given user exist in the database
	function userExists(){	
		include '../../config/dbconfig.php';
		
		// query to check if user exists
		$query = "SELECT user_status 
				  FROM " . $this->table_name . "
				  WHERE login_name = ?
				  LIMIT 0,1";

		// prepare the query
		$stmt = $conn->prepare($query);
		// sanitize
		$this->login_name=htmlspecialchars(strip_tags($_POST['login_name']));
		// bind given user name value
		$stmt->bindParam(1, $this->login_name);
		// execute the query
		$stmt->execute();
		// get number of rows
		$num = $stmt->rowCount();
		// if user exists
		if($num>0){
			// return true because user exists in the database
			return true;
		}
		else{
			// return false if user does not exist in the database
			return false;
		}
	}

#########################################################################################
#########################################################################################

	function passwdConfirm(){
		include '../../config/dbconfig.php';
		
		// query to check if user exists
		$query = "SELECT password 
				  FROM " . $this->table_name . "
				  WHERE login_name = ?
				  LIMIT 0,1";

		// prepare the query
		$stmt = $conn->prepare($query);
		// sanitize
		$this->login_name=htmlspecialchars(strip_tags($_POST['login_name']));
		$this->old_password=htmlspecialchars(strip_tags($_POST['old_password']));
		// bind given user name value
		$stmt->bindParam(1, $this->login_name);
		// hash the plain password
		// execute the query
		$stmt->execute();
		$row = $stmt->fetchAll(PDO::FETCH_CLASS, 'User');
		$pass_hash = $row[0]->password;
		//Check for Password Match
		if(password_verify($this->old_password, $pass_hash)){
			// return true because password match in the database
			return true;
		}
		else{
			// return false if password does not match in the database
			return false;
		}
		
		
	}

#########################################################################################
#########################################################################################

	function passwdVerfy(){
		include '../../config/dbconfig.php';
		
		// query to check if user exists
		$query = "SELECT password 
				  FROM " . $this->table_name . "
				  WHERE login_name = ?
				  LIMIT 0,1";

		// prepare the query
		$stmt = $conn->prepare($query);
		// sanitize
		$this->login_name=htmlspecialchars(strip_tags($_POST['login_name']));
		$this->password=htmlspecialchars(strip_tags($_POST['password']));
		// bind given user name value
		$stmt->bindParam(1, $this->login_name);
		// hash the plain password
		// execute the query
		$stmt->execute();
		$row = $stmt->fetchAll(PDO::FETCH_CLASS, 'User');
		$pass_hash = $row[0]->password;
		//Check for Password Match
		if(password_verify($this->password, $pass_hash)){
			// return true because password match in the database
			return true;
		}
		else{
			// return false if password does not match in the database
			return false;
		}
		
		
	}
#########################################################################################
#########################################################################################

    // check if given user exist in the database
	function userDetails(){	
		include '../../config/dbconfig.php';
		
		// query to check if user exists
		$query = "SELECT * 
				  FROM " . $this->table_name . "
				  WHERE login_name = ?
				  LIMIT 0,1";

		// prepare the query
		$stmt = $conn->prepare($query);
		// sanitize
		$this->login_name=htmlspecialchars(strip_tags($_POST['login_name']));
		// bind given user name value
		$stmt->bindParam(1, $this->login_name);
		// execute the query
		$stmt->execute();
		// get number of rows
		$num = $stmt->rowCount();
		// if user exists
		if($num>0){
			// get record details values
			$row = $stmt->fetchAll(PDO::FETCH_CLASS, 'User');
			return $row;
		}
		else{
			//$this->showError($stmt);
			return false;
		}
	}


#########################################################################################
#########################################################################################

    // Get the Registerd Advisor Codes
	function advisorCode(){	
		include '../../config/dbconfig.php';
		
		// query to check if user exists
		$query = "SELECT advisor_code, login_name
				  FROM user_advisor";

		// prepare the query
		$stmt = $conn->prepare($query);
		// execute the query
		$stmt->execute();
		// get number of rows
		$num = $stmt->rowCount();
		// if user exists
		if($num>0){
			// get record details values
			$row = $stmt->fetchAll(PDO::FETCH_CLASS, 'User');
			return $row;
		}
	}

	
#########################################################################################
#########################################################################################

	function passwdReset(){
		include '../../config/dbconfig.php';
		//$this->updated_by=$_SESSION['login_id'];
		$this->updated_date=date('Y-m-d H:i:s');
		
		// Update query for client Type Individual
		$query = "Update
				   " . $this->table_name . "
				SET
					password = :password,
					updated_by = :updated_by,
					updated_date = :updated_date
				WHERE 
					login_name = :login_name";
	 
		// prepare the query
		$stmt = $conn->prepare($query);
	 
		// sanitize
		$this->password=htmlspecialchars(strip_tags($_POST['password']));
		$this->login_name=htmlspecialchars(strip_tags($_POST['login_name']));
					 
		// bind the values
		$stmt->bindParam(':login_name', $this->login_name);
		$stmt->bindParam(':updated_by', $this->updated_by);
		$stmt->bindParam(':updated_date', $this->updated_date);
		
		// hash the password before saving to database
		$password_hash = password_hash($this->password, PASSWORD_BCRYPT);
		$stmt->bindParam(':password', $password_hash);
		
		// execute the query, also check if query was successful
		if($stmt->execute()){
			return true;
		}else{
			//$this->showError($stmt);
			return false;
		}
	}
	
#########################################################################################
#########################################################################################

// create new user record
	function createUser(){
		include '../../config/dbconfig.php';
		//$this->added_by=$_SESSION['login_id'];
		$this->added_date=date('Y-m-d H:i:s');
		$this->user_status="1";
	 
		// insert query
		$query = "INSERT INTO
					" . $this->table_name . "
				SET
					login_name = :login_name,
					password = :password,
					title = :title,
					initials = :initials,
					surname = :surname,
					name_denoted_by = :name_denoted_by,
					user_role = :user_role,
					email = :email,
					user_status = :user_status,
					added_by = :added_by,
					added_date = :added_date";
	 
		// prepare the query
		$stmt = $conn->prepare($query);
	 
		// sanitize
		$this->login_name=htmlspecialchars(strip_tags($_POST['login_name']));
		$this->password=htmlspecialchars(strip_tags($_POST['password']));
		$this->title=htmlspecialchars(strip_tags($_POST['title']));
		$this->initials=htmlspecialchars(strip_tags($_POST['initials']));
		$this->surname=htmlspecialchars(strip_tags($_POST['surname']));
		$this->name_denoted_by=htmlspecialchars(strip_tags($_POST['name_denoted_by']));
		$this->user_role=htmlspecialchars(strip_tags($_POST['user_role']));
		$this->email=htmlspecialchars(strip_tags($_POST['email']));
	 
		// bind the values
		$stmt->bindParam(':login_name', $this->login_name);
		$stmt->bindParam(':title', $this->title);
		$stmt->bindParam(':initials', $this->initials);
		$stmt->bindParam(':surname', $this->surname);
		$stmt->bindParam(':name_denoted_by', $this->name_denoted_by);
		$stmt->bindParam(':user_role', $this->user_role);
		$stmt->bindParam(':email', $this->email);
		$stmt->bindParam(':user_status', $this->user_status);
		$stmt->bindParam(':added_by', $this->added_by);
		$stmt->bindParam(':added_date', $this->added_date);
		
		// hash the password before saving to database
		$password_hash = password_hash($this->password, PASSWORD_BCRYPT);
		$stmt->bindParam(':password', $password_hash);

		if($_POST['user_role'] == "120"){
			// insert query for table - Advisor
			$query2 = "INSERT INTO user_advisor
					SET
						advisor_code = :advisor_code,
						commission_rate = :commission_rate,
						login_name = :login_name";
		 
			// prepare the query
			$stmt2 = $conn->prepare($query2);
		 
			// sanitize
			$this->advisor_code=htmlspecialchars(strip_tags($_POST['advisor_code']));
			$this->commission_rate=htmlspecialchars(strip_tags($_POST['commission_rate']));
			$this->login_name=htmlspecialchars(strip_tags($_POST['login_name']));
		 
			// bind the values
			$stmt2->bindParam(':advisor_code', $this->advisor_code);
			$stmt2->bindParam(':commission_rate', $this->commission_rate);
			$stmt2->bindParam(':login_name', $this->login_name);
			
			// execute the query, also check if query was successful
			if($stmt->execute() && $stmt2->execute()){
				return true;
			}else{
				$this->showError($stmt);
				$this->showError($stmt2);
				return false;
			}		
		}
		
		elseif($_POST['user_role'] == "130"){
			// insert query for table - Advisor
			$query2 = "INSERT INTO user_backoffice
					SET
						backoffice_code = :backoffice_code,
						login_name = :login_name";
		 
			// prepare the query
			$stmt2 = $conn->prepare($query2);
		 
			// sanitize
			$this->backoffice_code=htmlspecialchars(strip_tags($_POST['backoffice_code']));
			$this->login_name=htmlspecialchars(strip_tags($_POST['login_name']));
		 
			// bind the values
			$stmt2->bindParam(':backoffice_code', $this->backoffice_code);
			$stmt2->bindParam(':login_name', $this->login_name);
			
			// execute the query, also check if query was successful
			if($stmt->execute() && $stmt2->execute()){
				return true;
			}else{
				$this->showError($stmt);
				$this->showError($stmt2);
				return false;
			}
		}
		
		else{
			// execute the query, also check if query was successful
			if($stmt->execute()){
				return true;
			}else{
				$this->showError($stmt);
				return false;
			}
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