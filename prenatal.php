<?php
require __DIR__ . '/vendor/autoload.php';

use Twilio\Rest\Client;

include './config/connection.php';
include './common_service/common_functions.php';
include './config/config.php';


$message = '';

if (isset($_POST['submit'])) {

  // new prenatal data
  $patientId = $_POST['patient_id'];
  // get patient name by id
  $results = getPatients_by_id($patientId, $conn, "patients");
  $results = $results->fetch_assoc();
  $patient_name = $results['patient_name'];
  $p_number = $results['phone_number'];
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
    // one insertion save to multiple table


    // prenatal
    $prenatal_data = insert_data("new_prenatal", $patient_name, $date_of_consultation, $next_visit_date, $date_of_birth, $age, "", "", "", "", "", "", "", "", "", "", "", "", "", "", $conn);


    // new_prenatal_obscore
    $prenatal_obscore = insert_data("new_prenatal_obscore", $patient_name, $gravida, $para, $term, $preterm, $abortion, $living, "", "", "", "", "", "", "", "", "", "", "", "", $conn);

    // LPM
    $prenatal_lpm = insert_data("new_prenatal_lpm", $patient_name, $month, $day, $year, $age_of_gestation, $num_of_prenatal_visit, $medical_history, $high_risk_pregnancy, $services, $bp, $temperature, $heart_rate, $respiratory_rate, $fundal_height, $internal_exam, $fundal_height2, $leopolds_manuever, $urinalysis_result, "", $conn);

    // TTVS
    $prenatal_ttvs = insert_data("new_prenatal_ttvs", $patient_name, $first_tt, $second_tt, $third_tt, $fourth_tt, $fifth_tt, $deworm1, $deworm2, $date_given1, $vit_a_stats, $date_given2, $cal_sup_stats, $date_given3, $iron_sup_stats, $date_given4, $folic_acid_sup_stats, $date_given5, $birth_plan, $other_exam_res, $conn);




    // check if the all returns are equal to true
    if ($prenatal_data  == TRUE && $prenatal_obscore  == TRUE && $prenatal_lpm  == TRUE && $prenatal_ttvs  == TRUE) {
      // display success message
      $message = 'All Information are successfully added to database';

      $sender="SEMAPHORE";
      $msg='Good day maam your next visit is on '.$next_visit_date;
      sms_send($sender,$p_number,$msg);
      
     
      header("Location:congratulation.php?goto_page=prenatal.php&message=$message");
      exit;
    } else {
      $message = 'Failed to save data to the database';
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
  <title>New Prescription - Clinic's Patient Management System</title>

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
              <h1>New Prenatal</h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">

        <!-- Default box -->
        <div class="card card-outline card-primary rounded-0 shadow">
          <div class="card-header">
            <h3 class="card-title">Add New Prenatal</h3>

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
                  <select id="patient_id" name="patient_id" class="form-control form-control-sm rounded-0" required="required" onchange="b_day_patient(this.value);">
                    <?php echo $patients; ?>
                  </select>
                </div>


                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-10">
                  <div class="form-group">
                    <label>Date of consultation</label>
                    <div class="input-group date" id="visit_date" data-target-input="nearest">
                      <input type="text" class="form-control form-control-sm rounded-0 datetimepicker-input" data-target="#visit_date" name="date_of_consultation" required="required" data-toggle="datetimepicker" autocomplete="off" />
                      <div class="input-group-append" data-target="#visit_date" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                    </div>
                  </div>
                </div>



                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-10">
                  <div class="form-group">
                    <label>Next Visit Date</label>
                    <div class="input-group date" id="next_visit_date" data-target-input="nearest">
                      <input type="text" class="form-control form-control-sm rounded-0 datetimepicker-input" data-target="#next_visit_date" name="next_visit_date" data-toggle="datetimepicker" autocomplete="off" />
                      <div class="input-group-append" data-target="#next_visit_date" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="clearfix">&nbsp;</div>

                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Date of birth</label>
                  <input type="date" id="bp" class="form-control form-control-sm rounded-0" name="date_of_birth" required="required"  />
                </div>

                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Age</label>
                  <input id="weight" name="age" class="form-control form-control-sm rounded-0" required="required" />
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
                  <input id="quantity" class="form-control form-control-sm rounded-0" name="gravida" />
                </div>

                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Para</label>
                  <input id="dosage" class="form-control form-control-sm rounded-0" name="para" />
                </div>

                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Term</label>
                  <input id="dosage" class="form-control form-control-sm rounded-0" name="term" />
                </div>

                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Preterm</label>
                  <input id="dosage" class="form-control form-control-sm rounded-0" name="preterm" />
                </div>

                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Abortion</label>
                  <input id="dosage" class="form-control form-control-sm rounded-0" name="abortion" />
                </div>

                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Living</label>
                  <input id="dosage" class="form-control form-control-sm rounded-0" name="living" />
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
                  <input id="quantity" class="form-control form-control-sm rounded-0" name="month" />
                </div>

                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Day</label><br><br>
                  <input id="dosage" class="form-control form-control-sm rounded-0" name="day" />
                </div>

                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>year</label><br><br>
                  <input id="dosage" class="form-control form-control-sm rounded-0" name="year" />
                </div>

                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Age of Gestation</label><br><br>
                  <input id="dosage" class="form-control form-control-sm rounded-0" name="age_of_gestation" />
                </div>

                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Number of Prenatal Visit: </label> <br><br>
                  <input id="dosage" class="form-control form-control-sm rounded-0" name="num_of_prenatal_visit" />
                </div>

                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Medical History:</label><br><br>
                  <input id="dosage" class="form-control form-control-sm rounded-0" name="medical_history" />
                </div>

                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>High Risk Pregnancy: (DDL:YES or NO)</label>
                  <input id="dosage" class="form-control form-control-sm rounded-0" name="high_risk_pregnancy" />
                </div>

                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>SERVICES:</label><br><br>
                  <input id="dosage" class="form-control form-control-sm rounded-0" name="services" />
                </div>

                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Blood Pressure:</label><br><br>
                  <input id="dosage" class="form-control form-control-sm rounded-0" name="bp" />
                </div>


                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Temperature:</label><br><br>
                  <input id="dosage" class="form-control form-control-sm rounded-0" name="temperature" />
                </div>

                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Heart Rate:</label><br><br>
                  <input id="dosage" class="form-control form-control-sm rounded-0" name="heart_rate" />
                </div>


                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Respiratory Rate:</label><br><br>
                  <input id="dosage" class="form-control form-control-sm rounded-0" name="respiratory_rate" />
                </div>

                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Fundal Height (cm):</label><br><br>
                  <input id="dosage" class="form-control form-control-sm rounded-0" name="fundal_height" />
                </div>

                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Internal Examination:</label><br><br>
                  <input id="dosage" class="form-control form-control-sm rounded-0" name="internal_exam" />
                </div>

                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Fundal Height (cm):</label><br><br>
                  <input id="dosage" class="form-control form-control-sm rounded-0" name="fundal_height2" />
                </div>

                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Leopold’s Maneuver:</label><br><br>
                  <input id="dosage" class="form-control form-control-sm rounded-0" name="leopolds_manuever" />
                </div>

                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Urinalysis Results:</label><br><br>
                  <input id="dosage" class="form-control form-control-sm rounded-0" name="urinalysis_result" />
                </div>
              </div>
              <div class="col-md-12">
                <hr />
              </div>
              <div class="clearfix">&nbsp;</div>
              <h5>Tetanus Toxoid Vaccine Status</h5>

              <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>First TT: </label><br><br>
                  <input type="date" id="quantity" class="form-control form-control-sm rounded-0" name="first_tt" />
                </div>

                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Second TT</label><br><br>
                  <input type="date" id="dosage" class="form-control form-control-sm rounded-0" name="second_tt" />
                </div>

                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Third TT:</label><br><br>
                  <input type="date" id="dosage" class="form-control form-control-sm rounded-0" name="third_tt" />
                </div>

                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Fourth TT:</label><br><br>
                  <input type="date" id="dosage" class="form-control form-control-sm rounded-0" name="fourth_tt" />
                </div>

                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Fifth TT:</label><br><br>
                  <input type="date" id="dosage" class="form-control form-control-sm rounded-0" name="fifth_tt" />
                </div>

                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Deworming Status:</label><br><br>
                  <input id="dosage" class="form-control form-control-sm rounded-0" name="deworm1" />
                </div>


                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Deworming Status:</label><br><br>
                  <input id="dosage" class="form-control form-control-sm rounded-0" name="deworm2" />
                </div>

                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Date Given:</label><br><br>
                  <input type="date" id="dosage" class="form-control form-control-sm rounded-0" name="date_given1" />
                </div>


                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Vitamin A Status:</label><br><br>
                  <input id="dosage" class="form-control form-control-sm rounded-0" name="vit_a_stats" />
                </div>
                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Date Given:</label><br><br>
                  <input type="date" id="dosage" class="form-control form-control-sm rounded-0" name="date_given2" />
                </div>


                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Calcium Supplementation Status:</label>
                  <input id="dosage" class="form-control form-control-sm rounded-0" name="cal_sup_stats" />
                </div>
                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Date Given:</label><br><br>
                  <input type="date" id="dosage" class="form-control form-control-sm rounded-0" name="date_given3" />
                </div>
                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Iron Supplementation Status:</label>
                  <input id="dosage" class="form-control form-control-sm rounded-0" name="iron_sup_stats" />
                </div>
                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Date Given:</label><br><br>
                  <input type="date" id="dosage" class="form-control form-control-sm rounded-0" name="date_given4" />
                </div>
                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Folic Acid Supplementation Status:</label>
                  <input id="dosage" class="form-control form-control-sm rounded-0" name="folic_acid_sup_stats" />
                </div>
                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Date Given:</label><br><br>
                  <input type="date" id="dosage" class="form-control form-control-sm rounded-0" name="date_given5" />
                </div>
                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Birth Plan:</label><br><br>
                  <input id="dosage" class="form-control form-control-sm rounded-0" name="birth_plan" />
                </div>
                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Other Examining Results/Observation and Remarks: </label>
                  <input id="dosage" class="form-control form-control-sm rounded-0" name="other_exam_res" />
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
        <!-- /.card -->

        <table class="table table-dark">
          <tr>
            <thead>
              <th>Patient Name</th>
              <th>Date Of Birth</th>
              <th>Age</th>
              <th>Action</th>
            </thead>
          </tr>

          <tbody>
            <?php

            $sql = "SELECT * FROM `new_prenatal`";
            $results = $conn->query($sql);
    
            while ($row = $results->fetch_assoc()) {
            ?>
              <tr>
                <td><?= $row['patient_name'] ?></td>
                <td><?= $row['date_of_birth'] ?></td>
                <td><?= $row['age'] ?></td>
                <td>
                  <!-- view -->
                  <a class="btn btn-success" href="prenatal_view.php?id=<?= $row['id'] ?>">view</a>
                  <!-- edit -->
                  <a class="btn btn-primary" href="prenatal_edit.php?id=<?= $row['id'] ?>">Edit</a>
                </td>
              </tr>
            <?php
            }
            ?>
          </tbody>
        </table>

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
    showMenuSelected("#mnu_patients", "#mi_prenatal");

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
    function b_day_patient(patient_id){
      
      if(patient_id!==""){

                    $.ajax({
                        url: "ajax/get_packings.php",
                        type: 'GET',
                        data: {
                            'patient_id_birth': patient_id
                        },
                        cache: false,
                        async: false,
                        success: function(data, status, xhr) {
                          

                          document.getElementById('bp').value=data;
                        },
                        error: function(jqXhr, textStatus, errorMessage) {
                            showCustomMessage(errorMessage);
                        }
                    });
      }
    }
  </script>
</body>

</html>