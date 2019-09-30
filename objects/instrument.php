<?php
// 'Instrument' object
class Instrument{
 
    // database connection and table name
    private $table_name = "instrument";
	
	//Get Instrument details
	function instrumentViewCode(){
		include '../../config/dbconfig.php';
		
		// query to Get Instrument details
		$query = "SELECT company_code, sector, FORMAT(company_share_volume,0) AS 'Company Share Volume', 
					FORMAT(market_share_volume,0) AS 'Market Share Volume', weightage
				  FROM " . $this->table_name . "
				  WHERE instrument_id = ? AND status = '1'";

		// prepare the query
		$stmt = $conn->prepare($query);
		 // sanitize
		$this->instrument_id=htmlspecialchars(strip_tags($_POST['instrument_id']));
		// bind given Instrument Code value
		$stmt->bindParam(1, $_POST['instrument_id']);
		// execute the query
		$stmt->execute();
		// get number of rows
		$num = $stmt->rowCount();
		// if Instrument exists,
		if($num>0){
				// get record details / values
				$row = $stmt->fetchAll(PDO::FETCH_CLASS, 'Instrument');
				// return object
				return $row;
		}
	}
	
#########################################################################################
#########################################################################################

	//Get Instrument Holding Report
	function instrumentHolding(){
		include '../../config/dbconfig.php';
		
		// query to Get Instrument details
		$query = "SELECT instrument.instrument_id, instrument.sector, FORMAT(instrument.market_share_volume,0) AS 'Market Share Volume', weightage, 
					FORMAT(Sum(trades.trade_quantity),0) AS 'Broker Holding', FORMAT(((Sum(trades.trade_quantity)/instrument.market_share_volume)*100),2) AS '%'
				  FROM instrument, trades
				  WHERE instrument.instrument_id = trades.instrument_id AND instrument.status = '1' AND instrument.market_share_volume > 0 
				  GROUP BY instrument.instrument_id, instrument.sector, instrument.market_share_volume, instrument.weightage ";

		// prepare the query
		$stmt = $conn->prepare($query);
		// execute the query
		$stmt->execute();
		// get number of rows
		$num = $stmt->rowCount();
		// if Instrument exists,
		if($num>0){
				// get record details / values
				$row = $stmt->fetchAll(PDO::FETCH_CLASS, 'Instrument');
				// return object
				return $row;
		}
	}
	
#########################################################################################
#########################################################################################

// create new Instrument record
	function instrumentAdd(){
		include '../../config/dbconfig.php';
		//$this->added_by=$_SESSION['login_id'];
		$this->added_date=date('Y-m-d H:i:s');
		$this->status="1";

		// insert query
		$query = "INSERT INTO
					" . $this->table_name . "
				SET
					instrument_id = :instrument_id,
					instrument_name = :instrument_name,
					sector = :sector,
					ISIN_number = :ISIN_number,
					company_share_volume = :company_share_volume,
					weightage = :weightage,
					market_share_volume = :market_share_volume,
					company_code = :company_code,
					status = :status,
					added_by = :added_by,
					added_date = :added_date";
	 
		// prepare the query
		$stmt = $conn->prepare($query);
	 
		// sanitize
		$this->instrument_id=htmlspecialchars(strip_tags($_POST['instrument_id']));
		$this->instrument_name=htmlspecialchars(strip_tags($_POST['instrument_name']));
		$this->sector=htmlspecialchars(strip_tags($_POST['sector']));
		$this->ISIN_number=htmlspecialchars(strip_tags($_POST['ISIN_number']));
		$this->company_share_volume=htmlspecialchars(strip_tags($_POST['company_share_volume']));
		$this->weightage=htmlspecialchars(strip_tags($_POST['weightage']));
		$this->market_share_volume=htmlspecialchars(strip_tags($_POST['market_share_volume']));
		$this->company_code=htmlspecialchars(strip_tags($_POST['company_code']));
		
					 
		// bind the values
		
		$stmt->bindParam(':instrument_id', $this->instrument_id);
		$stmt->bindParam(':instrument_name', $this->instrument_name);
		$stmt->bindParam(':sector', $this->sector);
		$stmt->bindParam(':ISIN_number', $this->ISIN_number);
		$stmt->bindParam(':company_share_volume', $this->company_share_volume);
		$stmt->bindParam(':weightage', $this->weightage);
		$stmt->bindParam(':market_share_volume', $this->market_share_volume);
		$stmt->bindParam(':company_code', $this->company_code);
		$stmt->bindParam(':status', $this->status);
		$stmt->bindParam(':added_by', $this->added_by);
		$stmt->bindParam(':added_date', $this->added_date);
		
		if(isset($_POST["instrument_type"]) && !empty($_POST["instrument_type"])){
			// insert query for table Equity
			$query2 = "INSERT INTO equity
					SET
						instrument_id = :instrument_id,
						instrument_type = :instrument_type";
			// prepare the query
			$stmt2 = $conn->prepare($query2);
			// sanitize
			$this->instrument_id=htmlspecialchars(strip_tags($_POST['instrument_id']));
			$this->instrument_type=htmlspecialchars(strip_tags($_POST['instrument_type']));		 
			// bind the values
			$stmt2->bindParam(':instrument_id', $this->instrument_id);
			$stmt2->bindParam(':instrument_type', $this->instrument_type);

			// execute the query, also check if query was successful
			if($stmt->execute() && $stmt2->execute()){
				return true;
			}else{
				//$this->showError($stmt);
				//$this->showError($stmt2);
				return false;
			}
		}
		
		elseif(isset($_POST["maturity_date"]) && !empty($_POST["maturity_date"])){
			// insert query for table Debenture
			$query2 = "INSERT INTO equity
					SET
						instrument_id = :instrument_id,
						coupon_rate = :coupon_rate,
						maturity_date = :maturity_date";
			// prepare the query
			$stmt2 = $conn->prepare($query2);
			// sanitize
			$this->instrument_id=htmlspecialchars(strip_tags($_POST['instrument_id']));
			$this->coupon_rate=htmlspecialchars(strip_tags($_POST['coupon_rate']));
			$this->maturity_date=htmlspecialchars(strip_tags($_POST['maturity_date']));			
			// bind the values
			$stmt2->bindParam(':instrument_id', $this->instrument_id);
			$stmt2->bindParam(':coupon_rate', $this->coupon_rate);
			$stmt2->bindParam(':maturity_date', $this->maturity_date);
			// execute the query, also check if query was successful
			if($stmt->execute() && $stmt2->execute()){
				return true;
			}else{
				//$this->showError($stmt);
				//$this->showError($stmt2);
				return false;
			}
		}
		
		else{
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

// Instrument record Update	
	function instrumentUpdate(){
		include '../../config/dbconfig.php';
		//$this->updated_by=$_SESSION['login_id'];
		$this->updated_date=date('Y-m-d H:i:s');

		// update query
		$query = "UPDATE
					" . $this->table_name . "
				  SET
					company_code = :company_code,
					sector = :sector,
					company_share_volume = :company_share_volume,
					market_share_volume = :market_share_volume,
					status = :status,
					weightage = :weightage,
					updated_by = :updated_by,
					updated_date = :updated_date
				  WHERE
					instrument_id = :instrument_id";
	 
		// prepare the query
		$stmt = $conn->prepare($query);
	 
		// sanitize
		$this->company_code=htmlspecialchars(strip_tags($_POST['company_code']));
		$this->sector=htmlspecialchars(strip_tags($_POST['sector']));
		$this->company_share_volume=htmlspecialchars(strip_tags($_POST['company_share_volume']));
		$this->market_share_volume=htmlspecialchars(strip_tags($_POST['market_share_volume']));
		$this->status=htmlspecialchars(strip_tags($_POST['status']));
		$this->weightage=htmlspecialchars(strip_tags(!empty($_POST['weightage'])));
					 
		// bind the values
		$stmt->bindParam(':instrument_id', $_SESSION['instrument_id']);
		$stmt->bindParam(':company_code', $this->company_code);
		$stmt->bindParam(':sector', $this->sector);
		$stmt->bindParam(':company_share_volume', $this->company_share_volume);
		$stmt->bindParam(':market_share_volume', $this->market_share_volume);
		$stmt->bindParam(':status', $this->status);
		$stmt->bindParam(':weightage', $this->weightage);
		$stmt->bindParam(':updated_by', $this->updated_by);
		$stmt->bindParam(':updated_date', $this->updated_date);
				
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