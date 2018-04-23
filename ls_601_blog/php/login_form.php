<style type="text/css">
		.alert{
			display: none;
		}
</style>
<h3 class="text-center text-urban">ls_601_blog Login</h3>
		<div class="container-fluid form-container" style="margin-top: 50px;">
			<div class="alert alert-primary text-center">
				<p id="alertMessage"></p>
			</div>
			<form class="form-horizontal" role="form" method="post" action="<?php $_PHP_SELF;?>">
			    <div class="form-group">
				      <label class="control-label col-sm-12" for="email">Email or Username:</label>
				      <div class="col-sm-12">
				        <input type="text" class="form-control" id="useridentity" name="useridentity" placeholder="Email or Username" autocomplete="off">
				      </div>
			    </div>
			    <div class="form-group">
			      <label class="control-label col-sm-2" for="pwd">Password:</label>
			      <div class="col-sm-12">          
			        <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Enter password">
			      </div>
			    </div>
			    <div class="form-group">        
			      <div class="col-md-12">
			        <button type="submit" class="btn btn-primary form-control" name="btnLogin">Login</button>
			      </div>
			    </div>
			    <div class="form-group">
			      <div class="col-md-12">
			      	<label style="font-size:.86em; color:#ad0000;">Don't Have an Account?</label>
			        <button type="submit" class="btn btn-danger form-control" name="btnregister">Register</button>
			      </div>
			    </div>
			</form>
		</div>

<?php
	
if(isset($_POST['btnLogin'])){
	$setup = 0;
	$acc = strtolower($_POST['useridentity']);
	$pass = strtolower(md5($_POST['pwd']));
	$sql = "SELECT dateRegistered,blog_name,setup,accno,uemail,username,password from accounts where 
	username = '$acc' and  password ='$pass' or
	uemail = '$acc' and password = '$pass'
	LIMIT 1";
	$exe = $con->query($sql);
	if($exe == true){
		if($row = $exe->num_rows > 0){
			while ($r = $exe->fetch_assoc()) {
				$_SESSION['useridentity'] = $r['accno'];
				$_SESSION['useridentityconf'] = $r['dateRegistered'];
				$_SESSION['blog_name'] = $r['blog_name'];
				$setup = $r['setup'];
			}
			if($setup == 1){
				?> 
				<script type="text/javascript">
				$(".alert").slideDown('fast').show(1000).delay(2000).slideUp('fast').hide(2000);
				$("#alertMessage").html("Set your Personal Information");
				window.location = "firstimesetup.php";
				</script>
				<?php
			}
			else{
				?> 
				<script type="text/javascript">
				$(".alert").slideDown('fast').show(1000).delay(2000).slideUp('fast').hide(2000);
				$("#alertMessage").html("Setting up your account");
				window.location = "ls_601_userpage.php";
				</script>
				<?php
			}
		}
		else{
			?> 
			<script type="text/javascript">
				$(".alert").slideDown('fast').show(1000).delay(2000).slideUp('fast').hide(2000);
				$("#alertMessage").html("There is no such User");
			</script>
			<?php
		}
	}
	else{
		echo die(mysqli_error($con));
	}
}
if(isset($_POST['btnregister'])){
	header("Location:index.php?page=register_form");
}
?>