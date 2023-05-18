<?php 
include './config/connection.php';

  $date = date('Y-m-d');
  $week = date('W');
  $year =  date('Y'); 
  $month =  date('m');

  $queryToday = "SELECT count(*) as `today` 
  from `patient_visits` 
  where `visit_date` = '$date';";

  $queryWeek = "SELECT count(*) as `week` 
  from `patient_visits` 
  where week (`visit_date`) = WEEK('$date');";

$queryYear = "SELECT count(*) as `year` 
  from `patient_visits` 
  where YEAR(`visit_date`) = YEAR('$date');";
  

$queryMonth = "SELECT count(*) as `month` 
  from `patient_visits` 
  where month (`next_visit_date`) = MONTH('$date');";
  

  $todaysCount = 0;
  $currentWeekCount = 0;
  $currentMonthCount = 0;
  $currentYearCount = 0;


  try {

    $stmtToday = $con->prepare($queryToday);
    $stmtToday->execute();
    $r = $stmtToday->fetch(PDO::FETCH_ASSOC);
    $todaysCount = $r['today'];

    $stmtWeek = $con->prepare($queryWeek);
    $stmtWeek->execute();
    $r = $stmtWeek->fetch(PDO::FETCH_ASSOC);
    $currentWeekCount = $r['week'];

    $stmtYear = $con->prepare($queryYear);
    $stmtYear->execute();
    $r = $stmtYear->fetch(PDO::FETCH_ASSOC);
    $currentYearCount = $r['year'];

    $stmtMonth = $con->prepare($queryMonth);
    $stmtMonth->execute();
    $r = $stmtMonth->fetch(PDO::FETCH_ASSOC);
    $currentMonthCount = $r['month'];

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
 <title>SMS Notification and Profiling System</title>
<style>
  .dark-mode .bg-fuchsia, .dark-mode .bg-maroon {
    color: #fff!important;

    
}
#system-logo {
    width: 8em !important;
    height: 8em !important;
    object-fit: cover;
    object-position: center center;
}
.btn{
  background-color:transparents;
  box-shadow:0 6px rbga(0.0.0.0.6);
  border:1px solid white;
}
.btn:hover{
background-color: #6c757d;
}
</style>
</head>
<body class="hold-transition sidebar-mini dark-mode layout-fixed layout-navbar-fixed">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->

<?php 

include './config/header.php';
include './config/sidebar.php';
?>  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Dashboard</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $todaysCount;?></h3>

                <p>Today's Patients</p>
              </div>
              <div class="icon">
                <i class="fa fa-calendar-day"></i>
              </div>
             
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-purple">
              <div class="inner">
                <h3><?php echo $currentWeekCount;?></h3>

                <p>Scheduled For Next Week</p>
              </div>
              <div class="icon">
                <i class="fa fa-calendar-week"></i>
              </div>
             
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-fuchsia text-reset">
              <div class="inner">
                <h3><?php echo $currentMonthCount;?></h3>

                <p>Scheduled For Next Month</p>
              </div>
              <div class="icon">
                <i class="fa fa-calendar"></i>
              </div>
             
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-maroon text-reset">
              <div class="inner">
                <h3><?php echo $currentYearCount;?></h3>

                <p>Total Patient</p>
              </div>
              <div class="icon">
                <i class="fa fa-user-injured"></i>
              </div>
             
            </div>
            
          </div>
        </div>
      </div>
    </section>
    
    <section class="content">
  <center> <a href="morbidilty.php" class="nav-link" 
                id="mi_reports">
                <img src="dist/img/292657731_862594264715561_4066490255991424298_n.png" class="img-thumbnail p-0 border rounded-circle" id="system-logo"><br><br>
                 <button class="btn">Click here to view the top 10 morbidity</button></center>
                </a>
</section>
    <!-- /.content -->
<!-- pie chart -->
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
          ['disease', 'COUNT'],
         <?php
          $sql = "SELECT disease, COUNT(disease) as 'COUNT' FROM patient_visits GROUP BY disease ORDER BY 2" ;
     $fire = mysqli_query($con,$sql);
          while ($result = mysqli_fetch_assoc($fire)) {
            echo"['".$result['disease']."',".$result['COUNT']."],";
          }

         ?>
        ]);

        var options = {
          title: 'Disease Record Chart'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="piechart" style="width: 1415px; height: 300px; color: #6c757d;"> </div>
  </body>
</html>


<!-- vaccination pie chart -->
<?php
  $con = mysqli_connect("localhost","root","","pms_db");
 
?>

</div>
  </div>
  
  <!-- /.content-wrapper -->

<?php include './config/footer.php';?>  
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?php include './config/site_js_links.php';?>
<script>
  $(function(){
    showMenuSelected("#mnu_dashboard", "");
  })
</script>

</body>
</html>