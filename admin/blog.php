<?php
  include('../include/config.php'); 
  include('header.php'); 
  session_start();
    
  if (!isset($_SESSION['admin_id'])) {
    echo '<script >';
    echo 'window.location="index.php"';
    echo '</script>';
    exit;
}
  else{
    $loginId = $_SESSION['admin_id'];
    
  }
 

    if( isset($_POST['submit']) ){

        if( isset($_POST['title']) && !empty($_POST['title'])){
            
              $title = mysqli_real_escape_string($conn,$_POST['title']);
            

          }else{
              $message_title = '<b class="text-danger text-center">Please fill the Name field</b>';
        }

        //Select Condition
        if(isset($_POST["contentsel"]) && !empty($_POST["contentsel"])){

                $option = $_POST["contentsel"];
        } else {
            $message_option = '<b class="text-danger text-center">Please select Option.</b>';
        }

        // Description Condition
        if( isset($_POST['content']) && !empty($_POST['content']) ){
            
            if(preg_match('/^[A-Za-z.\s]+$/',$_POST['content'])){
                    $content = mysqli_real_escape_string($conn,$_POST['content']);
            }else{

                $message_con = '<b class="text-danger text-center">Please enter valid post Content.</b>';
            }

        }else{
            $message_con = '<b class="text-danger text-center">Please fill the Post Content field.</b>';
        } 

         // Pic Condition
        if( (isset($_FILES["profilePic"]["name"]) && !empty($_FILES["profilePic"]["name"])) || (isset($_POST["link"]) && !empty($_POST["link"]))){

            if(isset($_FILES["profilePic"]["name"]) && !empty($_FILES["profilePic"]["name"])){

                $target_dir = "images/blog/";
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

            } else { // if picture not inserted
                $newfilename = $_POST["link"];
            }

        }else{ 
            $message_picture =  '<b class="text-danger">Please insert Picture OR video Link</b>';
        }

         // Today Date
        $postDate = date("F d, Y");

       
        if( ( isset($title) && !empty($title) ) && ( isset($newfilename) && !empty($newfilename) ) ){

            $insert_query = "INSERT INTO `blog` (postContent, postDate, admin, title, status, post) VALUES ('$content','$postDate','$loginId','$title','$option','$newfilename')";

                if(mysqli_query($conn, $insert_query)){
                   
                    header('Location: blog.php#end');
                }else{
                        $submit_message = '<div class="alert alert-danger">
                            <strong>Warning!</strong>
                            You are not able to submit please try later
                        </div>';
                }
        }



}

   /*  END CODE SUBMIT button */







if(isset($_GET['delid'])){

    $id = $_GET['delid'];

    $query2 = "SELECT * FROM `blog` WHERE id='$id' ";

    $result2 = mysqli_query($conn, $query2);

    if(mysqli_num_rows($result2) > 0){

         while( $row2 = mysqli_fetch_assoc($result2) ){
                
              if($row2['status'] == 'image'){

                $base_directory = "images/blog/";
                if(unlink($base_directory.$row2['post']))
                    $delVar = " ";  
            }
         }
    }

    $query = "DELETE FROM `blog` WHERE id='$id'";
    $result = mysqli_query($conn,$query);
    
    if($result){
    
        header("Location: blog.php?sucess=1");
    } else {
                 echo "Error".$query."<br>".mysqli_error($conn);
            }
}
?>

		<!--  ===========================  Document Wrapper =========================== -->
	<div id="wrapper" class="clearfix">

		<div id="vertical-nav">
			<div class="container clearfix">

				<nav>
					<ul>
						<li><a href="home.php"><i class="icon-home2"></i>Home</a></li>

                        <li><a href="categorie.php"><i class="icon-book2"></i>Categories</a></li>    

						<li><a href="courses.php"><i class="icon-book3"></i>Courses</a></li>

						<li><a href="content.php"><i class="icon-line-content-left"></i>Content</a> </li>

						<li class="current"><a href="blog.php"><i class="icon-blogger"></i>Blog</a></li>

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

                        if(isset($message_title) || isset($message_option) || isset($message_picture) || isset($submit_message) || isset($message_con) ){
                            echo "<div class='alert alert-danger'>";
                           
                            echo "Please fill the form carefully and correctly<br>";

                            echo "<a type='button' class='btn btn-default btn-sm' data-dismiss='alert'>Cancel</a>
                            </div>";    

                        }

                 ?>
                 
						<h3>Insert Post</h3>

                        <form action="" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="titleID1">Title</label>
                        <input type="text" id="titleID1" placeholder="Title" name="title" class="form-control">
                        <?php if(isset($message_title)){ echo $message_title; } ?>
                    </div>

                   
                <div class="form-group">                    
                        <label>Post Selection</label>
                        <select class="form-control"  name="contentsel" id="contentsel" onchange="showinput()">
                        <option value=" ">Select Option</option>
                    <?php 
                             $select = ["video","image"];
                             foreach ($select as $value) {
                    ?>

                    <option value="<?php echo $value; ?>" > <?php echo $value; ?>  </option>

                    <?php       
                        }
                    ?>

                </select>
            </div>
            <?php if(isset($message_option)) echo $message_option; ?>

                    <div id="data">
    

                    </div>
                    
                   
                    <div class="form-group">
                        <label for="contentID1">Post Content</label>
                        <textarea id="contentID1" class="form-control" 
                         name="content"></textarea>
                    </div>
                     <?php if(isset($message_con)) echo $message_con; ?>   
                    <div class="form-group">
                        <button name="submit" class="btn btn-block btn-success" type="submit">Submit</button>
                    </div>
                </form>


    
    
    <table class="table table-striped table-bordered">
    <tr>
        <th>ID</th>
        <th>Post</th>
        <th>Title</th>
        <th>Post Content</th>
        <th>Post Date</th>
        <!-- <th>Edit</th> -->
        <th>Delete</th>
    </tr>
    <?php

        $query = "SELECT * FROM `blog`";

        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) > 0){
        
                        //We have data 
                        //output the data
         while( $row = mysqli_fetch_assoc($result) ){
                echo "<tr>";
                echo "<td>".$row["id"]."</td>"; 
                if($row["status"]=='image'){

                    echo "<td><img src=images/blog/".$row["post"]." width='80px' height='80px'> </td> "; 
                 }else{ ?>


                            <td width="80" height="80"> <iframe width="80px" height="80px" src="https://www.youtube.com/embed/<?php echo $row['post']; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></a>
                             </td>


                <?php }   


                echo "<td>".$row["title"]."</td> <td> ".$row["postContent"]."</td><td> ".$row["postDate"]."</td>";

                // echo '<td><a href="updateblog.php?id='.$row['id'].'&admin='.$row['admin']. '" type= "button" class="btn btn-primary btn-sm">
                // <span class="icon-edit"></span></a></td>';
                
                echo '<td><a href="blog.php?delid='.$row['id'].'&admin='.$row['admin']. '" type= "button" class="btn btn-danger btn-sm">
                <span class="icon-trash2"></span></a></td>';

                echo "<tr>";  
            }
    } else {
        echo "<div class='alert alert-danger'>You have no posts.<a class='close' data-dismiss='alert'>&times</a></div>";
    }
    
        mysqli_close($conn);
    ?>

    
</table>


    



					</div><!-- .postcontent end -->


				</div>

			</div>

		</section><!-- #content end -->

<script>
function showinput(){
    var select = document.getElementById('contentsel');
    select = select.value;
        if(select=='video')
        {
            document.getElementById('data').innerHTML =  
            `<div class="form-group">
                        <label for="linkID1">Video Link</label>
                        <input type="url" id="linkID1" placeholder="Link" name="link" class="form-control">
                    </div>
                    <?php if(isset($message_picture)){ echo $message_picture; } ?>`;
        } else if(select=='image'){
            document.getElementById('data').innerHTML =  
            `<div class="form-group">
                        <label class="btn btn-success" for="my-file-selector">
                            <input id="my-file-selector" name="profilePic" type="file" style="display:none;" onchange="$('#upload-file-info').html($(this).val());">
                            Profile Picture
                        </label>
                        <span class='label label-success' id="upload-file-info"></span>
                        <?php if(isset($message_picture)){ echo $message_picture; } ?>
                    </div>`;
        } else {
            document.getElementById('data').innerHTML =  
            ``;
        }

    } 
</script>


<?php include('footer.php'); 

//}

?>