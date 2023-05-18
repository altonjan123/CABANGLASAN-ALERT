<?php
require __DIR__ . '/vendor/autoload.php';

use Twilio\Rest\Client;

include './config/connection.php';
include './common_service/common_functions.php';
include './config/config.php';

$message = '';

if (isset($_POST['submit'])) {
  $patient_id = $_POST['patient'];
  $visitDate = $_POST['visit_date'];
  $nextVisitDate = $_POST['next_visit_date'];
  $date_of_birth = $_POST['date_of_birth'];
  $age = $_POST['age'];
  $type_of_vaccine = $_POST['type_of_vaccine'];
  $brand = $_POST['brand'];
  $dosage = $_POST['dosage'];
 

  // get patient info based on id

  $result = getPatients_by_id($patient_id, $conn, "patients");
 
  $result = $result->fetch_assoc();

  $patient_name = $result['patient_name'];
  $p_number = $result['phone_number'];

  $sql = "INSERT INTO `vaccination` (`patient_id`, `date_of_birth`, `age`, `date_of_vaccination`, `date_of_next_vaccination`, `type_of_vaccine`, `brand`, `no_of_dose`) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";

  // use prepared statement
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ssssssss", $patient_name, $date_of_birth, $age, $visitDate, $nextVisitDate, $type_of_vaccine, $brand, $dosage);
  $result = $stmt->execute();

  $sender="SEMAPHORE";
  $msg="Good day Ma'am/Sir your next dose will be on ".$nextVisitDate;
  if ($result) {
   $message = 'patient added successfully.';
    sms_send($sender,$p_number,$msg);
                    
    

    header("Location:congratulation.php?goto_page=vaccine.php&message=$message");
    exit;
  } else {
    $message = 'Failed to save patient.';

    header("Location:congratulation.php?goto_page=vaccine.php&message=$message");
    die;
  }
}

// display vaccinaTION INFORMATION

$results = $conn->query("SELECT * FROM `vaccination`");


$patients = getPatients($con);

$medicines = getMedicines($con);



?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include './config/site_css_links.php' ?>

  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <title>New Prescription - Clinic's Patient Management System in PHP</title>

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
              <h1>New Vaccination</h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">

        <!-- Default box -->
        <div class="card card-outline card-primary rounded-0 shadow">
          <div class="card-header">
            <h3 class="card-title">Add New Vaccination</h3>
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
                <?php
                if (isset($row_count)) {
                ?>
                  <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label>Select Patient</label>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                    ?>
                      <select name="patient" class="form-control form-control-sm rounded-0" required="required">
                        <?php echo $row['patient_id']; ?>
                      </select>
                    <?php
                    }
                    ?>
                  </div>
                  <?php
                  ?>

                <?php
                } else {
                ?>
                  <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label>Select Patient</label>
                    <select id="patient" name="patient" class="form-control form-control-sm rounded-0" required="required" onchange="b_day_patient(this.value);">
                      <?php echo $patients; ?>
                    </select>
                  </div>
                <?php
                }
                ?>



                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-10">
                  <div class="form-group">
                    <label>Date Of Vaccination</label>
                    <div class="input-group date" id="visit_date" data-target-input="nearest">
                      <input type="text" class="form-control form-control-sm rounded-0 datetimepicker-input" data-target="#visit_date" name="visit_date" required="required" data-toggle="datetimepicker" autocomplete="off" />
                      <div class="input-group-append" data-target="#visit_date" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-10">

                  <div class="form-group">

                    <label>Date Next Visit</label>

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
                  <input type="date" id="bp" class="form-control form-control-sm rounded-0" name="date_of_birth" required="required" />
                </div>

                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Age</label>
                  <input id="weight" name="age" class="form-control form-control-sm rounded-0" required="required" />
                </div>

                <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                  <label>type of Vaccine</label>
                  <input id="disease" required="required" name="type_of_vaccine" class="form-control form-control-sm rounded-0" />
                </div>


              </div>

              <div class="col-md-12">
                <hr />
              </div>
              <div class="clearfix">&nbsp;</div>

              <div class="row">

                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Brand</label>
                  <input id="quantity" class="form-control form-control-sm rounded-0" name="brand" />
                </div>

                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label>Number of Dose</label>
                  <input id="dosage" class="form-control form-control-sm rounded-0" name="dosage" />
                </div>


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

        <?php
  $con = mysqli_connect("localhost","root","","pms_db");
 
?>
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['brand', 'COUNT'],
         <?php
          $sql = "SELECT brand, COUNT(brand) as 'COUNT' FROM vaccination GROUP BY brand ORDER BY 2" ;
     $fire = mysqli_query($con,$sql);
          while ($result = mysqli_fetch_assoc($fire)) {
            echo"['".$result['brand']."',".$result['COUNT']."],";
          }

         ?>
        ]);

        var options = {
          title: 'Vaccination Chart'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="piechart" style="width: 1280px; height: 500px;"></div>
  </body>
</html>
        <!-- Vaccination table -->

        <table class="table table-dark">
          <tr>
            <thead>
              <th>Patient ID</th>
              <th>Date of Birth</th>
              <th>Age</th>
              <th>Date of Vaccination</th>
              <th>Date of Next Vaccination</th>
              <th>Type of Vaccine</th>
              <th>Brand</th>
              <th>No. of Dose</th>
              <th>Action</th>
            </thead>
          </tr>

          <tbody>
            <?php
            while ($row = $results->fetch_assoc()) {
            ?>
              <tr>
                <td><?= $row['patient_id'] ?></td>
                <td><?= $row['date_of_birth'] ?></td>
                <td><?= $row['age'] ?></td>
                <td><?= $row['date_of_vaccination'] ?></td>
                <td><?= $row['date_of_next_vaccination'] ?></td>
                <td><?= $row['type_of_vaccine'] ?></td>
                <td><?= $row['brand'] ?></td>
                <td><?= $row['no_of_dose'] ?></td>
                <td>
                  <a href="edit_vaccine.php?id=<?= $row['id'] ?>">Edit</a>
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