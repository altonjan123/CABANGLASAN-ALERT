<?php
require __DIR__ . '/vendor/autoload.php';

use Twilio\Rest\Client;

include './config/connection.php';
include './common_service/common_functions.php';
include './config/config.php';

if (isset($_GET['id'])) {
  $id = $_GET['id'];

  // get p_name from prenatal table
  $prenatal = "SELECT * FROM `new_prenatal` WHERE `id` = '$id'";
  $prenatal = $conn->query($prenatal);
  $prenatal = $prenatal->fetch_assoc();

  $patient_name = $prenatal['patient_name'];

  $date_of_consultation = $prenatal['date_of_consultation'];
  $next_visit_date = $prenatal['next_visit_date'];
  $date_of_birth = $prenatal['date_of_birth'];
  $age = $prenatal['age'];

  // OB Score Table
  $ob_score = "SELECT * FROM `new_prenatal_obscore` WHERE `id` = '$id '";
  $ob_score = $conn->query($ob_score);
  $ob_score = $ob_score->fetch_assoc();

  $gravida = $ob_score['gravida'];
  $para = $ob_score['para'];
  $term = $ob_score['term'];
  $preterm = $ob_score['preterm'];
  $abortion = $ob_score['abortion'];
  $living = $ob_score['living'];


  // OB Score Table
  $lmp = "SELECT * FROM `new_prenatal_lpm` WHERE `id` = '$id '";
  $lmp = $conn->query($lmp);
  $lmp = $lmp->fetch_assoc();

  // new_prenatal_lpm
  $month = $lmp['month'];
  $day = $lmp['day'];
  $year = $lmp['year'];
  $age_of_gestation = $lmp['age_of_gestation'];
  $number_of_prenatal_visit = $lmp['number_of_prenatal_visit'];
  $medical_history = $lmp['medical_history'];
  $high_risk_pregnancy = $lmp['high_risk_pregnancy'];
  $services = $lmp['services'];
  $blood_pressure = $lmp['blood_pressure'];
  $temperature = $lmp['temperature'];
  $heart_rate = $lmp['heart_rate'];
  $respiratory_rate = $lmp['respiratory_rate'];
  $fundal_height = $lmp['fundal_height'];
  $internal_examination = $lmp['internal_examination'];
  $fundal_height2 = $lmp['fundal_height2'];
  $leopolds_manuever = $lmp['leopolds_manuever'];
  $urinalysis_result = $lmp['urinalysis_result'];


  // TTVS
  $ttvs = "SELECT * FROM `new_prenatal_ttvs` WHERE `id` = '$id '";
  $ttvs = $conn->query($ttvs);
  $ttvs = $ttvs->fetch_assoc();

  // ttvs
  $first_tt = $ttvs['first_tt'];
  $second_tt = $ttvs['sec_tt'];
  $third_tt = $ttvs['third_tt'];
  $fourt_tt = $ttvs['fourt_tt'];
  $fifth_tt = $ttvs['fifth_tt'];
  $deworming_status = $ttvs['deworming_status'];
  $deworming_status2 = $ttvs['deworming_status2'];
  $date_given = $ttvs['date_given'];
  $vitamin_a_status = $ttvs['vitamin_a_status'];
  $date_given2 = $ttvs['date_given2'];
  $calcium_supplement_status = $ttvs['calcium_supplement_status'];
  $date_given3 = $ttvs['date_given3'];
  $iron_supplement_status = $ttvs['iron_supplemental_status'];
  $date_given4 = $ttvs['date_give4'];
  $folic_acid_supplement_status = $ttvs['folic_acid_supplemetal_status'];
  $date_given5 = $ttvs['date_given5'];
  $birth_plan = $ttvs['birth_plan'];
  $other_examinning_result = $ttvs['other_exammining_result'];
} else {
  header("location:prenatal.php");
  exit;
}

$message = '';

if (isset($_POST['submit'])) {

  // new prenatal data
  $id = $_POST['id'];
  $patientId = $_POST['patient_id']; //name
  $date_of_consultation = $_POST['date_of_consultation'];
  $next_visit_date = $_POST['next_visit_date'];
  $date_of_birth = $_POST['date_of_birth'];
  $age = $_POST['age'];


  // new_prenatal_obscore
  $gravida = $_POST['gravida'];
  $para = $_POST['para'];
  $term = $_POST['term'];
  $preterm = $_POST['preterm'];
  $abortion = $_POST['abortion'];
  $living = $_POST['living'];




  // new_prenatal_lpm
  $month = $_POST['month'];
  $day = $_POST['day'];
  $year = $_POST['year'];
  $age_of_gestation = $_POST['age_of_gestation'];
  $num_of_prenatal_visit = $_POST['num_of_prenatal_visit'];
  $medical_history = $_POST['medical_history'];
  $high_risk_pregnancy = $_POST['high_risk_pregnancy'];
  $services = $_POST['services'];
  $bp = $_POST['bp'];
  $temperature = $_POST['temperature'];
  $heart_rate = $_POST['heart_rate'];
  $respiratory_rate = $_POST['respiratory_rate'];
  $fundal_height = $_POST['fundal_height'];
  $internal_exam = $_POST['internal_exam'];
  $fundal_height2 = $_POST['fundal_height2'];
  $leopolds_manuever = $_POST['leopolds_manuever'];
  $urinalysis_result = $_POST['urinalysis_result'];



  // ttvs
  $first_tt = $_POST['first_tt'];
  $second_tt = $_POST['second_tt'];
  $third_tt = $_POST['third_tt'];
  $fourth_tt = $_POST['fourth_tt'];
  $fifth_tt = $_POST['fifth_tt'];
  $deworm1 = $_POST['deworm1'];
  $deworm2 = $_POST['deworm2'];
  $date_given1 = $_POST['date_given1'];
  $vit_a_stats = $_POST['vit_a_stats'];
  $date_given2 = $_POST['date_given2'];
  $cal_sup_stats = $_POST['cal_sup_stats'];
  $date_given3 = $_POST['date_given3'];
  $iron_sup_stats = $_POST['iron_sup_stats'];
  $date_given4 = $_POST['date_given4'];
  $folic_acid_sup_stats = $_POST['folic_acid_sup_stats'];
  $date_given5 = $_POST['date_given5'];
  $birth_plan = $_POST['birth_plan'];
  $other_exam_res = $_POST['other_exam_res'];

  // check for empty fields 1t ime general error handling
  // check for empty field to new_prenatal, obscore, lpm, ttvs
  if ($patientId == NULL || $date_of_consultation == NULL || $next_visit_date == NULL || $date_of_birth == NULL || $age == NULL || $gravida == NULL || $para == NULL || $term == NULL || $preterm == NULL || $abortion == NULL || $living == NULL || $month == NULL || $day == NULL || $year == NULL || $age_of_gestation == NULL || $num_of_prenatal_visit == NULL || $medical_history == NULL || $high_risk_pregnancy == NULL || $services == NULL || $bp == NULL || $temperature == NULL || $heart_rate == NULL || $respiratory_rate == NULL || $fundal_height == NULL || $internal_exam == NULL || $fundal_height2 == NULL || $leopolds_manuever == NULL || $urinalysis_result == NULL || $first_tt == NULL || $second_tt == NULL || $third_tt == NULL || $fourth_tt == NULL || $fifth_tt == NULL || $deworm1 == NULL || $deworm2 == NULL || $date_given1 == NULL || $date_given2 == NULL || $date_given3 == NULL || $date_given4 == NULL || $date_given5 == NULL || $vit_a_stats == NULL || $cal_sup_stats == NULL || $iron_sup_stats == NULL || $folic_acid_sup_stats == NULL || $birth_plan == NULL || $other_exam_res == NULL) {
    $message = 'Empty Fields Error.';
    header("Location:congratulation.php?goto_page=prenatal.php&message=$message");
    exit;
  } else {

    // Update Prenatal table 
    $update_prenatal =  update_data("new_prenatal", $patientId, $date_of_consultation, $next_visit_date, $date_of_birth, $age, $data6, $data7, $data8, $data9, $data10, $data11, $data12, $data13, $data14, $data15, $data16, $data17, $data18, $data19, $id);

    // Update OB Score
    $update_obscore =  update_data("new_prenatal_obscore", $patientId, $gravida, $para, $term, $preterm, $abortion, $living, $data8, $data9, $data10, $data11, $data12, $data13, $data14, $data15, $data16, $data17, $data18, $data19, $id);

    // Update LMP
    // updating lmp table
    $update_lmp =  update_data("new_prenatal_lpm", $patientId, $month, $day, $year, $age_of_gestation, $num_of_prenatal_visit, $medical_history, $high_risk_pregnancy, $services, $bp, $temperature, $heart_rate, $respiratory_rate, $fundal_height, $internal_exam, $fundal_height2, $leopolds_manuever, $urinalysis_result, $data19, $id);

    // Update TTVS

    // updating lmp table
    $update_ttvs =  update_data("new_prenatal_ttvs", $patientId, $first_tt, $second_tt, $third_tt, $fourth_tt, $fifth_tt, $deworm1, $deworm2, $date_given1, $vit_a_stats, $date_given2, $cal_sup_stats, $date_given3, $iron_sup_stats, $date_given4, $folic_acid_sup_stats, $date_given5, $birth_plan, $other_exam_res, $id);

    // check if the all returns are equal to true
    if ($update_prenatal  == TRUE && $update_obscore  == TRUE && $update_lmp  == TRUE && $update_ttvs  == TRUE) {
      // display success message
      $message = 'All information has been successfully updated';
      header("Location:congratulation.php?goto_page=prenatal.php&message=$message");
      exit;
    } else {
      $message = 'Failed to update data to the database';
      header("Location:congratulation.php?goto_page=prenatal.php&message=$message");
      exit;
    }
  }
}
$patients = getPatients($con);
$medicines = getMedicines($con);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include './config/site_css_links.php' ?>

  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <title>Prenatal | Edit Prenatal</title>

</head>

<body class="hold-transition sidebar-mini dark-mode layout-fixed layout-navbar-fixed">
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Navbar -->

    <?php include './config/header.php';
    include './config/sidebar.php'; ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Prenatal Individual Record</h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">

        <!-- Default box -->
        <div class="card card-outline card-primary rounded-0 shadow">
          <div class="card-header">
            <h3 class="card-title">Edit Prenatal Record</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <!-- best practices-->
            <form method="post">
              <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                  <label>Select Patient</label>
                  <select id="patient_id" name="patient_id" class="form-control form-control-sm rounded-0" required="required">
                    <option value="<?= $patient_name ?>"><?= $patient_name ?></option>
                  </select>
                </div>

                <input type="hidden" name="id" value="<?= $id ?>">
                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Date of consultation</label>
                  <input type="text" class="form-control form-control-sm rounded-0" name="date_of_consultation" required="required" value="<?= $date_of_consultation ?>" />
                </div>


                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Next Visit Date</label>
                  <input type="text" class="form-control form-control-sm rounded-0" name="next_visit_date" required="required" value="<?= $next_visit_date ?>" />
                </div>


                <div class="clearfix">&nbsp;</div>

                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Date of birth</label>
                  <input type="text" id="bp" class="form-control form-control-sm rounded-0" name="date_of_birth" required="required" value="<?= $date_of_birth ?>" />
                </div>

                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Age</label>
                  <input id="weight" name="age" class="form-control form-control-sm rounded-0" required="required" value="<?= $age ?>" />
                </div>
              </div>

              <div class="col-md-12">
                <hr />
              </div>


              <div class="clearfix">&nbsp;</div>
              <h5>OB score</h5>

              <div class="row">

                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Gravida</label>
                  <input id="quantity" class="form-control form-control-sm rounded-0" name="gravida" value="<?= $gravida ?>" />
                </div>

                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Para</label>
                  <input id="dosage" class="form-control form-control-sm rounded-0" name="para" value="<?= $para ?>" />
                </div>

                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Term</label>
                  <input id="dosage" class="form-control form-control-sm rounded-0" name="term" value="<?= $term ?>" />
                </div>

                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Preterm</label>
                  <input id="dosage" class="form-control form-control-sm rounded-0" name="preterm" value="<?= $preterm ?>" />
                </div>

                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Abortion</label>
                  <input id="dosage" class="form-control form-control-sm rounded-0" name="abortion" value="<?= $abortion ?>" />
                </div>

                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Living</label>
                  <input id="dosage" class="form-control form-control-sm rounded-0" name="living" value="<?= $living ?>" />
                </div>
              </div>
              <div class="col-md-12">
                <hr />
              </div>
              <div class="clearfix">&nbsp;</div>
              <h5>LAST MENSTRUAL PERIOD (LMP)</h5>

              <div class="row">

                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Month</label><br><br>
                  <input id="quantity" class="form-control form-control-sm rounded-0" name="month" value="<?= $month ?>" />
                </div>

                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Day</label><br><br>
                  <input id="dosage" class="form-control form-control-sm rounded-0" name="day" value="<?= $day ?>" />
                </div>

                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>year</label><br><br>
                  <input id="dosage" class="form-control form-control-sm rounded-0" name="year" value="<?= $year ?>" />
                </div>

                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Age of Gestation</label><br><br>
                  <input id="dosage" class="form-control form-control-sm rounded-0" name="age_of_gestation" value="<?= $age_of_gestation ?>" />
                </div>

                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Number of Prenatal Visit: </label>
                  <input id="dosage" class="form-control form-control-sm rounded-0" name="num_of_prenatal_visit" value="<?= $number_of_prenatal_visit ?>" />
                </div>

                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Medical History:</label><br><br>
                  <input id="dosage" class="form-control form-control-sm rounded-0" name="medical_history" value="<?= $medical_history ?>" />
                </div>

                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>High Risk Pregnancy: (DDL:YES or NO)</label>
                  <input id="dosage" class="form-control form-control-sm rounded-0" name="high_risk_pregnancy" value="<?= $high_risk_pregnancy ?>" />
                </div>

                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>SERVICES:</label><br><br>
                  <input id="dosage" class="form-control form-control-sm rounded-0" name="services" value="<?= $services ?>" />
                </div>

                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Blood Pressure:</label><br><br>
                  <input id="dosage" class="form-control form-control-sm rounded-0" name="bp" value="<?= $blood_pressure ?>" />
                </div>


                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Temperature:</label><br><br>
                  <input id="dosage" class="form-control form-control-sm rounded-0" name="temperature" value="<?= $temperature ?>" />
                </div>

                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Heart Rate:</label><br><br>
                  <input id="dosage" class="form-control form-control-sm rounded-0" name="heart_rate" value="<?= $heart_rate ?>" />
                </div>


                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Respiratory Rate:</label><br><br>
                  <input id="dosage" class="form-control form-control-sm rounded-0" name="respiratory_rate" value="<?= $respiratory_rate ?>" />
                </div>

                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Fundal Height (cm):</label><br><br>
                  <input id="dosage" class="form-control form-control-sm rounded-0" name="fundal_height" value="<?= $fundal_height ?>" />
                </div>

                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Internal Examination:</label><br><br>
                  <input id="dosage" class="form-control form-control-sm rounded-0" name="internal_exam" value="<?= $internal_examination ?>" />
                </div>

                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Fundal Height (cm):</label><br><br>
                  <input id="dosage" class="form-control form-control-sm rounded-0" name="fundal_height2" value="<?= $fundal_height2 ?>" />
                </div>

                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Leopold’s Maneuver:</label><br><br>
                  <input id="dosage" class="form-control form-control-sm rounded-0" name="leopolds_manuever" value="<?= $leopolds_manuever ?>" />
                </div>

                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Urinalysis Results:</label><br><br>
                  <input id="dosage" class="form-control form-control-sm rounded-0" name="urinalysis_result" value="<?= $urinalysis_result ?>" />
                </div>
              </div>
              <div class="col-md-12">
                <hr />
              </div>
              <div class="clearfix">&nbsp;</div>
              <h5>Tetanus Toxoid Vaccine Status</h5>

              <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>First TT: </label>
                  <input type="text" id="quantity" class="form-control form-control-sm rounded-0" name="first_tt" value="<?= $first_tt ?>" />
                </div>

                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Second TT</label>
                  <input type="text" id="dosage" class="form-control form-control-sm rounded-0" name="second_tt" value="<?= $second_tt ?>" />
                </div>

                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Third TT:</label>
                  <input type="text" id="dosage" class="form-control form-control-sm rounded-0" name="third_tt" value="<?= $third_tt ?>" />
                </div>

                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Fourth TT:</label>
                  <input type="text" id="dosage" class="form-control form-control-sm rounded-0" name="fourth_tt" value="<?= $fourt_tt ?>" />
                </div>

                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Fifth TT:</label>
                  <input type="text" id="dosage" class="form-control form-control-sm rounded-0" name="fifth_tt" value="<?= $fifth_tt ?>" />
                </div>

                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Deworming Status:</label>
                  <input id="dosage" class="form-control form-control-sm rounded-0" name="deworm1" value="<?= $deworming_status ?>" />
                </div>


                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Deworming Status:</label>
                  <input id="dosage" class="form-control form-control-sm rounded-0" name="deworm2" value="<?= $deworming_status2 ?>" />
                </div>

                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Date Given:</label>
                  <input type="text" id="dosage" class="form-control form-control-sm rounded-0" name="date_given1" value="<?= $date_given ?>" />
                </div>


                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Vitamin A Status:</label>
                  <input id="dosage" class="form-control form-control-sm rounded-0" name="vit_a_stats" value="<?= $vitamin_a_status ?>" />
                </div>

                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Date Given:</label>
                  <input type="text" id="dosage" class="form-control form-control-sm rounded-0" name="date_given2" value="<?= $date_given2 ?>" />
                </div>


                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Calcium Supplementation Status:</label>
                  <input id="dosage" class="form-control form-control-sm rounded-0" name="cal_sup_stats" value="<?= $calcium_supplement_status ?>" />
                </div>
                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Date Given:</label>
                  <input type="text" id="dosage" class="form-control form-control-sm rounded-0" name="date_given3" value="<?= $date_given3 ?>" />
                </div>
                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Iron Supplementation Status:</label>
                  <input id="dosage" class="form-control form-control-sm rounded-0" name="iron_sup_stats" value="<?= $iron_supplement_status ?>" />
                </div>
                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Date Given:</label>
                  <input type="text" id="dosage" class="form-control form-control-sm rounded-0" name="date_given4" value="<?= $date_given4 ?>" />
                </div>
                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Folic Acid Supplementation Status: Deworming Status:</label>
                  <input id="dosage" class="form-control form-control-sm rounded-0" name="folic_acid_sup_stats" value="<?= $folic_acid_supplement_status ?>" />
                </div>
                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Date Given:</label>
                  <input type="text" id="dosage" class="form-control form-control-sm rounded-0" name="date_given5" value="<?= $date_given5 ?>" />
                </div>
                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Birth Plan:</label>
                  <input id="dosage" class="form-control form-control-sm rounded-0" name="birth_plan" value="<?= $birth_plan ?>" />
                </div>
                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Other Examining Results/Observation and Remarks: </label>
                  <input id="dosage" class="form-control form-control-sm rounded-0" name="other_exam_res" value="<?= $other_examinning_result ?>" />
                </div>
              </div>
              <div class="col-md-12">
                <hr />
              </div>

              <div class="clearfix">&nbsp;</div>
              <div class="row">
                <div class="col-md-10">&nbsp;</div>
                <div class="col-md-2">
                  <button type="submit" id="submit" name="submit" class="btn btn-primary btn-sm btn-flat btn-block">Save</button>
                </div>
              </div>
            </form>

          </div>

        </div>

      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <?php include './config/footer.php';
    $message = '';
    if (isset($_GET['message'])) {
      $message = $_GET['message'];
    }
    ?>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <?php include './config/site_js_links.php';
  ?>

  <script src="plugins/moment/moment.min.js"></script>
  <script src="plugins/daterangepicker/daterangepicker.js"></script>
  <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

  <script>
    var serial = 1;
    showMenuSelected("#mnu_patients", "#mi_new_prescription");

    var message = '<?php echo $message; ?>';

    if (message !== '') {
      showCustomMessage(message);
    }


    $(document).ready(function() {

      $('#medication_list').find('td').addClass("px-2 py-1 align-middle")
      $('#medication_list').find('th').addClass("p-1 align-middle")
      $('#visit_date, #next_visit_date').datetimepicker({
        format: 'L'
      });


      $("#medicine").change(function() {

        // var medicineId = $("#medicine").val();
        var medicineId = $(this).val();

        if (medicineId !== '') {
          $.ajax({
            url: "ajax/get_packings.php",
            type: 'GET',
            data: {
              'medicine_id': medicineId
            },
            cache: false,
            async: false,
            success: function(data, status, xhr) {
              $("#packing").html(data);
            },
            error: function(jqXhr, textStatus, errorMessage) {
              showCustomMessage(errorMessage);
            }
          });
        }
      });


      $("#add_to_list").click(function() {
        var medicineId = $("#medicine").val();
        var medicineName = $("#medicine option:selected").text();

        var medicineDetailId = $("#packing").val();
        var packing = $("#packing option:selected").text();

        var quantity = $("#quantity").val().trim();
        var dosage = $("#dosage").val().trim();

        var oldData = $("#current_medicines_list").html();

        if (medicineName !== '' && packing !== '' && quantity !== '' && dosage !== '') {
          var inputs = '';
          inputs = inputs + '<input type="hidden" name="medicineDetailIds[]" value="' + medicineDetailId +
            '" />';
          inputs = inputs + '<input type="hidden" name="quantities[]" value="' + quantity + '" />';
          inputs = inputs + '<input type="hidden" name="dosages[]" value="' + dosage + '" />';


          var tr = '<tr>';
          tr = tr + '<td class="px-2 py-1 align-middle">' + serial + '</td>';
          tr = tr + '<td class="px-2 py-1 align-middle">' + medicineName + '</td>';
          tr = tr + '<td class="px-2 py-1 align-middle">' + packing + '</td>';
          tr = tr + '<td class="px-2 py-1 align-middle">' + quantity + '</td>';
          tr = tr + '<td class="px-2 py-1 align-middle">' + dosage + inputs + '</td>';

          tr = tr +
            '<td class="px-2 py-1 align-middle text-center"><button type="button" class="btn btn-outline-danger btn-sm rounded-0" onclick="deleteCurrentRow(this);"><i class="fa fa-times"></i></button></td>';
          tr = tr + '</tr>';
          oldData = oldData + tr;
          serial++;

          $("#current_medicines_list").html(oldData);

          $("#medicine").val('');
          $("#packing").val('');
          $("#quantity").val('');
          $("#dosage").val('');

        } else {
          showCustomMessage('Please fill all fields.');
        }

      });

    });

    function deleteCurrentRow(obj) {

      var rowIndex = obj.parentNode.parentNode.rowIndex;

      document.getElementById("medication_list").deleteRow(rowIndex);
    }
  </script>
</body>

</html>