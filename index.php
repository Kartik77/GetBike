<?php
session_start();
include('includes/config.php');
error_reporting(0);

?>

<!DOCTYPE HTML>
<html lang="en">
<head>

<title>GetBike</title>

<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="assets/css/styles.css" type="text/css">
<link href="assets/css/font-awesome.min.css" rel="stylesheet">


	

<link rel="shortcut icon" href="assets/images/favicon-icon/icon.png">

</head>
<body>

<?php include('includes/header.php');?>
<section id="banner" class="banner-section">
    <center><h1 class="titwhite">Find Your Perfect bike</h1>   </center>            
</section>
<section class="section-padding gray-bg">
  <div class="container">
    <div class="section-header text-center">
      <h2>Find the Best <span>Bike For You</span></h2>
    </div>
    <div class="row">
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="resentnewcar">

<?php $sql = "SELECT tblvehicles.VehiclesTitle,tblbrands.BrandName,tblvehicles.PricePerDay,tblvehicles.FuelType,tblvehicles.ModelYear,tblvehicles.id,tblvehicles.SeatingCapacity,tblvehicles.VehiclesOverview,tblvehicles.Vimage1 from tblvehicles join tblbrands on tblbrands.id=tblvehicles.VehiclesBrand";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
//$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{
?>

<div class="col-list-3">
<div class="recent-car-list">
<div class="car-info-box"> <a href="vehical-details.php?vhid=<?php echo htmlentities($result->id);?>"><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage1);?>" class="img-responsive" alt="image"></a>
<ul>
<li><tag class="fa fa-car" ></tag>&nbsp<?php echo htmlentities($result->FuelType);?></li>
<li><tag class="fa fa-calendar" ></tag>&nbsp<?php echo htmlentities($result->ModelYear);?> Model</li>
<li><tag class="fa fa-user" ></tag>&nbsp<?php echo htmlentities($result->SeatingCapacity);?> seats</li>
</ul>
</div>
<div class="car-title-m">
<h6><a href="vehical-details.php?vhid=<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->BrandName);?> , <?php echo htmlentities($result->VehiclesTitle);?></a></h6>
<span class="price">Rs<?php echo htmlentities($result->PricePerDay);?> /Day</span>
</div>
<div >
<p><?php echo substr($result->VehiclesOverview,0,70);?>---</p>
</div>
</div>
</div>
<?php }}?>

      </div>
    </div>
  </div>
</div>
</section>

<?php include('includes/footer.php');?>


<//?php include('includes/registration.php');?>
<//?php include('includes/forgotpassword.php');?>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

<script src="assets/js/bootstrap-slider.min.js"></script>

</body>

</html>
