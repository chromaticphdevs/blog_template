<?php 
	require 'connection.php';
	if(!isset($_SESSION['useridentity'])){
		header("Location:../index.php");
	}
	$data = array();
	$accno = $_SESSION['useridentity'];
	$confirm = $_SESSION['useridentityconf'];
	$fetchUser = "SELECT ac.accno ,dateRegistered, blog_name,mname,username, uemail,gender, DATE_FORMAT(bdate, '%M/%w/%Y') as date,
				concat(acinfo.fname,' ',acinfo.lname) as fullname,
                case
                	when gender = 1 then 'Male'
                    else 'female'
                    end as gender
				from accounts as ac inner JOIN
				accountpersonalinformation as acinfo
				on ac.accno = acinfo.accno

				where ac.accno = '$accno' and dateRegistered = '$confirm'";
	$exe = $con->query($fetchUser);
	if($exe == true)
	{
		if($row = $exe->num_rows > 0){
			while($r = $exe->fetch_assoc()){
				$data[] = $r;
			}
		}
	}
	else{
		echo die(mysqli_error($con));
	}

 ?>
     <?php  
    	if(isset($_GET['btnpost'])){
    		$createpost = $_GET['createpost'];
    		if(empty($createpost)){
    			return false;
    		}
    		else
    		{
    		$sql = "INSERT INTO userposts(postby,postval)".
	    		"VALUES('$accno','$createpost')";
		    		$exe = $con->query($sql);
		    		if($exe != true){
		    			return false;
		    		}
    		}
    	}
    	if(isset($_GET['delete'])){
    		$id = $_GET['postid'];
    		$sql= "DELETE FROM userposts where postid = $id";
    		$exe = $con->query($sql);
    	}
    ?>
<!DOCTYPE html>
<html>
<head lang="en">
	<title>Ls_601_blog | KEVIN</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<?php include 'headers.php';?>
	<style type="text/css">
		body{
			font-family:raleway;
			background-color: #eeeeee;
		}
		.bg-dark{
			background-color: #1063a2 !important;
		}
		.form-container{
			background-color: #fff;
			padding: 20px 10px;
			border-radius: 5px;
		}
		.btn{
			cursor: pointer;
		}
		.text-urban{
			color: #034F84;
		}
		.post-panel{
			padding:10px 20px;
			background-color: #fff;
		}
		.post-panel input[type="submit"]{
			width: 70px;
			color: #fff;
			background-color: #0d38a4;
		}
		.post-panel input[type="submit"]:hover{
			cursor: pointer;
			background-color: #0a2d87;
		}
		.postdiv{
			margin-top: 10px;
			padding:10px 20px;
			border: 1px solid #3d4044;
			background-color: #fff;
		}
		.profile{
			width: 100%;
			margin-bottom: 25px;
			text-align: center;
		}
		.profile img{
			width: 100px;
			border: 2px solid #eeeeee;
			border-radius: 10px;
		}
		.btn-settings{
			cursor: pointer;
			color: #fff;
			background-color: #0d38a4;
		}
		.btn-settings:hover{
			cursor: pointer;
			background-color: #0a2d87;
		}
		#content{
			height: 100vh;
			overflow-x: scroll;
		}
		.shrinked > *{
			font-size: .89rem;
		}
		.shrinked{
			background-color: #fff;
		}
		.btn-delete{
			background-color: #940808;
			color: #fff;
			padding: 2px;
		}
		.sm{
			font-size: .70em;
		}
		.alert{
			display: none;
		}
		tr td:nth-child(1){
			font-weight: bold;
			color: #0d38a4;
		}
		tr td:nth-child(2){
			color: #0d38a4;
		}
		.hidea{
			color: red;
		}
		form input[type="text"]{
			width: 80%;
			font-size: .86em;
			padding: 5px 10px;
		}
		form button{
			width: 10%;
			font-size: .86em;
			padding: 5px 10px;
		}
		.p-comments{
			border: 1px solid #000;
			padding: 5px 10px;
			margin-top: 5px;
		}
		.p-comments .panel-header{
			font-size: 9pt;
			font-weight: bold;
			color: #007E33;
		}
	</style>
</head>
	<body>
		<div style="margin-top: 100px;">
<!-- Modal -->
	<?php
		include 'modalsettings.php';
		include 'modal_personal.php';
	?>
		</div>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
	      <div class="container">
	        <a class="navbar-brand" href="#">ls_601_blog</a>
	        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
	          <span class="navbar-toggler-icon"></span>
	        </button>
	        <div class="collapse navbar-collapse" id="navbarResponsive">
	          <ul class="navbar-nav ml-auto">
	            <li class="nav-item active">
	              <a class="nav-link" href="#">Home
	                <span class="sr-only">(current)</span>
	              </a>
	            </li>
	            <li class="nav-item">
	              <a class="nav-link" href="logout.php">Logout</a>
	            </li>
	          </ul>
	        </div>
	      </div>
    </nav>
    <div class="container-fluid" style="margin-top: 60px;">
    	<div class="row">
    		<!-- start of aside -->
    		<div class="col-md-3 shrinked" id="fixed_aside">
    			<table class="table">
    				<tr>
    					<?php
    						$totalcount = 0;
    						$total = "SELECT count(*) as total from userposts where postby = '$accno'";
    						$exe=$con->query($total);
    						if($exe == true){
    							while($r = $exe->fetch_array()){
    								$totalcount = $r;
    							}
    						}
    					?>
    					<td>Total Posts</td>
    					<td><?php echo $totalcount[0];?></td>
    				</tr>
    				<tr>
    					<td>Email</td>
    					<td>
    					<?php 
    					$test =strlen($data[0]['uemail']);
    					if($test > 10){
    						echo substr($data[0]['uemail'], 0,15).'...';
    					}
    					else{
    						echo $data[0]['uemail'];
    					}
    					?></td>
    				</tr>
    				<tr>
    					<td>Username</td>
    					<td><?php echo $data[0]['username'] ;?></td>
    				</tr>
    				<tr>
    					<td>Blog name</td>
    					<td><?php echo $data[0]['blog_name'] ;?></td>
    				</tr>
    				<tr style="text-transform:capitalize;">
    					<td>Fullname</td>
    					<td><?php echo $data[0]['fullname'] ;?></td>
    				</tr>
    				<tr>
    					<td>Middle name</td>
    					<td><?php echo $data[0]['mname'] ;?></td>
    				</tr>
    				<tr>
    					<td>Gender</td>
    					<td><?php echo $data[0]['gender'] ;?></td>
    				</tr>
    				<tr style="text-overflow:ellipsis;">
    					<td>Birthday:</td>
    					<td><p><?php echo $data[0]['date'] ;?></p></td>
    				</tr>
    				<tr>
    						<td><button class="btn btn-sm btn-settings" name="edit" id="edit" data-toggle="modal" data-target="#myModal"><i class="fa fa-gear"></i> <span>Login Settings</span></button></td>
    						<td><button class="btn btn-sm btn-settings" name="edit" id="edit" data-toggle="modal" data-target="#personalModal"><i class="fa fa-gear"></i> <span>Personal Settings</span></button></td>
    				</tr>
    			</table>
    		</div>
    		<!-- end of aside -->
    		<!-- start of add post -->
    		<div class="col-md-8 col-sm-offset-1" id="content">
    			<div class="panel post-panel">
    				<div class="panel-body">
    					<div class="row">
    					<div class="col-md-6">
    					<li class="fa fa-user"></li>
    					<label class="text-right">create post as  <span class="text-primary"><?php echo $data[0]['username'] ;?></span></label>
    					</div>
    					<div class="col-md-6 text-right">
    						<label>today:  <span class="text-success"><?php echo date('m/d/y')?></span></label>
    					</div>
    					</div>
    				</div>
    				<form class="form" method="get">
    					<div class="form-group">
    						<input type="text" name="createpost" id="createpost" placeholder="addpost" class="form-control">
    					</div>
    					<div class="row">
    						<div class="col-md-6">
    							<!-- Display if user focused the form-->
    							<!-- <p>Post Total Words <span id="words">125</span> Characters <span>1000</span></p>-->
    						</div>
    						<div class="col-md-6 text-right">
    							<input type="submit" name="btnpost" id="btnpost" value="Post" class="btn btn-md">
    						</div>
    					</div>
    				</form>
    			</div>
    			<hr>
    			<div class="alert">
    				<p id="alertMessage"></p>
    			</div>
    			<?php 
    				$accno = $_SESSION['useridentity'];
    				$sql = "SELECT  postid,postby ,DATE_FORMAT(dateposted, '%w-%m-%y at %h:%m') as dateposted,postval from userposts where postval != '' and postby = '$accno' order by dateposted DESC";
    				$exe = $con->query($sql);
    				if($exe == true)
    				{
    					if($row = $exe->num_rows > 0){
    						while ($r = $exe->fetch_assoc()) {
    						echo ('<div class="panel postdiv">
				    				<div class="row postwidget">
				    					<div class="col-md-6 sm">
				    					<li class="fa fa-clock-o"></li>
				    					<label class="text-right">Posted On: <span class="text-primary">'.$r["dateposted"].'</span></label>
				    					</div>
				    					<div class="col-md-6 text-right">
				    						<form method="get">
				    							<input type="hidden" name="postid" value='.$r["postid"].'>
				    							<input type="submit" name="delete" value="delete" class="btn btn-delete">	
				    						</form>
				    					</div>
				    				</div>	
				    				<p>'.$r["postval"].'</p>
				    				<form method="post">
										<input type="hidden" name="postid" value='.$r["postid"].'>
					    				<input type="text" name="commentval" placeholder="comment">
										<button type="submit" class="btn-primary" name="btncomment">
										<i class="fa fa-reply" style="color: #fff;"></i></button>
				    				</form>
									<a href="#" id="comments'.$r["postid"].'" onclick="viewcomments(this.id)">View Comments</a>
									<a href="#" id="hide'.$r["postid"].'" class="hidea" onclick="hideComments(this.id)">Hide Comments</a>
									<div class="postcomments" id ="post'.$r["postid"].'"></div>
				    			</div>');
    						}
    					}
    					else{
    						echo '<div class="panel postdiv">
				    			  <p>You have no posts yet</p>
				    			  </div>';
    					}
    				}
    			 ?>
    		</div>
    		<!-- end of add post -->
    	</div>
    	<!-- post Content -->
    </div>
    <?php
    	if(isset($_POST['btncomment'])){
    		$postid = $_POST['postid'];
    		$comment = $_POST['commentval'];
    		$sql = "INSERT INTO postcomments(postid,postby,commentby,comment) ". 
    		"VALUES('$postid','$accno','$accno','$comment')";
    		$exe = $con->query($sql);
    	}

    ?>
    <script type="text/javascript">
		 	function viewcomments(id){
		 		var res = id.replace("comments", "post");
		 		var postid = parseInt(id.replace("comments",""));
		 		$("#"+res).load('viewcomments.php',{postid:postid});
		 		$("#"+res).css("display","block");
		 	}
		 	function hideComments(id){
		 		var res = id.replace("hide", "post");
		 		$("#"+res).css("display","none");
		 	}
	</script>
	</body>
</html>