<?php 
	include '../config/connection.php';

	if(isset($_GET['medicine_id'])){
		$medicineId = $_GET['medicine_id'];

	  	$query = "SELECT `id`, `packing` from `medicine_details` 
	  	where `medicine_id` = $medicineId;";

	  	$packings = '<option value="">Select Packing</option>';

	  	try {
	  		$stmt = $con->prepare($query);
	  		$stmt->execute();

	  		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
	  			 $packings = $packings.'<option value="'.$row['id'].'">'.$row['packing'].'</option>';
	  		}

	  	} catch(PDOException $ex) {
	  		echo $ex->getTraceAsString();
	  		exit;
	  	}

	  	echo $packings;
	}

	if(isset($_GET['patient_id_birth'])){
		$patient_id = $_GET['patient_id_birth'];

	  	$query = "SELECT * FROM patients WHERE id = '$patient_id';";

	  	

	  	try {
	  		$stmt = $con->prepare($query);
	  		$stmt->execute();

	  		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
	  			 $packings =$row['date_of_birth'];
	  		}

	  	} catch(PDOException $ex) {
	  		echo $ex->getTraceAsString();
	  		exit;
	  	}

	  	echo $packings;
	}

  	
?>