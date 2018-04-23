<?php 
	require '../connection.php';
	$path = pathinfo('index.php');
	$mypath = array();
	$mypath = explode('\\', getcwd());
	$c = count($mypath);
	$blog_name = $mypath[$c-1];
	$datas = array();
	if(isset($_SESSION['useridentity'])){
		$sql = "SELECT * from accounts 
		where blog_name = '$blog_name'";
		$exe = $con->query($sql);
		if($exe == true)
		{
			if($row = $exe->num_rows > 0)
			{
				while($r = $exe->fetch_assoc()){
					$datas[] = $r;
				}
			}
			else{
				echo "NO ACCOUNT";
			}
		}
		else{
			die(mysqli_error());
		}
		if($_SESSION['useridentity'] == $datas[0]['accno'])
		{
			header("Location:../index.php");
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>doctype</title>
	<link href="../../cssfile/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../../font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../../fontawesome/css/font-awesome.min.css">
	 <!-- Bootstrap core JavaScript -->
	<script src="../../cssfile/jquery/jquery.min.js"></script>
	<script src="../../cssfile/popper/popper.min.js"></script>
	<script src="../../cssfile/bootstrap/js/bootstrap.min.js"></script>
	<style type="text/css">
		*{
			margin: 0px;
			padding: 0px;
		}
		body{
			margin: 0px;
			padding: 0px;
			font-family: "raleway";
			line-height: 120%;
		}
		header{
			background-color: #1063a2 !important;
			color: #fff;
			width: 100%;
			padding: 20px 30px;
		}
		.article{
			text-align: center;
			text-transform: capitalize;
			padding: 10px;
		}
		section article > * {
			margin: 20px;
		}
		.panel-widget > *{
			font-size: .76em;
			font-weight: bold;
		}
		.panel-widget{
			border-bottom: 4px solid #eeeeee;
		}
		.post-panel{
			border: 1px solid #2b3033;
			padding: 5px;
		}
		.post-panel p {
			font-family: "lato";
			font-size: 1.2em;
			font-weight: bold;
			color: #2b3033;
			border-bottom: 2px solid  #2b3033;
		}
		form input[type="text"]{
			width: 80%;
			font-size: .86em;
			padding: 5px 10px;
		}
		form button{
			width: 15%;
			font-size: .86em;
			padding: 5px 10px;
		}
		.row > div {
			margin-top: 10px;
		}
		.homelink:hover, .homelink:active , .homelink{
			color: #fff;
			cursor: pointer;
		}
		.icons{
			width: 150px;
			background-color: #a2103a;
			padding: 10px 20px;
			display: none;
		}
		.icons:hover{
			box-shadow: 1px 1px 1px #000;
			cursor: pointer;
		}
		.icons > * {
			color: #fff;
			font-size: .80em;
		}
		.icons a:hover{
			color: #fff;
			text-decoration: underline;
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
		form a {
			font-size: .80em;
			font-weight: bold;
		}
		form a:nth-of-type(2){
			color: red;
		}
	</style>
</head>
	<body>
		<?php
			$items = array();
			$gender = 0;
			$blogname = "";
			$getDatas = "SELECT ac.username ,ac.accno, us.postby , us.postval ,us.dateposted as dateposted, us.postid  from accounts ac
						join userposts as us on ac.accno = us.postby WHERE
						ac.blog_name = '$blog_name'";
			$exe = $con->query($getDatas);
			if($exe == true){
				if($row = $exe->num_rows > 0 ){
					while($r = $exe->fetch_assoc()){
						$items[] = $r;
					}
				}
				else{
					$items = "No posts";
				}
			}
			$getGender = "SELECT gender , username , blog_name from accounts ac
			join accountpersonalinformation as aci on aci.accno = ac.accno where
			ac.blog_name ='$$blog_name'";

			$execute = $con->query($getGender);
			if($execute == true){
				while ($r = $execute->fetch_assoc()) {
					$gender = $r['gender'];
					$blogname = $r['blogname'];
				}
			}
		?>
		<header>
			<h2>
				<?php 
					if( ! isset($_SESSION['useridentity'])){
						echo '<a href="../index.php" class="homelink">ls_601_blog</a>';
					}
					else{
						echo '<a href="../index.php" class="homelink">Return</a>';
					}
				?>
			</h2>
			<div class="icons"><a href="../index.php" id="register">Create Account</a> <i class="fa fa-hand-o-left"></i></div>
		</header>
		<section>
			<article class="article">
				<h2>
					<?php echo $blog_name;?>
				</h2>
					<?php
						if($gender == 1){
							echo '<p>'."Welcomes you to his personal Blog".'</p>'; 
						}
						else{
							echo '<p>'."Welcomes you to her personal Blog".'</p>'; 
						}
					?>
			</article>
			<article class="container col-md-9">
				<?php
					echo '<div class="row">';
					if($items == "No posts")
					{
						echo "no Posts yet";
					}
					else{
						for($i = 0 ; $i < count($items) ; $i++){
						echo ('<div class="col-md-12">
							<div class="panel post-panel">
								<div class="panel-widget">
									<div class="col-md-12">
					    				<i class="fa fa-clock-o"></i>
					    				<label class="text-right">Posted On: <span class="text-primary">'.
					    				$items[$i]["dateposted"].'</span></label>
					    			</div>
								</div>
								<p>'.$items[$i]["postval"].'</p>
								<form class="form" method="post">
									<input type="hidden" name="postby" value='.$items[$i]["postby"].'>
									<input type="hidden" name="postid" value='.$items[$i]["postid"].'>
									<input type="text" name="commentval" placeholder="comment">
									<button type="submit" class="btn-primary" name="btncomment"><i class="fa fa-reply" style="color: #fff;"></i></button>
									<br/>
									<a href="#" id ="comments'.$items[$i]["postid"].'" onclick="viewcomments(this.id)">View Comments</a>
									<a href="#" id="hide'.$items[$i]["postid"].'" class="hidea" onclick="hideComments(this.id)">Hide Comments</a>
								</form>
							</div>

							<div class="postcomments" id ="post'.$items[$i]["postid"].'">

							</div>
						</div>');
						}
					}
					
					echo '</div>';	
				?>
			</article>
		</section>
		<footer>
			
		</footer>
		<?php 

				/*
				if( isset($_POST['btncomment'])){
					echo "COMMENTED". $_POST['postid'].'<br/>'.$_POST['postby'];
				}
				*/

				if(isset($_POST['btncomment']))
				{
					echo 
					$postid = $_POST['postid'];
					$commentby = $_SESSION['useridentity'];
					$comment = $_POST['commentval'];
					if(isset($_SESSION['useridentity']) && isset($_SESSION['useridentityconf']))
					{
						$sql = "INSERT INTO postcomments(postid,commentby,comment) " .
						"VALUES ('$postid','$commentby','$comment')";

						$exe = $con->query($sql);
						if($exe != true){
							?> 
							<script type="text/javascript">
								alert("There is an error upon Commenting");
							</script>
						<?php
						}
					}
					else{
						?> 
							<script type="text/javascript">
								$(function(){
									$(".icons").css("display","block");
								});
							</script>
						<?php
					}
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