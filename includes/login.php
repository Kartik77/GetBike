
<?php
session_start();
include('config.php');
if(isset($_POST['login']))
{
$email=$_POST['email'];
$password=md5($_POST['password']);
$sql ="SELECT EmailId,Password,FullName FROM tblusers WHERE EmailId=:email and Password=:password";
$query= $dbh -> prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
$_SESSION['login']=$_POST['email'];
$_SESSION['fname']=$results[0]->FullName;
header('location: ../index.php');

} else{
  
  echo "<script>alert('Invalid Details');</script>";

}

}

?>
<!DOCTYPE html>
<head>
  <title>Login page</title>
  <link rel="shortcut icon" href="../assets/images/favicon-icon/icon.png">
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="../assets/css/styles.css" type="text/css">
<link href="../assets/css/font-awesome.min.css" rel="stylesheet">
  </head>

<body 
/*style="background-image:url('../assets/images/bullet.jpg');
background-repeat: no-repeat;
background-attachment: fixed;
background-size: 100%;
" */>
  <center>
    <div class="superform">
<form method="post" action="login.php" >
<div class="form-group">
                  <input type="email" class="form-control" name="email" placeholder="Email address*">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" name="password" placeholder="Password*">
                </div>
               
                <div class="form-group">
                  <input type="submit" name="login" value="Login" class="btn btn-block">
                </div>
</form>
<div >
        <p>Don't have an account? <a href="registration.php">Signup Here</a></p>
        <p><a href="forgotpassword.php">Forgot Password ?</a></p>
      </div>
    </div>
</center>

</body>

</html>