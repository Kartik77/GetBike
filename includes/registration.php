<?php
include('config.php');
//error_reporting(0);
if(isset($_POST['signup']))
{
 $pmail="";
 $pmobile="";
$fname=$_POST['fullname'];
$email=$_POST['emailid']; 
$mobile=$_POST['mobileno'];
$password=md5($_POST['password']); 
$age=$_POST['age'];
if($age=='less'){
$pmail=$_POST['pmail'];
$pmobile=$_POST['pmobile'];
}
$sql="INSERT INTO  tblusers(FullName,EmailId,ContactNo,Password,age,pmail,pmobile) VALUES(:fname,:email,:mobile,:password,:age,:pmail,:pmobile)";
$query = $dbh->prepare($sql);
$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':mobile',$mobile,PDO::PARAM_STR);
$query->bindParam(':password',$password,PDO::PARAM_STR);
$query->bindParam(':age',$age,PDO::PARAM_STR);
$query->bindParam(':pmail',$pmail,PDO::PARAM_STR);
$query->bindParam(':pmobile',$pmobile,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
echo "<script>alert('Registration successfull. Now you can login');</script>";
}
else 
{
echo "<script>alert('Something went wrong. Please try again');</script>";
}
}

?>
<script src="../assets/js/jquery.min.js"></script>
<script type="text/javascript">
function valid()
{
if(document.signup.password.value!= document.signup.confirmpassword.value)
{
alert("Password and Confirm Password Field do not match  !!");
document.signup.confirmpassword.focus();
return false;
}
return true;
}
function checkAvailability(){

jQuery.ajax({
url: "../check_availability.php",
data:'emailid='+$("#emailid").val(),
type: "POST",
success:function(data){
$("#user-availability-status").html(data);

},
error:function (){}
});
}
</script>
<!DOCTYPE html>
<head>
<title>Registration</title>
 <link rel="shortcut icon" href="../assets/images/favicon-icon/icon.png">
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="../assets/css/styles.css" type="text/css">
<link href="../assets/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
  <center>
  <div class="superform">
  <form  method="post" name="signup" onSubmit="return valid();">
                <div class="form-group">
                  <input type="text" class="form-control" name="fullname" placeholder="Full Name" required="required">
                </div>
                      <div class="form-group">
                  <input type="text" class="form-control" name="mobileno" placeholder="Mobile Number" maxlength="10" required="required">
                </div>
                <div class="form-group">
                  <input type="email" class="form-control" name="emailid" id="emailid" onBlur="checkAvailability()" placeholder="Email Address" required="required">
                   <span id="user-availability-status" style="font-size:12px;"></span> 
                   <!--<input type="email" class="form-control" name="emailid" id="emailid" placeholder="Email Address" required>-->
                </div>
              
                        <div class="form-group" style="text-align: left; font-size:18px; ">
 Age<br/>
                  <input type="radio" name="age" id="less" onclick="showdiv()" value="less"> Between 18 and 20<br/>
                                  <input type="radio" name="age" checked="true" onclick="showdiv()" value="more">   Above 20</br>
                      </div>
                <div  id="parentdetails" style="display:none; ">
 <div class="form-group">
                 
<input type="email" name="pmail" class="form-control" placeholder="parent's mail id"></div>
<div class="form-group">
<input type="text" name="pmobile" class="form-control" placeholder="parent's mobile number">
</div>
              </div>
               <div class="form-group">
                  <input type="password" class="form-control" name="password" placeholder="Password" required="required">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" name="confirmpassword" placeholder="Confirm Password" required="required">
                </div>
               <!-- <div class="form-group checkbox">
                  <input type="checkbox" id="terms_agree" required="required" checked="">
                  <label for="terms_agree">I Agree with Terms and Conditions</label>
                </div>-->
                <div class="form-group">
                  <input type="submit" value="Sign Up" name="signup" id="submit" class="btn btn-block">
                </div>
              </form>
              <div >
        <p>Already got an account? <a href="login.php" data-toggle="modal" data-dismiss="modal">Login Here</a></p>
      </div>
    </div>
  </center> 

</body>
<script type="text/javascript">
 function showdiv(){
  var chkage=document.getElementById("less");
var parentdetails=document.getElementById('parentdetails');
parentdetails.style.display=chkage.checked?"block":"none";


 }

</script>

</html>


