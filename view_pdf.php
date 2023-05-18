<?php
require __DIR__ . '/vendor/autoload.php';

use Twilio\Rest\Client;

include './config/connection.php';
include './common_service/common_functions.php';
include './config/config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $prenatal1 = "SELECT * FROM `patients` WHERE `id` = '$id'";
    $prenatal1 = $conn->query($prenatal1);
    $prenatal1 = $prenatal1->fetch_assoc();
    $patient_name = $prenatal1['patient_name'];

    // get p_name from prenatal table
    $prenatal = "SELECT * FROM `new_prenatal` WHERE `patient_name` = '$patient_name'";
    $prenatal = $conn->query($prenatal);
    $prenatal = $prenatal->fetch_assoc();

    $patient_name = $prenatal['patient_name'];
    $date_of_consultation = $prenatal['date_of_consultation'];
    $next_visit_date = $prenatal['next_visit_date'];
    $date_of_birth = $prenatal['date_of_birth'];
    $age = $prenatal['age'];

    // OB Score Table
    $ob_score = "SELECT * FROM `new_prenatal_obscore` WHERE `patient_name` = '$patient_name'";
    $ob_score = $conn->query($ob_score);
    $ob_score = $ob_score->fetch_assoc();

    $gravida = $ob_score['gravida'];
    $para = $ob_score['para'];
    $term = $ob_score['term'];
    $preterm = $ob_score['preterm'];
    $abortion = $ob_score['abortion'];
    $living = $ob_score['living'];


    // OB Score Table
    $lmp = "SELECT * FROM `new_prenatal_lpm` WHERE `patient_name` = '$patient_name'";
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
    $ttvs = "SELECT * FROM `new_prenatal_ttvs` WHERE `patient_name` = '$patient_name'";
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


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './config/site_css_links.php' ?>

    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <title>Prenatal | View Record</title>



    <style>
        .view-container {
            width: 90%;
            margin: 0 auto;
            /* border: 1px solid #000; */
            padding: 20px;
        }

        .view-container .report-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 60px;
            box-shadow: 10px 20px 40px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
        }

        .view-container .report-container {
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 10px 10px 40px rgba(0, 0, 0, 0.2);
        }

        .view-container .report-container .report-card {
            flex: 2;
        }

        .view-container .report-container .prenatal-title {
            text-align: center;
            flex: 1;
        }

        .view-container .report-card li {
            list-style: none;
            font-size: 18px;
        }

        /* .view-container .report-card .report{
            border: 1px solid #fff;
            flex: 2;
        }
        .view-container .report-card .column_name{
            border: 1px solid #fff;
            flex: 1;
        } */
    </style>
</head>

<body class="hold-transition sidebar-mini dark-mode layout-fixed layout-navbar-fixed">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->

        <?php include './config/header.php';
        include './config/sidebar.php'; ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <div class="view-container">
                <h2 class="mb-5 text-center">Individual Records</h2>
                <!-- Prenatal Record -->
                <div class="report-container mb-4">
                    <div class="prenatal-title">
                        <h2 class="mx-4">PRENATAL RECORD</h2>
                    </div>
                    <div class="report-card bg-dark">
                        <div class="column_name">
                            <li>Patient Name</li>
                            <li>Date of Consultation</li>
                            <li>Next Visit Date</li>
                            <li>Date of Birth</li>
                            <li>Age</li>
                        </div>

                        <div class="report">
                            <li><?= $patient_name ?></li>
                            <li><?= $date_of_consultation ?></li>
                            <li><?= $next_visit_date ?></li>
                            <li><?= $date_of_birth ?></li>
                            <li><?= $age ?></li>
                        </div>
                    </div>
                </div>



                <!-- OB Score -->
                <div class="report-container mb-4">
                    <div class="prenatal-title">
                        <h2 class="mx-4">OB SCORE</h2>
                    </div>
                    <div class="report-card bg-dark">
                        <div class="report">
                            <li>Gravida</li>
                            <li>Para</li>
                            <li>Term</li>
                            <li>Preterm</li>
                            <li>Abortion</li>
                            <li>Living</li>
                        </div>

                        <div class="column_name">
                            <li><?= $gravida ?></li>
                            <li><?= $para ?></li>
                            <li><?= $term ?></li>
                            <li><?= $preterm ?></li>
                            <li><?= $abortion ?></li>
                            <li><?= $living ?></li>
                        </div>
                    </div>
                </div>



                <!-- LMP -->
                <div class="report-container mb-4">
                    <div class="prenatal-title">
                        <h2 class="mx-4">LAST MENSTRUAL PERIOD (LMP)</h2>
                    </div>
                    <div class="report-card bg-dark">
                        
                        <div class="report">
                            <li>Month</li>
                            <li>Day</li>
                            <li>Year</li>
                            <li>Age of Gestation</li>
                            <li>Number of Prenatal Visit</li>
                            <li>Medical History</li>
                            <li>High Risk Pregnancy</li>
                            <li>Services</li>
                            <li>Blood Pressure</li>
                            <li>Temperature</li>
                            <li>Heart Rate</li>
                            <li>Fundal Height</li>
                            <li>Internal Exammination</li>
                            <li>Fundal Height </li>
                            <li>Leopold's Manuever </li>
                            <li>Urinalysis Result</li>
                        </div>

                        <div class="column_name">
                            <li><?= $month ?></li>
                            <li><?= $day ?></li>
                            <li><?= $year ?></li>
                            <li><?= $age_of_gestation ?></li>
                            <li><?= $number_of_prenatal_visit ?></li>
                            <li><?= $medical_history ?></li>
                            <li><?= $high_risk_pregnancy ?></li>
                            <li><?= $services ?></li>
                            <li><?= $blood_pressure ?></li>
                            <li><?= $temperature ?></li>
                            <li><?= $heart_rate ?></li>
                            <li><?= $respiratory_rate ?></li>
                            <li><?= $fundal_height ?></li>
                            <li><?= $internal_examination ?></li>
                            <li><?= $fundal_height2?></li>
                            <li><?= $leopolds_manuever?></li>
                            <li><?= $urinalysis_result?></li>
                        </div>
                    </div>
                </div>



                <!-- TTVS -->
                <div class="report-container mb-4">
                    <div class="prenatal-title">
                        <h2 class="mx-4">TETANUS TOXOID VACCINE STATUS</h2>
                    </div>
                    <div class="report-card bg-dark">
                        <div class="report">

                            <li>First TT</li>
                            <li>Second TT</li>
                            <li>Third TT</li>
                            <li>Fourth TT</li>
                            <li>Fifth TT</li>
                            <!-- <li>Deworming Status</li> -->
                            <!-- <li>Deworming Status</li> -->
                            <li>Date Given</li>
                            <li>Vitamin A Status</li>
                            <li>Date Given</li>
                            <li>Calcium Supplement Status</li>
                            <li>Date Given</li>
                            <li>Iron Supplemental Status</li>
                            <li>Date Given</li>
                            <li>Folic Acid Supplemental Status</li>
                            <li>Date Given</li>
                            <li>Birth plan</li>
                            <li>Other Examining Results/Observation and Remarks:</li>
                        </div>

                        <div class="column_name">

                            <li><?=$first_tt?></li>
                            <li><?=$second_tt?></li>
                            <li><?=$third_tt?></li>
                            <li><?=$fourt_tt?></li>
                            <li><?=$fifth_tt?></li>
                            <!-- <li><?=$deworming_status?></li> -->
                            <!-- <li><?=$deworming_status2?></li> -->
                            <li><?=$date_given?></li>
                            <li><?=$vitamin_a_status?></li>
                            <li><?=$date_given2?></li>
                            <li><?=$calcium_supplement_status?></li>
                            <li><?=$date_given3?></li>
                            <li><?=$iron_supplement_status?></li>
                            <li><?=$date_given4?></li>
                            <li><?=$folic_acid_supplement_status?></li>
                            <li><?=$date_given5?></li>
                            <li><?=$birth_plan?></li>
                            <li><?=$other_examinning_result?></li>
                
                        </div>
                    </div>
                </div><br><br><br>
            
                <div class="row">
                  <div class="col-md-12 table-responsive">
                    <table id="patient_history" class="table table-striped table-bordered">
                      <colgroup>
                        <col width="10%">
                        <col width="15%">
                        <col width="15%">
                        <col width="40%">
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">
                      </colgroup>
                      <thead>
                        <tr class="bg-gradient-primary text-light">
                        <h2 class="mx-4">Patient Records</h2> 
                          <th class="p-1 text-center">S.No</th>
                          <th class="p-1 text-center">Visit Date</th>
                          <th class="p-1 text-center">Disease</th>
                          <th class="p-1 text-center">Medicine</th>
                          <th class="p-1 text-center">Packing</th>
                          <th class="p-1 text-center">QTY</th>
                          <th class="p-1 text-center">Dosage</th>
                        </tr>
                      </thead>
                  
                      <tbody id="history_data">
                        
                      </tbody>
                    </table>
                  </div><br><br>




                  <div class="col-md-12 table-responsive">
                    <table id="patient_vacination" class="table table-striped table-bordered" >
                      <colgroup>
                          
                      
                        <col width="10%">
                        <col width="15%">
                        <col width="15%">
                        <col width="40%">
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">
                      </colgroup>
                      <thead><br><br>

                        <tr class="bg-gradient-primary text-light">
                        <h2 class="mx-4">Patient Vaccination Records</h2>
                          <th class="p-1 text-center">Date of birth</th>
                          <th class="p-1 text-center">Age</th>
                          <th class="p-1 text-center">Date of Vacination</th>
                          <th class="p-1 text-center">Date of Next Vacination</th>
                          <th class="p-1 text-center">Type of Vaccine </th>
                          <th class="p-1 text-center">Brand</th>
                          <th class="p-1 text-center">Dose</th>
                        </tr>
                      </thead>
                  
                      <tbody id="vacination_data">
                        
                      </tbody>
                    </table>
                  </div>
              </div>

                <!-- <a href="prenatal.php" class="btn btn-success">BACK</a> -->
            </div>
        </div>



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

        function patient_history(){
            var patientId = '<?php echo$id?>';
      

              if(patientId !== '') {

                $.ajax({
                  url: "ajax/get_patient_history.php",
                  type: 'GET', 
                  data: {
                    'patient_id': patientId
                  },
                  cache:false,
                  async:false,
                  success: function (data, status, xhr) {
                      $("#history_data").html(data);
                  },
                  error: function (jqXhr, textStatus, errorMessage) {
                    showCustomMessage(errorMessage);
                  }
                });


                $.ajax({
                  url: "ajax/get_patient_vacination.php",
                  type: 'GET', 
                  data: {
                    'patient_id': patientId
                  },
                  cache:false,
                  async:false,
                  success: function (data, status, xhr) {
                      $("#vacination_data").html(data);
                     
                  },
                  error: function (jqXhr, textStatus, errorMessage) {
                    showCustomMessage(errorMessage);
                  }
                });

                $.ajax({
                  url: "ajax/get_patient_prenatal.php",
                  type: 'GET', 
                  data: {
                    'patient_id': patientId
                  },
                  cache:false,
                  async:false,
                  success: function (data, status, xhr) {
                      $("#prenatal_data").html(data);
                     
                  },
                  error: function (jqXhr, textStatus, errorMessage) {
                    showCustomMessage(errorMessage);
                  }
                });

                //alert('hello');

              }
        }

        patient_history();

        window.print();
        
    </script>
</body>

</html>