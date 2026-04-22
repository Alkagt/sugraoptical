<?php
include "connection.php";
if(!isset($_SESSION['user_id'])){
	header("location: login.php");
    exit();	
}
$userid = $_SESSION['user_id'];  
$sql = "select * from register where user_id='".$userid."'";
$result = mysqli_query($conn,$sql);
if(mysqli_num_rows($result)>0){
	while($rows = mysqli_fetch_assoc($result)){
		$_SESSION['user_name'] = $rows['user_name'];
		$_SESSION['user_email'] = $rows['user_email'];
	}
}
include "header.php";
?>

    <div class="user-dashboard dashboard-all-content">
        <div class="titles">
             <h1>Welcome to Dashboard</h1>
              <h2>Hello, <?php echo $_SESSION['user_name']; ?></h2>
        </div>


                <div class="content">
                   <div class="card">
                        <div class="sales">
                                <h2>Your Sale</h2>

                                <div class="btn-group">
                                    <button class="btn btn-secondary btn-lg dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span>Period:</span> Last Year
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="#">2012</a>
                                        <a href="#">2014</a>
                                        <a href="#">2015</a>
                                        <a href="#">2016</a>
                                    </div>
                                </div>
                            </div>
                   </div>

                   <div class="card">
                     <div class="sales report">
                                <h2>Report</h2>
                                <div class="btn-group">
                                    <button class="btn btn-secondary btn-lg dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span>Period:</span> Last Year
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="#">2012</a>
                                        <a href="#">2014</a>
                                        <a href="#">2015</a>
                                        <a href="#">2016</a>
                                    </div>
                                </div>
                            </div>  
                   </div><!-- card -->
                </div><!-- content -->

       
  
</div>

</div><!-- main -->
  </div><!-- container-admin -->
<?php 
include "footer.php";
?>