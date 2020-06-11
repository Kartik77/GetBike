<?php
session_start();
error_reporting(0);
include('includes/config.php');
?>

<!DOCTYPE HTML>
<html lang="en">
<head>

<title></title>
<!--Bootstrap -->
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
<!--Custome Style -->
<link rel="stylesheet" href="assets/css/styles.css" type="text/css">

<link href="assets/css/bootstrap-slider.min.css" rel="stylesheet">
<link href="assets/css/font-awesome.min.css" rel="stylesheet">
<link rel="shortcut icon" href="assets/images/favicon-icon/icon.png">

</head>
<body>


<!--Header-->
<?php include('includes/header.php');?>
                      <?php
$pagetype=$_GET['type'];
$sql = "SELECT type,detail,PageName from tblpages where type=:pagetype";
$query = $dbh -> prepare($sql);
$query->bindParam(':pagetype',$pagetype,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{ ?>
<section class="page-header aboutus_page">
  <div class="container">
    <div class="page-header_wrap">
      <div class="page-heading">
        <h1><?php   echo htmlentities($result->PageName); ?></h1>
      </div>
    </div>
  </div>
  <div class="dark-overlay"></div>
</section>
<section class="about_us section-padding">
  <div class="container">
    <div class="section-header text-center">


      
      <p><?php  echo ($result->detail); ?> </p>
    </div>
   <?php } }?>
  </div>
</section>
<!-- /About-us-->





<<!--Footer -->
<?php include('includes/footer.php');?>
<!-- /Footer-->



<!--Login-Form -->
<//?php include('includes/login.php');?>
<!--/Login-Form -->
<!-- Scripts -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/interface.js"></script>

</body>
</html>
