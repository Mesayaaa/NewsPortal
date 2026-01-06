<?php
require('./includes/nav.inc.php');

if (isset($_POST['submit'])) {

  if (isset($_SESSION['ADMIN_ID'])) {
    $admin_id = $_SESSION['ADMIN_ID'];
  } else {
    redirect_with_alert('./login.php', "Please login to access the Admin Portal", "warning", "Access Denied");
  }

  $old_password = $_POST['old_password'];
  $new_password = $_POST['new_password'];
  $confirm_new_password = $_POST['confirm_new_password'];

  $str_new_pass = password_hash($new_password, PASSWORD_BCRYPT);

  $sql = "SELECT * FROM admin 
            WHERE admin_id = {$admin_id}";
  $result = mysqli_query($con, $sql);
  $rows = mysqli_num_rows($result);
  if ($rows > 0) {
    $data = mysqli_fetch_assoc($result);
    $password_check = password_verify($old_password, $data['admin_password']);
    if ($password_check) {
      $update_sql = " UPDATE admin
                        SET admin.admin_password = '{$str_new_pass}'
                        WHERE admin_id = {$admin_id}";

      $update_result = mysqli_query($con, $update_sql);
      if (!$update_result) {
        alert("Sorry. Please try again later!", "error", "Error!");
      } else {
        alert("Password Updated !", "success", "Success");
      }
    } else {
      alert("Wrong Password. Try again !", "error", "Error");
    }
  } else {
    alert("Wrong Password. Try again !", "error", "Error");
  }
}
?>

<section id="breadcrumb">
  <div class="container">
    <ol class="breadcrumb">
      <li><a href="./index.php">Dashboard</a></li>
      <li class="active">Change Password</li>
    </ol>
  </div>
</section>

<section id="main">
  <div class="container">
    <div class="row">
      <?php
      require('./includes/quick-links.inc.php');
      ?>
      <div class="col-md-9">
        <div class="panel panel-default">
          <div class="panel-heading main-color-bg">
            <h3 class="panel-title">Change Password</h3>
          </div>
          <div class="panel-body">
            <form method="post" id="change_pass_form">
              <div class="form-group">
                <label>Old Password</label>
                <input type="password" autocomplete="off" class="form-control" placeholder="Old Password"
                  name="old_password" id="old_password" required />
              </div>
              <div class="form-group">
                <label>New Password</label>
                <input type="password" autocomplete="off" class="form-control" placeholder="New Password"
                  name="new_password" id="new_password" required />
              </div>
              <div class="form-group">
                <label>Confirm New Password</label>
                <input type="password" autocomplete="off" class="form-control" placeholder="Confirm New Password"
                  name="confirm_new_password" id="confirm_new_password" required />
              </div>
              <br>
              <div class="text-center">
                <button type="submit" name="submit" class="btn btn-success">Update</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="../assets/js/admin/change-pass-validate.js"></script>
</section>

<?php
require('./includes/footer.inc.php')
  ?>