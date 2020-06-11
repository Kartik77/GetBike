
<header>
<h2>GETBIKE<h2>

   <?php 
//session_start();
     if(strlen($_SESSION['login'])==0)
	{
?>
 <div class="login_btn"> 
  <a href="./includes/login.php" class="btn">Login/Register</a>
   </div>
<?php }
else{

echo "Welcome <fname style='font-size:20px; color:white; background:black; padding:5px;'>".$_SESSION['fname']."</fname>";
 } ?>
  <nav id="navigation_bar" class="navbar navbar-default">

    <div class="container">
     
      <div class="header_wrap">
        <div class="user_login">
          <ul>
            <li class="dropdown"> <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user-circle" aria-hidden="true"></i>
<?php
$email=$_SESSION['login'];
$sql ="SELECT FullName FROM tblusers WHERE EmailId=:email ";
$query= $dbh -> prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
	{

	 echo htmlentities($result->FullName); }}?><i class="fa fa-angle-down" ></i></a>
              <ul class="dropdown-menu">
           <?php if($_SESSION['login']){?>
            <li><a href="profile.php">Profile Settings</a></li>
              <li><a href="update-password.php">Update Password</a></li>
            <li><a href="my-booking.php">My Booking</a></li>
            <li><a href="logout.php">Sign Out</a></li>
            <?php }
             else { ?>
            <li><a href="./includes/login.php"  >Profile Settings</a></li>
              <li><a href="./includes/login.php"  >Update Password</a></li>
            <li><a href="./includes/login.php"  >My Booking</a></li>
           
            <li><a href="./includes/login.php" >Sign Out</a></li>
            <?php } ?>
          </ul>
            </li>
          </ul>
        </div>
      </div>
      <div class="collapse navbar-collapse" id="navigation">
        <ul class="nav navbar-nav">
          <li><a href="index.php">Home</a>    </li>

          <li><a href="page.php?type=aboutus">About Us</a></li>
          <li><a href="bike-listing.php">Bike Listing</a>
          <li><a href="contact-us.php">Contact Us</a></li>

        </ul>
      </div>
    </div>
  </nav>
</header>
