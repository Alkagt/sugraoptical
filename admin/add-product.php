<?php
include "connection.php";
include "auth-check.php";
include "header.php";
?> 
<div class="user-dashboard dashboard-all-content">
     <div class="titles">
             <h1>Add Product</h1>
        </div>
        <div class="content">
            <div class="card">
                <div class="product-errors"></div>
                 <form method="post" id="product_frm" enctype="multipart/form-data" data-mode="add">

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Product Name</label>
                                <input type="text" name="product_name" class="form-control" placeholder="Enter product name">
                            </div>
                        </div>
                       
                       <div class="col-md-4">
                            <div class="form-group">
                                <label>Product Slug</label>
                                <input type="text" name="product_slug" class="form-control" readonly>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Price</label>
                                <input type="number" name="price" class="form-control" placeholder="₹ Price">
                            </div>
                        </div>
                        
                         
                    </div>

                    <div class="row">
                       
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Brand</label>
                                <input type="text" name="brand" class="form-control" placeholder="Brand name">
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Country of Origin</label>
                                <select class="form-control" name="country">
                                    <option>Made in India</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
							<div class="form-group">
								<label>Product Image</label>
								<input type="file" name="product_image"
									   class="form-control"
									   accept="image/*">
							</div>
						</div>
                       
                    </div>

                    <div class="row">
                        
                         <div class="col-md-4">
                            <div class="form-group">
                                <label>Packaging Type</label>
                                <input type="text" class="form-control" name="packaging_type" placeholder="Box / Packet / Bottle">
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Material</label>
                                <input type="text" class="form-control" name="material" placeholder="Material used">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Model</label>
                                <input type="text" class="form-control" name="size" placeholder="Model">
                            </div>
                        </div>

                    </div>
                    <?php
                    $result = mysqli_query($conn,"select * from category");
                    $countrow = mysqli_num_rows($result);
                    if($countrow>0){ 
                    ?>
                    <div class="form-group">
                                <label>Choose Categories</label>
                                <select class="form-control" name="categories">
                                    <?php while($row = mysqli_fetch_assoc($result)){  ?>
                                    <option value="<?php echo $row['category_id']; ?>"><?php echo $row['category_name']; ?></option>
                                     <?php } ?>
                                </select>
                               
                    </div>
                     <?php } ?>
                    <div class="form-group">
                          <label>Product Specification</label>
                          <textarea name="product_specification" id="product_specification" class="form-control" rows="6"></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label>Product Description</label>
                        <textarea class="form-control" id="product_description" name="product_description" rows="5"></textarea>
                    </div>

                    <div class="text-right">
                        <button type="submit" class="btn add-product add-project">Save Product</button>
                    </div>

                </form>
            </div>
        </div>

    

  
</div>
</div><!-- main -->
  </div><!-- container-admin -->
  <?php
include "footer.php";
?>

