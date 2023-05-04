
<?php

    // Watch From Video
    include('../include/config.php'); 
    include('header.php'); 
    session_start();
    
  if (!isset($_SESSION['admin_id'])) {
    echo '<script >';
    echo 'window.location="../home.php"';
    echo '</script>';
    exit;
}else{
    $loginName=$_SESSION['name'];

}
    
?>
    

		<!-- Document Wrapper
	============================================= -->
	<div id="wrapper" class="clearfix">

		<div id="vertical-nav">
			<div class="container clearfix">

				<nav>
					<ul>
						<li class="current"><a href="home.php"><i class="icon-home2"></i>Home</a></li>

                        <li><a href="categorie.php"><i class="icon-book2"></i>Categories</a></li>

						<li><a href="courses.php"><i class="icon-book3"></i>Courses</a></li>

						<li><a href="content.php"><i class="icon-line-content-left"></i>Content</a> </li>

						<li><a href="blog.php"><i class="icon-blogger"></i>Blog</a></li>

						<li><a href="library.php"><i class="icon-line-align-center"></i>Library</a></li>

						<li><a href="instructors.php"><i class="icon-guest"></i>Instructors</a></li>

                        <!-- <li><a href="team.php"><i class="icon-users"></i>Team</a></li> -->

                        <li><a href="logout.php"><i class="icon-line-power"></i>Logout</a></li>    

					</ul>
				</nav>

			</div>
		</div>
        
                    <!-- Page Title
        ============================================= -->
        <section id="page-title" style="margin-padding: 0px;">

            <div class="container clearfix">
                <h1>Welcome <strong><?php if(isset($loginName)) echo $loginName; ?></strong></h1>
            </div>


            <div id="page-menu-wrap">

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
                

                    

                 ?>
                 
						<h3>Admins</h3>

           

<!--%%%%%%%%%%%%%%%% HERE DISPLAY TABLE %%%%%%%%%%%%%%%%% -->
    
    
    <table class="table table-striped table-bordered">
    <tr>
        <th>ID</th>
        <!-- <th>Picture</th> -->
        <th>Name</th>
        <th>Email</th>
        <!-- <th>Edit</th>
        <th>Delete</th> -->
    </tr>
    <?php

        $query = "SELECT * FROM `admin`";

        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) > 0){
        
                        // We have data 
                        // output the data
         while( $row = mysqli_fetch_assoc($result) ){
                echo "<tr>";
echo   "<td>".$row["admin_id"]."</td> <td>".$row["name"]."</td> <td> ".$row["email"]."</td>";

                // echo '<td><a href="updateadmin.php?id='.$row['admin_id']. '" type= "button" class="btn btn-primary btn-sm">
                // <span class="icon-edit"></span></a></td>';
                
                // echo '<td><a href="home.php?delid='.$row['admin_id']. '" type= "button" class="btn btn-danger btn-sm">
                // <span class="icon-trash2"></span></a></td>';

                echo "<tr>";  
            }
    } else {
        echo "<div class='alert alert-danger'>You have no admin<a class='close' data-dismiss='alert'>&times</a></div>";
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


?>