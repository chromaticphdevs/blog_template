<?php
	require('connection.php');
	if ( isset($_SESSION['useridentity']) ) {
		header("Location:ls_601_userpage.php");
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
			margin: 0px;
			background-color: #eeeeee;
		}
		.bg-dark{
			background-color: #073f77 !important;
		}
		.content{
			border: 3px solid #3c70a5;
			border-radius: 10px;
			padding: 20px 10px;
			background-color: #fff;
			transition: .2s;
		}
		.content:hover{
			border: 3px solid #064b92;
		}
	</style>
</head>
<body>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
		      <div class="container">
		        <a class="navbar-brand" href="#">ls_601_blog</a>
		        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
		          <span class="navbar-toggler-icon"></span>
		        </button>
		        <div class="collapse navbar-collapse" id="navbarResponsive">
		          <ul class="navbar-nav ml-auto">
		            <li class="nav-item active">
		              <a class="nav-link" href="#">About</a>
		            </li>
		            <li class="nav-item">
		              <a class="nav-link" href="index.php?page=login_form">Login</a>
		            </li>
		            <li class="nav-item">
		              <a class="nav-link" href="index.php?page=register_form">Register</a>
		            </li>
		          </ul>
		        </div>
		      </div>
		  </nav>
		  <div class="container col-md-4" style="margin-top: 100px;">
		  	<div class="content">
		  		<?php

		  		if (isset($_GET['page'])) {
		  			$page = $_GET['page'];
		  			switch ($page) {
		  				case 'login_form':
		  					include 'login_form.php';
		  					break;
		  				case 'register_form':
		  					include 'register_form.php';
		  					break;
		  				default:
		  					include 'login_form.php';
		  					break;
		  			}
		  		}
		  		else{
		  			include 'login_form.php';
		  		}
		  	?>
		  	</div>
		  </div>
</body>
</html>