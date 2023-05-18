<?php 
include './config/connection.php';
include './common_service/common_functions.php';

$message = '';

if(isset($_POST['submit'])) {
  $medicineId = $_POST['medicine'];
  $packing = $_POST['packing'];
  $Numberofsupply = $_POST['Number_of_supply'];
  $releasemedicine = $_POST['release_medicine'];
  $Expiration = $_POST['Expiration'];
  $Manufacture = $_POST['Manufacture'];

  

  $query = "insert into `medicine_details`  (`medicine_id`, `packing`,`Number_of_supply`,`release_medicine`,`Expiration`,`Manufacture`) values($medicineId, '$packing', '$Numberofsupply','$releasemedicine','$Expiration','$Manufacture');";
  try {

    $con->beginTransaction();
    
    $stmtDetails = $con->prepare($query);
    $stmtDetails->execute();

    $con->commit();

    $message = 'saved successfully.';

  } catch(PDOException $ex) {

   $con->rollback();

   echo $ex->getMessage();
   echo $ex->getTraceAsString();
   exit;
 }
 header("location:congratulation.php?goto_page=medicine_details.php&message=$message");
 exit;
}


$medicines = getMedicines($con);

$query = "select `m`.`medicine_name`, 
`md`.`id`, `md`.`packing`,`md`.`Number_of_supply`, `md`.`release_medicine`,`md`.`Expiration`,`md`.`Manufacture`, `md`.`medicine_id` 
from `medicines` as `m`, 
`medicine_details` as `md` 
where `m`.`id` = `md`.`medicine_id` 
order by `m`.`id` asc, `md`.`id` asc;";

 try {
  
    $stmtDetails = $con->prepare($query);
    $stmtDetails->execute();

  } catch(PDOException $ex) {

   echo $ex->getMessage();
   echo $ex->getTraceAsString();
   exit;
 }

?>
<!DOCTYPE html>
<html lang="en">
<head>
 <?php include './config/site_css_links.php';?>
 <?php include './config/data_tables_css.php';?>
 <title>Medicine Details - Clinic's Patient Management System </title>

</head>
<body class="hold-transition sidebar-mini dark-mode layout-fixed layout-navbar-fixed">
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Navbar -->

    <?php include './config/header.php';
include './config/sidebar.php';?>  

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Medicine Details</h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">

        <!-- Default box -->
        <div class="card card-outline card-primary rounded-0 shadow">
          <div class="card-header">
            <h3 class="card-title">Add Medicine Details</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
              
            </div>
          </div>
          <div class="card-body">
            <form method="post">
              <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                  <label>Select Medicine</label>
                  <select id="medicine" name="medicine" class="form-control form-control-sm rounded-0" required="required">
                    <?php echo $medicines;?>
                  </select>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                  <label>Formulation</label>
                  <input type="text"  id="packing" name="packing"   required="required" class="form-control form-control-sm rounded-0"/>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-10">
                <label>Number of supply</label>
                <input type="INT" id="Number_of_supply" name="Number_of_supply" required="required"
                class="form-control form-control-sm rounded-0" />
              </div>
              <!-- <div class="col-lg-4 col-md-4 col-sm-4 col-xs-10">
                <label>Release medicine</label>
                <input type="varchar" id="release_medicine" name="release_medicine" required="required"
                class="form-control form-control-sm rounded-0" />
              </div> -->
              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-10">
                <label>Expiration</label>
                <input type="varchar" id="Expiration" name="Expiration" required="required"
                class="form-control form-control-sm rounded-0" />
              </div>
              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-10">
                <label>Manufacture</label>
                <input type="text" id="Manufacture" name="Manufacture" required="required"
                class="form-control form-control-sm rounded-0" />
              </div>

                <div class="col-lg-1 col-md-2 col-sm-4 col-xs-12">
                  <label>&nbsp;</label>
                  <button type="submit" id="submit" name="submit" 
                  class="btn btn-primary btn-sm btn-flat btn-block">Save</button>
                </div>
              </div>
            </form>
          </div>
          <!-- /.card-body -->
          
        </div>
        <!-- /.card -->

      </section>

      <div class="clearfix">&nbsp;</div>
      <div class="clearfix">&nbsp;</div>
      <div class="clearfix">&nbsp;</div>
      
  <section class="content">
      <!-- Default box -->
      <div class="card card-outline card-primary rounded-0 shadow">
        <div class="card-header">
          <h3 class="card-title">Medicine Details</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            
          </div>
        </div>

        <div class="card-body">
            <div class="row table-responsive">
              <table id="medicine_details" 
              class="table table-striped dataTable table-bordered dtr-inline" 
               role="grid" aria-describedby="medicine_details_info">
                <colgroup>
                  <col width="2%">
                  <col width="5%">
                  <col width="5%">
                  <col width="5%">
                  <col width="5%">
                  <col width="5%">
                  <col width="5%">
                  <col width="5%">
              
                </colgroup>
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Medicine Name</th>
                    <th>Formulation</th>
                    <th>Number of supply</th>
                    <th>Release medicine</th>
                    <th>Expiration</th>
                    <th>Manufacture</th>
                    <th>Action</th>
                  
                 
                  </tr>
                </thead>

                <tbody>
                  <?php 
                  $serial = 0;
                  while($row =$stmtDetails->fetch(PDO::FETCH_ASSOC)){
                    $serial++;
                  ?>
                  <tr>
                    <td class="text-center"><?php echo $serial; ?></td>
                    <td><?php echo $row['medicine_name'];?></td>
                    <td><?php echo $row['packing'];?></td>
                    <td><?php echo $row['Number_of_supply'];?></td>
                    <td><?php echo $row['release_medicine'];?></td>
                    <td><?php echo $row['Expiration'];?></td>
                    <td><?php echo $row['Manufacture'];?></td>
                    
                    <td class="text-center">
                      <a href="update_medicine_details.php?medicine_id=<?php echo $row['medicine_id'];?>&medicine_detail_id=<?php echo $row['id'];?>&packing=<?php echo $row['packing'];?>$Number_of_supply=<?php echo $row['Number_of_supply'];?>$release_medicine=<?php echo $row['release_medicine'];?>$Expiration=<?php echo $row['Expiration'];?>$Manufacture=<?php echo $row['Manufacture'];?>" 
                      class = "btn btn-primary btn-sm btn-flat">
                      <i class="fa fa-edit"></i>
                      </a>
                    </td>
                   
                  </tr>
                <?php
                }
                ?>
                </tbody>
              </table>
            </div>
        </div>
      </div>

      
    </section>
  <!-- /.content-wrapper -->
 </div>

  <?php include './config/footer.php';

$message = '';
if(isset($_GET['message'])) {
  $message = $_GET['message'];
}
  ?>  
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?php include './config/site_js_links.php'; ?>
<?php include './config/data_tables_js.php'; ?>
<script>
  showMenuSelected("#mnu_medicines", "#mi_medicine_details");

  var message = '<?php echo $message;?>';

  if(message !== '') {
    showCustomMessage(message);
  }
  $(function () {
    $("#medicine_details").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#medicine_details_wrapper .col-md-6:eq(0)');
    
  });

</script>
</body>
</html>