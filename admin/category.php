<?php
include "connection.php";
include "auth-check.php";
include "header.php";
$result = mysqli_query($conn,"select * from category");
$countrow = mysqli_num_rows($result);
//echo $countrow;
?> 

<div class="user-dashboard dashboard-all-content">
     <div class="titles">
            <h1>View Categories</h1>
        </div>

         <div class="content">
            <div class="card">
                 <div class="table-responsive">
                     <div class="del-msg"></div>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Category Name</th>
                                <th>Category Image</th>
                                <th>Status</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <?php if($countrow>0){ ?>
                        <tbody>
                            <?php while($row = mysqli_fetch_assoc($result)){ $count++; ?>
                            <!-- Example Static Row -->
                            <tr>
                                <td><?php echo $count; ?></td>
                                <td><?php echo $row['category_name']; ?></td>
                                <td><img width="100px" height="100px" src="<?php echo BASE_URL; ?>/assets/uploads/<?php echo $row['category_image']; ?>"></td>
                                <td>
                                    <span class="label label-success"><?php if($row['status']==1){ ?> Active <?php } else{ ?> Inactive <?php } ?></span>
                                </td>
                                <td class="text-right">
                                    <a href="<?php echo BASE_URL; ?>/edit-category.php?cat_id=<?php echo $row['category_id']; ?>" class="btn btn-xs btn-primary">Edit</a>
                                    <a href="javascript:void(0);" class="btn btn-xs btn-danger delete-category" data-id="<?php echo $row['category_id']; ?>">Delete</a>
                                    
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                        <?php }else{ ?>
                         <tr>
                            <td colspan="6" class="text-center">
                                <h3>Categories Not Added</h3>
                            </td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>


            </div>
        </div>
   

  
</div>

</div><!-- main -->
  </div><!-- container-admin -->
<?php
include "footer.php";
?>
