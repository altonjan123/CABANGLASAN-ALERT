<?php 

date_default_timezone_set("Asia/Manila");
$date = date("Y/m/d");

include './config/config.php';

function getGender222() {
	//do not use this function
	exit;
	$data = '<option value="">Select Gender</option>';
	$data = $data .'<option value="Male">Male</option>';
	$data = $data .'<option value="Female">Female</option>';
	$data = $data .'<option value="Other">Other</option>';

	return $data;
}

function getGender($gender = '') {
	$data = '<option value="">Select Gender</option>';
	
	$arr = array("Male", "Female", "Other");

	$i = 0;
	$size = sizeof($arr);

	for($i = 0; $i < $size; $i++) {
		if($gender == $arr[$i]) {
			$data = $data .'<option selected="selected" value="'.$arr[$i].'">'.$arr[$i].'</option>';
		} else {
		$data = $data .'<option value="'.$arr[$i].'">'.$arr[$i].'</option>';
		}
	}

	return $data;
}
function getAddress($Address = '') {
	$data = '<option value="">Select Barangay</option>';
	
	$arr = array("Anlogan", "Cabulohan", "Canangaan","Capinonan","Dalacutan","Freedom","Iba");

	$i = 0;
	$size = sizeof($arr);

	for($i = 0; $i < $size; $i++) {
		if($gender == $arr[$i]) {
			$data = $data .'<option selected="selected" value="'.$arr[$i].'">'.$arr[$i].'</option>';
		} else {
		$data = $data .'<option value="'.$arr[$i].'">'.$arr[$i].'</option>';
		}
	}

	return $data;
}


function getMedicines($con, $medicineId = 0) {

	$query = "select `id`, `medicine_name` from `medicines` 
	order by `medicine_name` asc;";

	$stmt = $con->prepare($query);
	try {
		$stmt->execute();

	} catch(PDOException $ex) {
		echo $ex->getTraceAsString();
		echo $ex->getMessage();
		exit;
	}

	$data = '<option value="">Select Medicine</option>';

	while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		if($medicineId == $row['id']) {
			$data = $data.'<option selected="selected" value="'.$row['id'].'">'.$row['medicine_name'].'</option>';

		} else {
		$data = $data.'<option value="'.$row['id'].'">'.$row['medicine_name'].'</option>';
		}
	}

	return $data;
	
}


function getPatients($con) {
$query = "select `id`, `patient_name`, `phone_number` 
from `patients` order by `patient_name` asc;";

	$stmt = $con->prepare($query);
	try {
		$stmt->execute();

	} catch(PDOException $ex) {
		echo $ex->getTraceAsString();
		echo $ex->getMessage();
		exit;
	}

	$data = '<option value="">Select Patient</option>';

	while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$data = $data.'<option value="'.$row['id'].'">'.$row['patient_name'].' ('.$row['phone_number'].')'.'</option>';
	}

	return $data;
}

function getPatients_by_id($id ,$conn, $tb_name){


	if($tb_name == "patients"){
		$sql = "SELECT * FROM `$tb_name` WHERE `id`='$id'";
	}

	if($tb_name == "vaccination"){
		$sql = "SELECT * FROM `$tb_name` WHERE `id`='$id'";
	}
	
	return $conn -> query($sql);
}

// this function can be use dynamically
function insert_data($tb_name, $data1, $data2, $data3, $data4, $data5, $data6, $data7, $data8, $data9, $data10, $data11, $data12, $data13, $data14, $data15, $data16, $data17, $data18, $data19, $conn){

	global $conn;

	if($tb_name == "new_prenatal"){

		$sql = "INSERT INTO `new_prenatal` (`patient_name`, `date_of_consultation`, `next_visit_date`, `date_of_birth`, `age`) VALUES(?, ?, ?, ?, ?)";
		
		$stmt = $conn->prepare($sql);
		$stmt->bind_param('sssss', $data1, $data2, $data3, $data4, $data5);
		return $stmt->execute();
	}


	if($tb_name == "new_prenatal_obscore"){
		$sql = "INSERT INTO `$tb_name` (`patient_name`, `gravida`, `para`, `term`, `preterm`, `abortion`, `living`) VALUES(?, ?, ?, ?, ?, ?, ?)";

		$stmt = $conn->prepare($sql);
		$stmt->bind_param('sssssss', $data1, $data2, $data3, $data4, $data5, $data6, $data7);

		return $stmt->execute();
	}

	if($tb_name == "new_prenatal_lpm"){
		$sql = "INSERT INTO `$tb_name` (`patient_name`, `month`, `day`, `year`, `age_of_gestation`, `number_of_prenatal_visit`, `medical_history`, `high_risk_pregnancy`, `services`, `blood_pressure`, `temperature`, `heart_rate`, `respiratory_rate`, `fundal_height`, `internal_examination`, `fundal_height2`, `leopolds_manuever`, `urinalysis_result`) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

		$stmt = $conn->prepare($sql);
		$stmt->bind_param('ssssssssssssssssss', $data1, $data2, $data3, $data4, $data5, $data6, $data7, $data8, $data9, $data10, $data11, $data12, $data13, $data14, $data15, $data16, $data17, $data18);
		
		return $stmt->execute();
	}

	if($tb_name == "new_prenatal_ttvs"){
		$sql = "INSERT INTO `$tb_name` (`patient_name`, `first_tt`, `sec_tt`, `third_tt`, `fourt_tt`, `fifth_tt`, `deworming_status`, `deworming_status2`, `date_given`, `vitamin_a_status`, `date_given2`, `calcium_supplement_status`, `date_given3`, `iron_supplemental_status`, `date_give4`, `folic_acid_supplemetal_status`, `date_given5`, `birth_plan`, `other_exammining_result`) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

		$stmt = $conn->prepare($sql);
		$stmt->bind_param('sssssssssssssssssss', $data1, $data2, $data3, $data4, $data5, $data6, $data7, $data8, $data9, $data10, $data11, $data12, $data13, $data14, $data15, $data16, $data17, $data18, $data19);
		
		return $stmt->execute();
	}
}


// this function can be use dynamically
function update_data($tb_name, $data1, $data2, $data3, $data4, $data5, $data6, $data7, $data8, $data9, $data10, $data11, $data12, $data13, $data14, $data15, $data16, $data17, $data18, $data19, $id){

	global $conn;

	if($tb_name == "new_prenatal"){

		$sql = "UPDATE `$tb_name` SET `patient_name` = '$data1', `date_of_consultation` = '$data2', `next_visit_date` = '$data3', `date_of_birth` = '$data4', `age` = '$data5' WHERE `id` = '$id'";
		return $conn->query($sql);
	}


	if($tb_name == "new_prenatal_obscore"){
		$sql = "UPDATE `$tb_name` SET `patient_name` = '$data1' , `gravida` = '$data2', `para` = '$data3', `term` = '$data4', `preterm` = '$data5', `abortion` = '$data6', `living` = '$data7' WHERE `id` = '$id'";
		return $conn->query($sql);
	}

	if($tb_name == "new_prenatal_lpm"){
		$sql = "UPDATE `$tb_name` SET `patient_name` = '$data1', `month` = '$data2', `day` = '$data3', `year` = '$data4', `age_of_gestation` = '$data5', `number_of_prenatal_visit` = '$data6', `medical_history` = '$data7', `high_risk_pregnancy` = '$data8', `services` = '$data9', `blood_pressure` = '$data10', `temperature` = '$data11', `heart_rate` = '$data12', `respiratory_rate` = '$data13', `fundal_height` = '$data14', `internal_examination` = '$data15', `fundal_height2` = '$data16', `leopolds_manuever` = '$data17', `urinalysis_result` = '$data18' WHERE `id` = '$id'";
		
		return $conn->query($sql);
	}

	if($tb_name == "new_prenatal_ttvs"){
		$sql = "UPDATE `$tb_name` SET `patient_name` = '$data1', `first_tt` = '$data2', `sec_tt` = '$data3', `third_tt` = '$data4', `fourt_tt` = '$data5', `fifth_tt` = '$data6', `deworming_status` = '$data7', `deworming_status2` = '$data8', `date_given` = '$data9', `vitamin_a_status` = '$data10', `date_given2` = '$data11', `calcium_supplement_status` = '$data12', `date_given3` = '$data13', `iron_supplemental_status` = '$data14', `date_give4` = '$data15', `folic_acid_supplemetal_status` = '$data16', `date_given5` = '$data17', `birth_plan` = '$data18', `other_exammining_result` = '$data19' WHERE `id` = '$id'";
			
		return $conn->query($sql);
	}
}


function getPatients_by_name($tb_name, $p_name, $conn){
	if($tb_name == "new_prenatal"){
		$sql = "SELECT * FROM `$tb_name` WHERE `patient_name` = '$p_name'";
	}

	if($tb_name == "new_prenatal_lpm"){
		$sql = "SELECT * FROM `$tb_name` WHERE `patient_name` = '$p_name'";
	}

	if($tb_name == "new_prenatal_obscore"){
		$sql = "SELECT * FROM `$tb_name` WHERE `patient_name` = '$p_name'";
	}

	if($tb_name == "new_prenatal_ttvs"){
		$sql = "SELECT * FROM `$tb_name` WHERE `patient_name` = '$p_name'";
	}

	return $conn->query($sql);
}


function getDateTextBox($label, $dateId) {

	$d = '<div class="col-lg-3 col-md-3 col-sm-4 col-xs-10">
                <div class="form-group">
                  <label>'.$label.'</label>
                  <div class="input-group rounded-0 date" 
                  id="" 
                  data-target-input="nearest">
                  <input type="text" class="form-control form-control-sm rounded-0 datetimepicker-input" data-toggle="datetimepicker" 
data-target="#'.$dateId.'" name="'.$dateId.'" id="'.$dateId.'" required="required" autocomplete="off"/>
                  <div class="input-group-append rounded-0" 
                  data-target="#'.$dateId.'" 
                  data-toggle="datetimepicker">
                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
              </div>
            </div>
          </div>';

          return $d;
}




function sms_send($sender,$number,$msg){


	$ch = curl_init();
	$parameters = array(
	    'apikey' => 'a61656a941875a02af6535da52cb3c98', //Your API KEY
	    'number' =>  $number,
	    'message' => $msg,
	    'sendername' => $sender,
	);
	curl_setopt( $ch, CURLOPT_URL,'https://semaphore.co/api/v4/messages' );
	curl_setopt( $ch, CURLOPT_POST, 1 );

	//Send the parameters set above with the request
	curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $parameters ) );

	// Receive response from server
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
	$output = curl_exec( $ch );
	curl_close ($ch);

	//Show the server response
	//echo $output;
}


function getPatients_number($con,$patient) {

$query = "SELECT `phone_number` 
from `patients` WHERE id='$patient';";

	$stmt = $con->prepare($query);
	try {
		$stmt->execute();

	} catch(PDOException $ex) {
		echo $ex->getTraceAsString();
		echo $ex->getMessage();
		exit;
	}

	while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$data = $row['phone_number'];
	}

	return $data;
}

?>
