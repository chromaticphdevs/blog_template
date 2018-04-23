<?php
	require 'connection.php';
	if(!isset($_SESSION['useridentity'])){
		header("Location:index.php");
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
		#bdate span{
			font-size: .70em;
			font-weight: bold;
			color: #232425;
		}
	</style>
</head>
	<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
	      <div class="container">
	        <p style="color: #fff;">First time setup</p>
	      </div>
    </nav>
    <div class="container col-md-4" style="margin-top: 100px">
    	<h3 class="text-center text-urban">Your Almost Done!</h3>
		<div class="container-fluid form-container" style="margin-top: 50px;">
			<form class="form-horizontal" role="form" method="post" action="<?php $_PHP_SELF;?>">
			    <div class="form-group">
				      <label class="control-label col-sm-5" for="email">First Name:</label>
				      <div class="col-sm-12">
				        <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" pattern=".{2,100}" title="insert atleast 5 characters"
				        required="true" autocomplete="false">
				      </div>
			    </div>
			    <div class="form-group">
				      <label class="control-label col-sm-5" for="email">Last Name:</label>
				      <div class="col-sm-12">
				        <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" pattern=".{2,100}" title="insert atleast 5 characters"

				        required="true" autocomplete="false">
				      </div>
			    </div>
			     <div class="form-group">
			      <label class="control-label col-sm-2" for="pwd" id="bdate">Birthdate: <span>Month/date/year</span></label>
			      <div class="col-sm-12">       
			       <select id="month" name ="month" class="col-sm-3">
	
			       </select>
			       <select id="day" name="day" class="col-sm-3">
			       	
			       </select>
			       <select id="year" name="year" class="col-sm-3">
			       	
			       </select>
			      </div>
			    </div>
			    <div class="form-group">
			      <label class="control-label col-sm-2" for="pwd">Gender:</label>
			      <div class="col-sm-12">          
			        <input type="radio" value="1" name="gender" checked>  Male
			        <input type="radio" value="2" name="gender"> Female
			      </div>
			    </div>
			   
			    <div class="form-group">
			      <div class="col-md-12">
			        <button type="submit" class="btn btn-success form-control" name="btnregister">Done</button>
			      </div>
			    </div>
			</form>
		</div>
	</div>
	<script type="text/javascript">
		$(function(){

			var dates = ['','jan','feb','mar','apr','may',
			'june','jul','aug','sept','oct','nov','dec'];
			var ryear = "" , rday =0,rmnth="";

			for(var i = 1 ; i < dates.length; i++){
			    rmnth += '<option value='+i+'>' + dates[i]+ '</option>';
			}
			for(var i = 1920 ; i < 2018 ; i++){
				ryear += '<option value='+i+'>' +i+ '</option>';
			}
			for(var i = 1 ; i < 32 ;i++){
				rday += '<option value='+i+'>' +i+ '</option>';
			}
			$("#year").html(ryear);
			$("#day").html(rday);
			$("#month").html(rmnth);
		});
	</script>

	<?php
		if(isset($_POST['btnregister']))
		{
			$accno = $_SESSION['useridentity'];
			$fname = strtolower(mysql_real_escape_string($_POST['fname']));
			$lname = strtolower(mysql_real_escape_string($_POST['lname']));
			$day = $_POST['day'];$year = $_POST['year']; $month = $_POST['month'];
			$date = $year.'-'.$month.'-'.$day;
			$gender = $_POST['gender'];
			$sql = " INSERT INTO accountpersonalinformation(accno,fname,lname,gender,bdate) ".
			"VALUES('$accno','$fname','$lname','$gender','$date')";

			$exe = $con->query($sql);
			if($exe == true)
			{
				$update = "UPDATE accounts set setup = 0 where accno = '$accno'";
				$exe = $con->query($update);
				if($exe == true){
				require 'create_dir.php';
					?> 
						<script type="text/javascript">
							alert("DONE");
							window.location ="ls_601_userpage.php";
						</script>
					<?php
				}
			}
			else{
				echo mysqli_error($con);
			}
		}
	?>
	</body>

</html>