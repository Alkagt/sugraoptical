<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "connection.php";
$page = 'login'; 
if(isset($_POST['login_btn'])){
	$email = $_POST['email'];
	$password = $_POST['password'];
	$query = "select * from register where user_email='".$email."' and password='".$password."'";
	$result = mysqli_query($conn,$query);
	if (mysqli_num_rows($result)>0) {
     while($row = mysqli_fetch_assoc($result)){
		$_SESSION['user_id'] = $row['user_id'];
		header("location:dashboard.php");
	 }
	} else {
		echo ' <div class="alert alert-danger alert-dismissible fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Sorry!</strong> Your credentials are wrong.
  </div>' . mysqli_error($conn);
	}
}
include "header.php";
?>

<div class="login-wrapper">
    <div class="login-box">
        <h3>Admin Login</h3>

        <form method="post" action="">
            <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>

            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>

            <button type="submit" name="login_btn" class="btn btn-login btn-block">Login</button>
        </form>

        <div class="login-footer">
            <a href="#">Forgot Password?</a>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>
