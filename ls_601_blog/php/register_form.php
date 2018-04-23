<style type="text/css">
		.alert{
			display: none;
		}
</style>
<h3 class="text-center text-urban">ls_601_blog Register</h3>
		<div class="container-fluid form-container" style="margin-top: 50px;">
			<div class="alert alert-primary text-center">
				<p id="alertMessage"></p>
			</div>
			<form class="form-horizontal" role="form" method="post" action="<?php $_PHP_SELF;?>">
			    <div class="form-group">
				      <label class="control-label col-sm-5" for="email">User Name:</label>
				      <div class="col-sm-12">
				        <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username" pattern=".{5,50}" title="insert 5 to 15 characters" required="true" autocomplete="off">
				      </div>
			    </div>
			    <div class="form-group">
				      <label class="control-label col-sm-5" for="email">Site Name:</label>
				      <div class="col-sm-12">
				        <input type="text" class="form-control" id="blogname" name="blogname" placeholder="Ex: ls_601_kevin_blog" pattern=".{5,50}" title="insert 5 to 15 characters" required="true" autocomplete="off">
				      </div>
			    </div>
			    <div class="form-group">
				      <label class="control-label col-sm-2" for="email">Email:</label>
				      <div class="col-sm-12">
				        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required="true" autocomplete="off">
				      </div>
			    </div>
			    <div class="form-group">
			      <label class="control-label col-sm-2" for="pwd">Password:</label>
			      <div class="col-sm-12">          
			        <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Enter password" autocomplete="off">
			      </div>
			    </div>
			    <div class="form-group">
			      <div class="col-md-12">
			        <button type="submit" class="btn btn-success form-control" name="btnregister">Register</button>
			      </div>
			    </div>
			    <div class="form-group">        
			      <div class="col-md-12">
			      	<p>already have an account? login <a href="index.php?page=login_form">here</a></p>
			      </div>
			    </div>
			    
			</form>
		</div>

<?php 
	if(isset($_POST['btnregister'])){
		$randno = accnoGenerator();
		$uemail = strtolower($_POST['email']);
		$username = strtolower($_POST['username']);
		$password = strtolower(md5($_POST['pwd']));
		$blogname = strtolower($_POST['blogname']);
		$search = "SELECT uemail,username from accounts where uemail = '$uemail' or username = '$username' or blog_name = '$blogname'";
		$exesearch = $con->query($search);
		if($exesearch == true)
		{
			if($row = $exesearch->num_rows > 0 ){
				?>
				<script type="text/javascript">
				$(".alert").slideDown('fast').show(1000).delay(2000).slideUp('fast').hide(2000);
				$("#alertMessage").html("The Email or Username is already Taken");
				</script> 
				<?php
				return false;
			}
			else{
				$sql = "INSERT INTO accounts(accno,blog_name,uemail,username,password) " .
					"VALUES('$randno','$blogname','$uemail','$username','$password')";
					$exe = $con->query($sql);
					if($exe == true){
						?> 
						<script type="text/javascript">
							alert("registered");
							window.location="index.php";
						</script>
						<?php
					}
			}
		}
		

	}
?>