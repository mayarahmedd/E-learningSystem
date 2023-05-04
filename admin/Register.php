<?php

include('../include/config.php'); 
if (isset($_POST['Register'])) {

$password = $_POST['password'];
$name = $_POST['name'];
$email = $_POST['email'];
$password = md5($password);


$query = "SELECT * FROM `student` WHERE (email='$email')";
$res=mysqli_query($conn, $query);
if(mysqli_num_rows($res)>0){ //if email is already present in database

echo '<script language="javascript">';
echo 'alert("The email address is already registered!")';
echo '</script>';

echo '<script >';
echo 'window.location="Register.php"';
echo '</script>'; 
exit;

}else if(mysqli_num_rows($res)==0){

$sql = "INSERT INTO `student` ( `password` ,`name`,`email`) VALUES ('$password','$name','$email')";

// insert in database 
$rs = mysqli_query($conn, $sql);

if($rs)
{

echo '<script >';
echo 'window.location="index.php"';
 echo '</script>';


}
else{

echo '<script language="javascript">'; 
echo 'alert("error!")'; 
echo '</script>';
echo '<script >';
echo 'window.location="registration.php"';
echo '</script>';
exit;
}} }
?>






<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="SemiColonWeb" />
	<!-- <link rel="icon" type="image/png" href="images/tab.png" sizes="16x16">
	<link rel="icon" type="image/png" href="images/tab1.png" sizes="32x32"> -->

	<!-- Stylesheets
	============================================= -->
	<link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="../css/bootstrap.css" type="text/css" />
	<link rel="stylesheet" href="../style.css" type="text/css" />
	<link rel="stylesheet" href="../css/dark.css" type="text/css" />
	<link rel="stylesheet" href="../css/font-icons.css" type="text/css" />
	<link rel="stylesheet" href="../css/animate.css" type="text/css" />
	<link rel="stylesheet" href="../css/magnific-popup.css" type="text/css" />

	<link rel="stylesheet" href="../css/responsive.css" type="text/css" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<!--[if lt IE 9]>
		<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
	<![endif]-->

	<!-- Document Title
	============================================= -->
	<title>E-learning</title>

</head>

<body class="stretched">

	<!-- Document Wrapper
	============================================= -->
	<div id="wrapper" class="clearfix">

		<!-- Content
		============================================= -->
		<section id="content">

			<div class="content-wrap nopadding">

				<div class="section nopadding nomargin" style="width: 100%; height: 100%; position: absolute; left: 0; top: 0; background: url('../images/images.png') center center no-repeat; background-size: cover;"></div>

				<div class="section nobg full-screen nopadding nomargin">
					<div class="container vertical-middle divcenter clearfix">

						<div class="row center">
							<h2> E-learning</h2>
							<!-- <a href="index.php"><img height="50px" src="../images/logo-footer.png" alt="Exceptional Programmers"></a> -->
						</div>

						<div class="panel panel-default divcenter noradius noborder" style="max-width: 400px; background-color: rgba(255,255,255,0.93);">
							<div class="panel-body" style="padding: 40px;">
								<form id="login-form" name="login-form" class="nobottommargin" action="" method="post">
									<h3>Login to your Account</h3>

                                    <div class="col_full">
										<label for="login-form-email">User Name:</label>
										<input type="text" id="login-form-username" name="name" value="" class="form-control not-dark" />
									</div>

									<div class="col_full">
										<label for="login-form-email">Email:</label>
										<input type="email" id="login-form-username" name="email" value="" class="form-control not-dark" />
									</div>

									<div class="col_full">
										<label for="login-form-password">Password:</label>
										<input type="password" id="login-form-password" name="password" value="" class="form-control not-dark" />
									</div>
                                    <div class="col_full">
										<label for="login-form-password">Confirm Password:</label>
										<input type="password" id="login-form-password" name="confirm-password" value="" class="form-control not-dark" />
									</div>

									<div class="col_full nobottommargin center">
										<button class="button button-3d button-black nomargin " id="login-form-submit" name="Register" value="Register">Register</button>
										
									</div>	
									
								</form>

								<div class="line line-sm"></div>

								<div class="alert-danger">
								
								<?php 

								// if(isset($message_pass) || isset($message_mail) || isset($message_found)){ 

								// 	if(isset($message_mail))
								// 		echo "$message_mail <br>";
								// 	if (isset($message_pass)) 
								// 		echo "$message_pass <br>";
								// 	if (isset($message_found)) 
								// 		echo "$message_found";

								// 	}


								?>
									
								</div>
								
							</div>

						</div>


						<div class="row center dark"><small>Copyrights &copy; 2022 All Rights Reserved by EP.</small></div>

					</div>
				</div>

			</div>

		</section><!-- #content end -->

	</div><!-- #wrapper end -->

	<!-- Go To Top
	============================================= -->
	<div id="gotoTop" class="icon-angle-up"></div>

	<!-- External JavaScripts
	============================================= -->
	<script type="text/javascript" src="../js/jquery.js"></script>
	<script type="text/javascript" src="../js/plugins.js"></script>

	<!-- Footer Scripts
	============================================= -->
	<script type="text/javascript" src="../js/functions.js"></script>

</body>
</html>