<?php
  $acc = $_SESSION['useridentity'];
  $forupdate = array();
  $sql = "SELECT * FROM accounts where accno = '$acc' ";
  $exe = $con->query($sql);
  if($exe == true){
      while ($r = $exe->fetch_assoc()) {
        $forupdate[] = $r;
      }
  }
?>
<?php
  if(isset($_POST['btnupdate'])){
    $myacc = $_SESSION['useridentity'];
    $uname = mysql_real_escape_string($_POST['useridentity']);
    $uemail = mysql_real_escape_string($_POST['uemail']);
    $pass = md5( mysql_real_escape_string($_POST['pwd']) );
    $search = "SELECT username , password from accounts where accno = '$acc' and username = '$uname'";
    $exe = $con->query($sql);
    if($exe == true){
      if($row = $exe->num_rows > 1){
      }
      else{
        $sql = "UPDATE accounts SET username = '$uname' , password = '$pass' , uemail = '$uemail' where accno ='$myacc'";
        $exe = $con->query($sql);
      }
    }
    
  }
?>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Change Settings</h4>
        <button type="button" class="close" data-dismiss="modal" style="float:right; cursor: pointer;">&times;</button>
      </div>
      <div class="modal-body">
        <form action="<?php $_PHP_SELF;?>" method="POST">
            <div class="form-group">
              <label class="control-label col-sm-12" for="email">Username</label>
              <div class="col-sm-12">
                <input type="text" class="form-control" id="useridentity" name="useridentity" placeholder="Username" value="<?php echo $forupdate[0]['username']?>" patern=".{3,30}">
              </div>
            </div>
             <div class="form-group">
              <label class="control-label col-sm-12" for="email">Email</label>
              <div class="col-sm-12">
                <input type="text" class="form-control" id="uemail" name="uemail" placeholder="Username" value="<?php echo $forupdate[0]['uemail']?>" patern=".{3,30}">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-12" for="email">Password</label>
              <div class="col-sm-12">
                <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Username" patter = ".{5,40}">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12">
                <input type="submit" name="btnupdate" value="update" class="btn btn-success form-control">
              </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
