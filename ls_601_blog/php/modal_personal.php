<?php
  $acc = $_SESSION['useridentity'];
  $forupdate = array();
  $sql = "SELECT * FROM accountpersonalinformation where accno = '$acc' ";
  $exe = $con->query($sql);
  if($exe == true){
      while ($r = $exe->fetch_assoc()) {
        $forupdate[] = $r;
      }
  }
?>
<?php
  if(isset($_POST['btnupdate2'])){
    $myacc = $_SESSION['useridentity'];
    $fname = mysql_real_escape_string($_POST['fname']);
    $lname = mysql_real_escape_string($_POST['lname']);
    $mname = mysql_real_escape_string($_POST['mname']);
    $search = "SELECT username , password from accounts where accno = '$acc' and username = '$mname'";
    $exe = $con->query($sql);
    if($exe == true){
      $sql = "UPDATE accountpersonalinformation SET fname = '$fname', lname = '$lname', mname = '$mname'";
      $exe = $con->query($sql);
    }
    
  }
?>
<div id="personalModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Personal Modal</h4>
        <button type="button" class="close" data-dismiss="modal" style="float:right; cursor: pointer;">&times;</button>
      </div>
      <div class="modal-body">
        <form action="<?php $_PHP_SELF;?>" method="POST">
            <div class="form-group">
              <label class="control-label col-sm-12" for="email">First Name</label>
              <div class="col-sm-12">
                <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" value="<?php echo $forupdate[0]['fname']?>" patern=".{3,30}">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-12" for="email">Last Name</label>
              <div class="col-sm-12">
                <input type="text" class="form-control" id="lname" name="lname" placeholder="First Name" value="<?php echo $forupdate[0]['lname']?>" patern=".{3,30}">
              </div>
            </div>
             <div class="form-group">
              <label class="control-label col-sm-12" for="email">Middle Name</label>
              <div class="col-sm-12">
                <input type="text" class="form-control" id="mname" name="mname" placeholder="Username" value="<?php echo $forupdate[0]['mname']?>" patern=".{3,30}">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12">
                <input type="submit" name="btnupdate2" value="update" class="btn btn-success form-control">
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