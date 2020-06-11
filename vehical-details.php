<?php
session_start();
include('includes/config.php');
//error_reporting(0);
if(isset($_POST['submit']))
{
  $fromdate=$_POST['fromdate'];
$todate=$_POST['todate'];
$message=$_POST['message'];
$useremail=$_SESSION['login'];
$status=0;
$vhid=$_GET['vhid'];
 $sq="SELECT pmail,age from tblusers where EmailId=:useremail";
 $qu=$dbh->prepare($sq);
 $qu->bindParam(':useremail',$useremail,PDO::PARAM_STR);  
 $qu->execute();
$respmail=$qu->fetchAll(PDO::FETCH_OBJ);

//echo $respmail[0]->age;
//echo $respmail[0]->pmail;
if($respmail[0]->age =='less'){ 
   // echo "<script>alert('age is less');</script>";
$to_email = $respmail[0]->pmail;
//console.log( $to_email,$respmail[0]->age);
//phpinfo();
$subject = 'GETBIKE: Booking conformation';
$mess = 'Your ward with userid: '.$useremail.' has applied for renting a bike. Do you want to confirm the booking or cancel it. Please leave a reply';
$headers =  'MIME-Version: 1.0' . "\r\n"; 
$headers .= 'From: GETBIKE' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

if(mail($to_email,$subject,$mess,$headers)){
  echo "<script>alert('Confirmation mail has been sent to your Parent/Guardian');</script>";
}
else{
  echo "<script>alert('mail failed');</script>";
}
}

$sql="INSERT INTO  tblbooking(userEmail,VehicleId,FromDate,ToDate,message,Status) VALUES(:useremail,:vhid,:fromdate,:todate,:message,:status)";
$query = $dbh->prepare($sql);
$query->bindParam(':useremail',$useremail,PDO::PARAM_STR);
$query->bindParam(':vhid',$vhid,PDO::PARAM_STR);
$query->bindParam(':fromdate',$fromdate,PDO::PARAM_STR);
$query->bindParam(':todate',$todate,PDO::PARAM_STR);
$query->bindParam(':message',$message,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
echo "<script>alert('Booking successfull.');</script>";
}
else
{
echo "<script>alert('Something went wrong. Please try again');</script>";
}

}
?>


<!DOCTYPE HTML>
<html lang="en">
<head>

<title>Vehicle Details</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">

<link rel="stylesheet" href="assets/css/styles.css" type="text/css">

<link href="assets/css/font-awesome.min.css" rel="stylesheet">

<link rel="shortcut icon" href="assets/images/favicon-icon/icon.png">

</head>
<body>
<?php include('includes/header.php');?>
<?php
$vhid=intval($_GET['vhid']);
$sql = "SELECT tblvehicles.*,tblbrands.BrandName,tblbrands.id as bid  from tblvehicles join tblbrands on tblbrands.id=tblvehicles.VehiclesBrand where tblvehicles.id=:vhid";
$query = $dbh -> prepare($sql);
$query->bindParam(':vhid',$vhid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{
$_SESSION['brndid']=$result->bid;
?>

<section>
  <div><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage1);?>" class="img-responsive" alt="image" width="500" height="500"></div>

</section>

<section class="listing-detail">
  <div class="container">
    <div class="listing_detail_head row">
      <div class="col-md-9">
        <h2><?php echo htmlentities($result->BrandName);?> , <?php echo htmlentities($result->VehiclesTitle);?></h2>
      </div>
      <div class="col-md-3">
        <div class="price_info">
          <p>Rs&nbsp<?php echo htmlentities($result->PricePerDay);?> </p>Per Day

        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-9">
        <div class="main_features">
          <ul>

            <li> <i class="fa fa-calendar"></i>
              <h5><?php echo htmlentities($result->ModelYear);?></h5>
              <p>Reg.Year</p>
            </li>
            <li> <i class="fa fa-cogs"></i>
              <h5><?php echo htmlentities($result->FuelType);?></h5>
              <p>Fuel Type</p>
            </li>

            <li> <i class="fa fa-user-plus" ></i>
              <h5><?php echo htmlentities($result->SeatingCapacity);?></h5>
              <p>Seats</p>
            </li>
          </ul>
        </div>
        <div class="listing_more_info">
          <div class="listing_detail_wrap">
       
<div class="tab" style="padding:10px;">
<div class="overviewtab">
  <h6 style="background-color:#ff0012; color: white; height:50px; font-size: 30px; text-align: center; vertical-align: center;">Vehicle Overview</h6>
   <p><?php echo htmlentities($result->VehiclesOverview);?></p>
</div>
<div class="accesstab">
  <table >
    <thead>
    <tr>
      <th colspan="2"> Accessories </th>
    </tr>
  </thead>
    <tr>
<td>AntiLock Braking System (ABS)</td>
<?php if($result->AntiLockBrakingSystem==1)
{
?>
<td><i class="fa fa-check" ></i></td>
<?php } else {?>
<td><i class="fa fa-close" ></i></td>
<?php } ?>
                    </tr>

<tr>
<td>Smooth Handling</td>
<?php if($result->SmoothHandling==1)
{
?>
<td><i class="fa fa-check"></i></td>
<?php } else { ?>
<td><i class="fa fa-close" ></i></td>
<?php } ?>
</tr>

<tr>
<td>Leather Seats</td>
<?php if($result->LeatherSeats==1)
{
?>
<td><i class="fa fa-check"></i></td>
<?php } else { ?>
<td><i class="fa fa-close" ></i></td>
<?php } ?>
</tr>

<tr>
<td>Central Locking</td>
<?php if($result->CentralLocking==1)
{
?>
<td><i class="fa fa-check" ></i></td>
<?php } else { ?>
<td><i class="fa fa-close" ></i></td>
<?php } ?>
</tr>

<td>Brake Assist</td>
<?php if($result->BrakeAssist==1)
{
?>
<td><i class="fa fa-check" ></i></td>
<?php  } else { ?>
<td><i class="fa fa-close" ></i></td>
<?php } ?>
</tr>


<tr>
<td>Crash Sensor</td>
<?php if($result->CrashSensor==1)
{
?>
<td><i class="fa fa-check" ></i></td>
<?php } else { ?>
<td><i class="fa fa-close" ></i></td>
<?php } ?>
</tr>

  </table>
</div>
</div>

          </div>

        </div>
<?php }} ?>

      </div>
      <aside class="col-md-3"> 
        <div class="sidebar_widget">
          <div class="widget_heading">
            <h5>Book Now</h5>
          </div>
          <form method="post" id="bookform" name="bookform">
            <div class="form-group">
              <input type="text" class="form-control" name="fromdate" placeholder="From Date(dd/mm/yyyy)" required>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="todate" placeholder="To Date(dd/mm/yyyy)" required>
            </div>
            <div class="form-group">
              <textarea rows="4" class="form-control" name="message" placeholder="Message" required></textarea>
            </div>
          <?php if($_SESSION['login'])
              {?>
              <div class="form-group">
                <input type="submit" class="btn"  name="submit" id="submit" value="Book Now" >
             </div>
              <?php } else { ?>
<a href="includes/login.php" class="btn btn-xs uppercase">Login to Book</a>

              <?php } ?>
          </form>
        </div>
      </aside>
    </div>

    <div class="space-20"></div>
    <div class="divider"></div>



  </div>
</section>

<?php include('includes/footer.php');?>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/interface.js"></script>
<script src="assets/js/bootstrap-slider.min.js"></script>

<!--<script type="text/javascript">
  $(document).ready(function(){
  $('#submit').click(function(){ 
var x=confirm('Are you sure? Do you want to confirm the booking');
if(x==true){
$.ajax({
      url:"confirmbooking.php",
      method:"POST",
      data:$('#bookform').serialize(),
      success:function(data)
      {
        console.log("submit clicked");
        $('#bookform')[0].reset();
      }
    });
  }

});
});
</script>-->

</body>
</html>
