<?php
require __DIR__ . '/vendor/autoload.php';

use Twilio\Rest\Client;

include './config/connection.php';
include './common_service/common_functions.php';
include './config/config.php';

$message = '';

if (isset($_GET['id'])) {
    $update_id = $_GET['id'];

    $result = $conn->query("SELECT * FROM `vaccination` WHERE `id`='$update_id'");
    $row_count = $result->num_rows;

    $result = $result->fetch_assoc();

    $patient_name = $result['patient_id'];
    $date_of_birth = $result['date_of_birth'];
    $age = $result['age'];
    $date_of_vaccination = $result['date_of_vaccination'];
    $date_of_next_vaccination = $result['date_of_next_vaccination'];
    $type_of_vaccine = $result['type_of_vaccine'];
    $brand = $result['brand'];
    $no_of_dose = $result['no_of_dose'];
}else{
    header("location:vaccine.php");
    exit;
}

// update
if (isset($_POST['submit'])) {
    $patient_id = $_POST['patient'];
    $id = $_POST['id'];
    $visitDate = $_POST['visit_date'];
    $nextVisitDate = $_POST['next_visit_date'];
    $date_of_birth = $_POST['date_of_birth'];
    $age = $_POST['age'];
    $type_of_vaccine = $_POST['type_of_vaccine'];
    $brand = $_POST['brand'];
    $no_of_dose = $_POST['no_of_dose'];

    // update patient_data  
    $sql = "UPDATE `vaccination` SET `patient_id` = '$patient_id', `date_of_birth` = '$date_of_birth', `age` = '$age', `date_of_vaccination` = '$date_of_vaccination', `date_of_next_vaccination` = '$date_of_next_vaccination', `type_of_vaccine` = '$type_of_vaccine', `brand` = '$brand', `no_of_dose` = '$no_of_dose' WHERE `id` = '$id'";

    $result = $conn->query($sql);

    if ($result) {
        $message = 'Update Successfully.';
        header("Location:congratulation.php?goto_page=vaccine.php&message=$message");
    } else {
        echo "Error";
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
                                        <select name="patient" class="form-control form-control-sm rounded-0" required="required">
                                            <option value="<?= $patient_name ?>"><?= $patient_name ?></option>
                                        </select>
                                    </div>
                                    <?php
                                    ?>
                                <?php
                                }
                                ?>
                                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                    <label>Date of Vaccination</label>
                                    <input type="text" id="bp" class="form-control form-control-sm rounded-0" name="visit_date" required="required" placeholder="yyyy/mm/dd" value="<?= $date_of_vaccination?>"/>
                                </div>

                                <input type="hidden" name="id" value="<?=$update_id?>">

                                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                    <label>Date of Next Visit</label>
                                    <input type="text" id="bp" class="form-control form-control-sm rounded-0" name="next_visit" required="required" placeholder="yyyy/mm/dd" value="<?= $date_of_next_vaccination?>"/>
                                </div>

                                <div class="clearfix">&nbsp;</div>

                                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                    <label>Date of birth</label>
                                    <input type="text" id="bp" class="form-control form-control-sm rounded-0" name="date_of_birth" required="required" placeholder="yyyy-mm-dd" value="<?= $date_of_birth?>"/>
                                </div>
                                
                                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                    <label>Age</label>
                                    <input id="weight" name="age" class="form-control form-control-sm rounded-0" required="required" value="<?= $age?>"/>
                                </div>

                                <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                                    <label>type of Vaccine</label>
                                    <input id="disease" required="required" name="type_of_vaccine" class="form-control form-control-sm rounded-0" value="<?= $type_of_vaccine?>"/>
                                </div>


                            </div>

                            <div class="col-md-12">
                                <hr />
                            </div>
                            <div class="clearfix">&nbsp;</div>

                            <div class="row">

                                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                    <label>Brand</label>
                                    <input id="quantity" class="form-control form-control-sm rounded-0" name="brand" value="<?= $brand?>"/>
                                </div>

                                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                    <label>Number of Dose</label>
                                    <input id="dosage" class="form-control form-control-sm rounded-0" name="no_of_dose" value="<?= $no_of_dose?>"/>
                                </div>

                            </div>

                            <div class="clearfix">&nbsp;</div>
                            <div class="row">
                                <div class="col-md-10">&nbsp;</div>
                                <div class="col-md-2">
                                    <button type="submit" id="submit" name="submit" class="btn btn-primary btn-sm btn-flat btn-block">Update</button>
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