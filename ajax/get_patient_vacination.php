<?php 
	include '../config/connection.php';

  	$patientId = $_GET['patient_id'];

    $data = '';
    /**
    medicines (medicine_name)
    medicine_details (packing)
    patient_visits (visit_date, disease)
    patient_medication_history (quantity, dosage)

    */
    $query = "SELECT * FROM patients WHERE id='$patientId'";
    $stmt = $con->prepare($query);
    $stmt->execute();
    $r = $stmt->fetch(PDO::FETCH_ASSOC);

    echo$name=$r['patient_name'];


    $query = "SELECT * FROM vaccination WHERE patient_id='$name'";

    try {
      $stmt = $con->prepare($query);
      $stmt->execute();

      $i = 0;
      while($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $i++;
        $data = $data.'<tr>';
        
        
        $data = $data.'<td class="px-2 py-1 align-middle">'.date("M d, Y", strtotime($r['date_of_birth'])).'</td>';
        $data = $data.'<td class="px-2 py-1 align-middle">'.$r['age'].'</td>';
        $data = $data.'<td class="px-2 py-1 align-middle">'.date("M d, Y", strtotime($r['date_of_vaccination'])).'</td>';
        $data = $data.'<td class="px-2 py-1 align-middle">'.date("M d, Y", strtotime($r['date_of_next_vaccination'])).'</td>';
        $data = $data.'<td class="px-2 py-1 align-middle text-right">'.$r['type_of_vaccine'].'</td>';
        $data = $data.'<td class="px-2 py-1 align-middle text-right">'.$r['brand'].'</td>';
        $data = $data.'<td class="px-2 py-1 align-middle text-right">'.$r['no_of_dose'].'</td>';
        

        $data = $data.'</tr>';
      }

    } catch(PDOException $ex) {
      echo $ex->getTraceAsString();
      echo $ex->getMessage();
      exit;
    }

  	echo $data;
?>