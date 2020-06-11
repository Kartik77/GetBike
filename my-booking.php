<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
  {
header('location:index.php');
}
else{
?><!DOCTYPE HTML>
<html lang="en">
<head>

<title>Your bookings</title>

<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">

<link rel="stylesheet" href="assets/css/styles.css" type="text/css">

<link href="assets/css/bootstrap-slider.min.css" rel="stylesheet">

<link href="assets/css/font-awesome.min.css" rel="stylesheet">

<link rel="shortcut icon" href="assets/images/favicon-icon/icon.png">

</head>
<body>

<?php include('includes/header.php');?>

<section class="page-header profile_page">
  <div class="container">
    <div class="page-header_wrap">
      <div class="page-heading">
        <h1>My Booking</h1>
      </div>

    </div>
  </div>
  <div class="dark-overlay"></div>
</section>
<?php
$useremail=$_SESSION['login'];
$sql = "SELECT * from tblusers where EmailId=:useremail";
$query = $dbh -> prepare($sql);
$query -> bindParam(':useremail',$useremail, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{ ?>
<section class="user_profile inner_pages">
  <div class="container">
    <div class="user_profile_info gray-bg padding_4x4_40">
      <div class="upload_user_logo"> <img src="assets/images/pro.png" alt="image">
      </div>

      <div class="dealer_info">
        <h5><?php echo htmlentities($result->FullName);?></h5>
        <p><?php echo htmlentities($result->Address);?><br>
          <?php echo htmlentities($result->City);?>&nbsp<?php echo htmlentities($result->Country);?></p>
          <?php  }}?>
      </div>
    </div>
    <div class="row">
      <div class="col-md-3 col-sm-3">
       <?php include('includes/sidebar.php');?>

      <div class="col-md-6 col-sm-8">
        <div class="profile_wrap">
          <h5 class="uppercase underline">My Bookings </h5>
          <div class="my_vehicles_list">
            <ul class="vehicle_listing">
<?php
$useremail=$_SESSION['login'];
 $sql = "SELECT tblvehicles.Vimage1 as Vimage1,tblvehicles.VehiclesTitle,tblvehicles.id as vid,tblbrands.BrandName,tblbooking.FromDate,tblbooking.ToDate,tblbooking.message,tblbooking.Status  from tblbooking join tblvehicles on tblbooking.VehicleId=tblvehicles.id join tblbrands on tblbrands.id=tblvehicles.VehiclesBrand where tblbooking.userEmail=:useremail";
$query = $dbh -> prepare($sql);
$query-> bindParam(':useremail', $useremail, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{  ?>

<li>
                <div class="vehicle_img"> <a href="vehical-details.php?vhid=<?php echo htmlentities($result->vid);?>""><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage1);?>" alt="image"></a> </div>
                <div class="vehicle_title">
                  <h6><a href="vehical-details.php?vhid=<?php echo htmlentities($result->vid);?>""> <?php echo htmlentities($result->BrandName);?> , <?php echo htmlentities($result->VehiclesTitle);?></a></h6>
                  <p><b>From Date:</b> <?php echo htmlentities($result->FromDate);?><br /> <b>To Date:</b> <?php echo htmlentities($result->ToDate);?></p>
                </div>
                <?php if($result->Status==1)
                { ?>
                <div class="vehicle_status" style="color:white; background: green; text-align: center;">Confirmed
                          
        </div>

              <?php } else if($result->Status==2) { ?>
 <div class="vehicle_status" style="color:white; background:red; text-align: center;"> Cancelled
            
        </div>



                <?php } else { ?>
 <div class="vehicle_status" style="color:black; border-color: red; border-style: solid; background:white; text-align: center;">Not Confirm yet
            
        </div>
                <?php } ?>
       <div style="float: left"><p><b>Message:</b> <?php echo htmlentities($result->message);?> </p></div>
              </li>
              <?php }} ?>


            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--/my-vehicles-->
<?php include('includes/footer.php');?>

<!-- Scripts -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/interface.js"></script>

<script src="assets/js/bootstrap-slider.min.js"></script>

</body>
</html>
<?php } ?>
