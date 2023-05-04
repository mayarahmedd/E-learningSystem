<?php 
 
 include('../include/config.php'); 
 session_start();
/*if(isset($_SESSION['administrative_id']))
/*header("location:index.php?page=home");*/
?>


<?php

if (isset($_POST['submit'])) {
         
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($email != '' && $password != '') {

        $query = "SELECT * FROM `admin` WHERE email='$email'";
		$results = mysqli_query($conn, $query);
		$roww=mysqli_fetch_assoc($results);



		$queryy = "SELECT * FROM `student` WHERE email='$email' ";
		$result = mysqli_query($conn, $queryy);
		$row = mysqli_fetch_array($result);
	   
        
			if($results->num_rows > 0){
				//$roww = $results->fetch_array();
				
			$db_passs = $roww['password'];
            if ($db_passs === md5($password) || $db_passs == ($password)) {
                $admin_id = $roww['admin_id'];
                $_SESSION['admin_id'] = $admin_id;
				$_SESSION['name'] =  $roww['name'];
                
                //echo $admin_id;

                
                echo '<script >';
                   echo 'window.location="home.php"';
                    echo '</script>';


                exit;
            } else {
                
                echo '<script language="javascript">';
            echo 'alert("email or password is incorrect !!")';
            echo '</script>';
            echo '<script >';
			echo 'window.location="index.php"';
                echo '</script>';
                exit;
            }
        }  
           
			   
			else if($result->num_rows > 0){
			
			$db_pass = $row['password'];
            if ($db_pass === md5($password) || $db_pass == ($password)) {
                $student_id = $row['student_id'];
                $_SESSION['student_id'] = $student_id;
				$_SESSION['name'] =  $row['name'];

                
                echo '<script >';
                    echo 'window.location="../home.php"';
                    echo '</script>';


                exit;
            
        } else {
                
			echo '<script language="javascript">';
		echo 'alert("email or password is incorrect !!")';
		echo '</script>';
		echo '<script >';
		echo 'window.location="index.php"'; 
			echo '</script>';
			exit;
		}

    
        }else {
           
		echo '<script language="javascript">';
	echo 'alert("No users with such login found in the database! !!")';
		echo '</script>';
		echo '<script >';
		  	echo 'window.location="index.php"';  
			echo '</script>';
			exit;
		
	}

}}
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
										<label for="login-form-email">Email:</label>
										<input type="email" id="login-form-username" name="email" value="" class="form-control not-dark" />
									</div>

									<div class="col_full">
										<label for="login-form-password">Password:</label>
										<input type="password" id="login-form-password" name="password" value="" class="form-control not-dark" />
									</div>

									<div class="col_full nobottommargin center">
										<button class="button button-3d button-black nomargin " id="login-form-submit" name="submit" value="login">Login</button>
										
									</div>	

									<div style="margin-top: 30px;" class="col_full nobottommargin center">
										<a href='Register.php' class="button button-3d button-black nomargin " id="login-form-submit" name="register" value="register">register</a>
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


						<div class="row center dark"><small>Copyrights &copy; 2023 All Rights Reserved by EP.</small></div>

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