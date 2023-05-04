<?php

include('../include/config.php'); 
include('header.php'); 



session_start();
    
  if (!isset($_SESSION['admin_id'])) {
    echo '<script >';
    echo 'window.location="../home.php"';
    echo '</script>';
    exit;
}





if( isset($_POST['submit']) ){

  

        //Name Condition
        if( isset($_POST['fullname']) && !empty($_POST['fullname'])){

            if(preg_match('/^[A-Za-z\s]+$/',$_POST['fullname'])){
              $name = mysqli_real_escape_string($conn,$_POST['fullname']);
            }else{
              $message_name = '<b class="text-danger text-center">Please enter correct name.</b>';
            }

        }else{
            $message_name = '<b class="text-danger text-center">Please fill the name field.</b>';
        }

        //Email Condition
        if( isset($_POST['email']) && !empty($_POST['email']) ){
            
            $pattern = "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/";

            if(preg_match($pattern,$_POST['email'])){
                
                $cemail = mysqli_real_escape_string($conn,$_POST['email']);
                $query = "SELECT * FROM `teacher` WHERE mail='$cemail' ";
                $result = mysqli_query($conn, $query);
                
                if(mysqli_num_rows($result) > 0){
                    $message_email = '<b class="text-danger text-center">Email already exists try with different.</b>';
                }else{

                    $email = mysqli_real_escape_string($conn,$_POST['email']);
                }
            }else{
                $message_email = '<b class="text-danger text-center">Please enter correct email.</b>';
            }
        }else{
            $message_email = '<b class="text-danger text-center">Please fill email field.</b>';
        }

        //Phone Condition
        if( isset($_POST['phone']) && !empty($_POST['phone'])){
        
            $pattern = "/^[+]?(\d{1,2})?[\s.-]?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}$/";
            if(preg_match($pattern,$_POST['phone'])){

                $phone = mysqli_real_escape_string($conn,$_POST['phone']);
            }else{
                    $message_ph = '<b class="text-danger text-center">Please enter valid phone number.</b>';
            } 				
        }else{
            $message_ph = '<b class="text-danger text-center">Please fill the Phone field.</b>';
        } 

        // Description Condition 
        // if( isset($_POST['description']) && !empty($_POST['description']) ){
        
            
        //         $description = mysqli_real_escape_string($conn,$_POST['description']);
            

        // }else{
        // $message_des = '<b class="text-danger text-center">Please fill the Description field.</b>';
        // }    

        if( isset($_POST['qualification']) && !empty($_POST['qualification'])){
        
            if(preg_match('/^[A-Za-z\s]+$/',$_POST['qualification'])){
                $qualification = mysqli_real_escape_string($conn,$_POST['qualification']);
            }else{

                $message_q = '<b class="text-danger text-center">Please enter valid Qualifications.</b>';
            }

        }else{
           $message_q = '<b class="text-danger text-center">Please fill the Qualifications field.</b>';
        }


        if( isset($_FILES["profilePic"]["name"]) && !empty($_FILES["profilePic"]["name"]) ){
            $target_dir = "images/instructor/";
            $target_file = $target_dir . basename($_FILES["profilePic"]["name"]);
            $uploadOk = 1;
            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

            // Check if image file is a actual image or fake image
            $check = getimagesize($_FILES["profilePic"]["tmp_name"]);
            if($check !== false) {
                
                $uploadOk = 1;
            } else {
                $message_picture  = '<b class="text-danger">File is not an image</b>';
                $uploadOk = 0;
            }
       
            // Check file size
            if ($_FILES["profilePic"]["size"] > 5000000) {
                $message_picture =  '<b class="text-danger">Sorry, your file is too large.</b>';
                $uploadOk = 0;
            }
           
            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
                $message_picture =  '<b class="text-danger">Sorry, only JPG, JPEG, PNG & GIF files are allowed</b>';
                $uploadOk = 0;
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk != 0) {
                $temp = explode(".", $_FILES["profilePic"]["name"]);
                $newfilename = mysqli_real_escape_string($conn,round(microtime(true)) . '.' . end($temp));
                if (move_uploaded_file($_FILES["profilePic"]["tmp_name"], $target_dir . $newfilename)) {
                    
                } else {
                    $message_picture =  '<b class="text-danger">Sorry, there was an error uploading your file';
                }
            }

        }else{
            $message_picture =  '<b class="text-danger">Please Select Your Profile picture</b>';
        }



        if( ( isset($name) && !empty($name) ) && ( isset($email) && !empty($email) ) && ( isset($newfilename) && !empty($newfilename) ) && ( isset($phone) && !empty($phone) ) && ( isset($qualification) && !empty($qualification) )){


            $insert_query = "INSERT INTO `teacher` (name, mail, phone , image, qualification) VALUES ('$name','$cemail','$phone','$newfilename','$qualification')";


            if(mysqli_query($conn, $insert_query)){
                
               
                header('Location: instructors.php#end');
            }else{
                $submit_message = '<div class="alert alert-danger">
                    <strong>Warning!</strong>
                    You are not able to submit please try later
                </div>';
            }
        } // end of if 

    

}//submit button

/* %%%%%%%%%%%%% END CODE SUBMIT %%%%%%%%%%%% */


if(isset($_GET['sucess'])){
    $alertMessage = "<div class='alert alert-success'> 
    <p>Record Deleted successfully.</p><br>       
    <a type='button' class='btn btn-default btn-sm' data-dismiss='alert'>Cancel</a> 
    </div>";
}

if(isset($_GET['delid'])){ 

    $deluser = $_GET['delid'];


}





// conform delete button
if(isset($_GET['delid'])){

$id = $_GET['delid'];

        // Delete file from folder
$query2 = "SELECT * FROM `teacher` WHERE instructorId='$id' ";

$result2 = mysqli_query($conn, $query2);

if(mysqli_num_rows($result2) > 0){

                //We have data 
                //output the data
     while( $row2 = mysqli_fetch_assoc($result2) ){
            
            $base_directory = "images/instructor/";
            if(unlink($base_directory.$row2['image']))
                $delVar = " ";
              
     }
}

// new database query 
$query = "DELETE FROM `teacher` WHERE instructorId='$id'";
$result = mysqli_query($conn,$query);

if($result){
    // redirect
    header("Location: instructors.php?sucess=1");
} else {
             echo "Error".$query."<br>".mysqli_error($conn);
}
}





















?>

		
	<div id="wrapper" class="clearfix">

		<div id="vertical-nav">
			<div class="container clearfix">

				<nav>
					<ul>
						<li><a href="home.php"><i class="icon-home2"></i>Home</a></li>

                        <li><a href="categorie.php"><i class="icon-book2"></i>Categories</a></li>

						<li><a href="courses.php"><i class="icon-book3"></i>Courses</a></li>

						<li><a href="content.php"><i class="icon-line-content-left"></i>Content</a> </li>

						<li><a href="blog.php"><i class="icon-blogger"></i>Blog</a></li>

						<li><a href="library.php"><i class="icon-line-align-center"></i>Library</a></li>

						<li class="current"><a href="instructors.php"><i class="icon-guest"></i>Instructors</a></li>

                        <!-- <li><a href="team.php"><i class="icon-users"></i>Team</a></li> -->

                        <li><a href="logout.php"><i class="icon-line-power"></i>Logout</a></li>    

					</ul>
				</nav>

			</div>
		</div>

				<!-- Page Title
		============================================= -->
		<section id="page-title">

			<div class="container clearfix">
				<h1>Welcome <strong><?php //if(isset($loginName)) echo $loginName; ?></strong></h1>
			</div>

			<div id="page-menu-wrap">

				<div class="container clearfix">

					
				</div>

			</div>

		</section><!-- #page-title end -->

		<!-- Page Sub Menu
		============================================= -->

		<!-- Content
		============================================= -->
		<section id="content">

			<div class="content-wrap">

				<div class="container clearfix">
				<!-- ========================================== -->

				<div class="postcontent nobottommargin">

                    

                <?php

                    // echo $alertMessage; 
                    if(isset($update_status)) echo $update_status;

                        if(isset($message_name) || isset($message_picture) || isset($submit_message) || isset($message_ph) || isset($message_q) ){
                            echo "<div class='alert alert-danger'>";
                            
                            echo "Please fill the form carefully and correctly<br>";

                            echo "<a type='button' class='btn btn-default btn-sm' data-dismiss='alert'>Cancel</a>
                            </div>";    

                        }

                 ?>
                 
						<h3>Insert Instructors</h3>

                        <form action="" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="fullnameId1">Full Name</label>
                        <input type="text" id="fullnameId1" placeholder="Full Name" name="fullname" class="form-control" title="Only lower and upper case and space" pattern="[A-Za-z/\s]+">
                        <?php if(isset($message_name)){ echo $message_name; } ?>
                    </div>
                    <div class="form-group">
                        <label for="emailid1">Email</label>
                        <input type="email" id="emailid1" placeholder="Email" name="email" class="form-control" title="someone@example.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">
                        <?php if(isset($message_email)){ echo $message_email; } ?>
                    </div>
                    <div class="form-group">
                        <label class="btn btn-success" for="my-file-selector">
                            <input id="my-file-selector" name="profilePic" type="file" style="display:none;" onchange="$('#upload-file-info').html($(this).val());">
                            Profile Picture
                        </label>
                        <span class='label label-success' id="upload-file-info"></span>
                        <?php if(isset($message_picture)){ echo $message_picture; } ?>
                    </div>
                    <div class="form-group">
                        <label for="qualificationId1">Qualifications</label>
                        <input type="tex" id="qualificationId1" placeholder="Qualifications" name="qualification" class="form-control">
                        <?php if(isset($message_q)){ echo $message_q; } ?>
                    </div>
                    <div class="form-group">
                        <label for="phoneId1">Phone</label>
                        <input type="text" id="phoneId1" placeholder="Phone" name="phone" class="form-control">
                        <?php if(isset($message_ph)){ echo $message_ph; } ?>
                    </div>
                    <!-- <div class="form-group">
                		<label for="descriptionId1">Description</label>
                		<textarea id="descriptionId1" class="form-control" 
                		 name="description"></textarea>
             		</div> -->
             		<?php// if(isset($message_des)){ echo $message_des; } ?>
                    <div class="form-group">
                        <button name="submit" class="btn btn-block btn-success" type="submit">Submit</button>
                    </div>
                </form>
                        					

<!--%%%%%%%%%%%%%%%% HERE DISPLAY TABLE %%%%%%%%%%%%%%%%% -->
    
    
    <table class="table table-striped table-bordered">
    <tr>
        <th>ID</th>
        <th>Picture</th>
        <th>Name</th>
        <th>Email</th>
        <th>Qualification</th>
        <th>Phone</th>
        <!-- <th>Description</th> -->
        <!-- <th>Edit</th> -->
        <th>Delete</th>
    </tr>
    <?php

        $query = "SELECT * FROM `teacher`";

        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) > 0){
        
                        //We have data 
                        //output the data
         while( $row = mysqli_fetch_assoc($result) ){
                echo "<tr>";
echo "<td>".$row["instructorId"]."</td> <td><img src=images/instructor/".$row["image"]." width='80px' height='80px'> </td> <td>".$row["name"]."</td> <td> ".$row["mail"]."</td><td>".$row["qualification"]."</td> <td>".$row["phone"]."</td>";
                
                //  echo '<td><a href="view.php?instructorId='.$row['instructorId']. '" type= "button" class="btn btn-primary btn-sm">
                // <span class="icon-eye-open"></span></a></td>';

                // echo '<td><a href="updateinstructors.php?id='.$row['instructorId']. '" type= "button" class="btn btn-primary btn-sm">
                // <span class="icon-edit"></span></a></td>';
                
                echo '<td><a href="instructors.php?delid='.$row['instructorId']. '" type= "button" class="btn btn-danger btn-sm">
                <span class="icon-trash2"></span></a></td>';

                echo "<tr>";  
            }
    } else {
        echo "<div class='alert alert-danger'>You have no Record<a class='close' data-dismiss='alert'>&times</a></div>";
    }
    
    // close the mysql 
        mysqli_close($conn);
    ?>

    
</table>

<!-- %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->
    



					</div><!-- .postcontent end -->


				</div>

			</div>

		</section><!-- #content end -->

<?php include('footer.php'); 
//}

?>