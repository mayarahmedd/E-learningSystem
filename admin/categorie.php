
<?php
  include('../include/config.php'); 
 
  session_start();
    
  if (!isset($_SESSION['admin_id'])) {
    echo '<script >';
    echo 'window.location="../home.php"';
    echo '</script>';
    exit;
}










      if( isset($_POST['submit']) ){

        
            
            if( isset($_POST['fullname']) && !empty($_POST['fullname'])){

                if(preg_match('/^[A-Za-z\s]+$/',$_POST['fullname'])){
                  $name = mysqli_real_escape_string($conn,$_POST['fullname']);
                }else{
                  $message_name = '<b class="text-danger text-center">Please type correct name</b>';
                }

            }else{
                $message_name = '<b class="text-danger text-center">Please fill the name field</b>';
            }


            if( isset($name) && !empty($name)  ){

                $insert_query = "INSERT INTO `categories` (categorie) VALUES ('$name')";

                if(mysqli_query($conn, $insert_query)){
                    
                   
                    header('Location: categorie.php#end');
                }else{
                    $submit_message = '<div class="alert alert-danger">
                        <strong>Warning!</strong>
                        You are not able to submit please try later
                    </div>';
                }
            }

        

    } 






if(isset($_GET['delid'])){
    $id = $_GET['delid'];
 

    
    $query = "DELETE FROM `categories` WHERE id='$id'";
    $result = mysqli_query($conn,$query);
    
    if($result){
        
        header("Location: categorie.php?sucess");
    } else {
                 echo "Error".$query."<br>".mysqli_error($conn);
            }
}





  include('header.php'); 
  
?>

		
	<div id="wrapper" class="clearfix">

		<div id="vertical-nav">
			<div class="container clearfix">

				<nav>
					<ul>
						<li><a href="home.php"><i class="icon-home2"></i>Home</a></li>

                        <li  class="current"><a href="categorie.php"><i class="icon-book2"></i>Categories</a></li> 

						<li><a href="courses.php"><i class="icon-book3"></i>Courses</a></li>

						<li><a href="content.php"><i class="icon-line-content-left"></i>Content</a> </li>

						<li><a href="blog.php"><i class="icon-blogger"></i>Blog</a></li>

						<li><a href="library.php"><i class="icon-line-align-center"></i>Library</a></li>

						<li><a href="instructors.php"><i class="icon-guest"></i>Instructors</a></li>


                        <li><a href="logout.php"><i class="icon-line-power"></i>Logout</a></li>    

					</ul>
				</nav>

			</div>
		</div>

				
		<section id="page-title">

			<div class="container clearfix">
				<h1>Welcome <strong><?php// if(isset($loginName)) echo $loginName; ?></strong></h1>
			</div>

			<div id="page-menu-wrap">

				<div class="container clearfix">

				</div>

			</div>

		</section>


		<section id="content">

			<div class="content-wrap">

				<div class="container clearfix">
				

				<div class="postcontent nobottommargin">

                    

                <?php

                    // echo $alertMessage; 
                    if(isset($update_status)) echo $update_status;

                        if(isset($message_name) || isset($submit_message)){
                            echo "<div class='alert alert-danger'>";
                            
                            echo "Please fill the form carefully and correctly<br>";

                            echo "<a type='button' class='btn btn-default btn-sm' data-dismiss='alert'>Cancel</a>
                            </div>";    

                        }

                 ?>
                 
						<h3>Insert Course Categories</h3>

                        <form action="" method="post" enctype="multipart/form-data">
                    
                    <div class="form-group">
                        <label for="CourseId1">Course Categorie</label>
                        <input type="text" id="CourseId1" placeholder="Full Name" name="fullname" class="form-control" title="Only lower and upper case and space" pattern="[A-Za-z/\s]+">
                        <?php if(isset($message_name)){ echo $message_name; } ?>
                    </div>
                    
                    <div class="form-group">
                        <button name="submit" class="btn btn-block btn-success" type="submit">Submit</button>
                    </div>
                </form>
                        
							

							
						

<!--%%%%%%%%%%%%%%%% HERE DISPLAY TABLE %%%%%%%%%%%%%%%%% -->
    
    
    <table class="table table-striped table-bordered">
    <tr>
        <th>ID</th>
        <th>Course Categories</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    <?php

        $query = "SELECT * FROM `categories`";

        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) > 0){
        
                        
         while( $row = mysqli_fetch_assoc($result) ){
                echo "<tr>";
echo "<td>".$row["id"]."</td> <td>".$row["categorie"]."</td>";

                echo '<td><a href="updatecategorie.php?id='.$row['id']. '" type= "button" class="btn btn-primary btn-sm">
                <span class="icon-edit"></span></a></td>';
                
                echo '<td><a href="categorie.php?delid='.$row['id']. '" type= "button" class="btn btn-danger btn-sm">
                <span class="icon-trash2"></span></a></td>';

                echo "<tr>";  
            }
    } else {
        echo "<div class='alert alert-danger'>You have no courses.<a class='close' data-dismiss='alert'>&times</a></div>";
    }
    

        mysqli_close($conn);
    ?>

    
</table>


                	</div>

				</div>

			</div>

		</section>

<?php include('footer.php'); 


?>