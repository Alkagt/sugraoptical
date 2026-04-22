<?php
include "connection.php";
include "auth-check.php";
include "header.php";
$res = "select product.*,category.category_name from product left join category ON product.category_id = category.category_id";
$result = mysqli_query($conn,$res);
$countrow = mysqli_num_rows($result);
//echo $countrow;
?> 

<div class="user-dashboard dashboard-all-content">
     <div class="titles">
            <h1>View Products</h1>
        </div>

         <div class="content">
            <div class="card">
                <div class="table-responsive">
                     <div class="del-pro"></div>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product Name</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Image</th>
                                <th>Brand</th>
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
                                <td><?php echo $row['product_name']; ?></td>
                                <td><?php echo !empty($row['category_name']) ? $row['category_name']:'Uncategorized'; ?></td>
                                <td><?php echo $row['price']; ?> Rs/-</td>
                                <td><img width="100px" height="100px" src="<?php echo BASE_URL; ?>/assets/uploads/<?php echo $row['product_image']; ?>"></td>
                                <td><?php echo $row['brand']; ?></td>
                                <td>
                                    <span class="label label-success">Active</span>
                                </td>
                                <td class="text-right">
                                    <a href="<?php echo BASE_URL; ?>/edit-product.php?product_id=<?php echo $row['product_id']; ?>" class="btn btn-xs btn-primary product-update">Edit</a>
                                    <a href="#" class="btn btn-xs btn-danger product-delete" data-id="<?php echo $row['product_id']; ?>">Delete</a>
                                </td>
                            </tr>
                         <?php } ?>
                        </tbody>
                        <?php }else{ ?>
                         <tr>
                            <td colspan="6" class="text-center">
                                <h3>Products Not Added</h3>
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

