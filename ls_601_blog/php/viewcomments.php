<?php
	require 'connection.php';
	$postid = $_POST['postid'];
	$sql= "SELECT blog_name, accno,commentby,comment from postcomments
		join accounts 
		on accno = commentby
	 where postid = '$postid'";
	$exe = $con->query($sql);
	if($exe == true)
	{
		if($row = $exe->num_rows > 0){
			while ($r = $exe->fetch_assoc()) {
				?> 
					<div class="panel p-comments">
						<div class="panel-header">
							<a href="<?php echo $r['blog_name'];?>"><i class="fa fa-user"></i>
							<?php echo $r['blog_name'];?></a>
						</div>
						<div class="panel-body">
							<?php echo $r['comment'];?>
						</div>
					</div>
				<?php
			}
		}
	}
	else{
		echo die(mysqli_error($con));
	}

?>