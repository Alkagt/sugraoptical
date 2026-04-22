<?php
include "connection.php";
include "auth-check.php";
include "header.php";
$product_id =  $_GET['product_id']; 
$result = mysqli_query($conn,"select * from product where product_id='$product_id'");
$row = mysqli_fetch_assoc($result);
?> 
<div class="user-dashboard dashboard-all-content">
     <div class="titles">
             <h1>Edit Product</h1>
        </div>
        <div class="content">
            <div class="card">
                <div class="product-errors"></div>
                 <form method="post" id="product_frm" enctype="multipart/form-data" data-mode="edit">

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Product Name</label>
                                <input type="text" name="product_name" class="form-control" value="<?php echo $row['product_name']; ?>">
                                <input type="hidden" name="pro_id" value="<?php echo $row['product_id']; ?>">
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Product Slug</label>
                                <input type="text" name="product_slug" class="form-control" value="<?php echo $row['product_slug']; ?>" readonly>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Price</label>
                                <input type="number" name="price" class="form-control" value="<?php echo $row['price']; ?>">
                            </div>
                        </div>
                        
                         
                    </div>

                    <div class="row">
                       
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Brand</label>
                                <input type="text" name="brand" class="form-control" value="<?php echo $row['brand']; ?>">
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
								<div id="category_preview_box" class="current-image-box" style="margin-bottom:10px; padding:10px; border:1px solid #ddd; border-radius:4px; <?php echo empty($row['product_image']) ? 'display:none;' : ''; ?>">
									<p style="margin-bottom:5px;"><strong>Preview:</strong></p>
									<img id="category_image_preview" 
										 src="<?php echo !empty($row['product_image']) ? 'assets/uploads/' . htmlspecialchars($row['product_image']) : ''; ?>" 
										 width="120" height="120" style="object-fit:cover; display:block;">
									<p class="category-image-filename" style="margin-top:5px; font-size:12px; color:#666;"><?php echo !empty($row['product_image']) ? htmlspecialchars($row['product_image']) : ''; ?></p>
									<?php if(!empty($row['product_image'])){ ?>
										<input type="hidden" name="current_image" value="<?php echo htmlspecialchars($row['product_image']); ?>">
									<?php } ?>
								</div>
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
                                <input type="text" class="form-control" name="packaging_type" value="<?php echo $row['packaging_type']; ?>">
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Material</label>
                                <input type="text" class="form-control" name="material" value="<?php echo $row['material']; ?>">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Model</label>
                                <input type="text" class="form-control" name="size" value="<?php echo $row['size']; ?>">
                            </div>
                        </div>

                    </div>
                    <?php
                    $catid = $row['category_id']; // current product category
                    
                    $result = mysqli_query($conn,"SELECT * FROM category");
                    ?>
                    
                    <div class="form-group">
                        <label>Choose Categories</label>
                        <?php
                            $catid = isset($row['category_id']) ? (int)$row['category_id'] : 0;
                            $result = mysqli_query($conn,"SELECT * FROM category");
                            ?>
                            
                            <select class="form-control" name="categories">
                                <?php while($cat = mysqli_fetch_assoc($result)){ ?>
                                    
                                    <option value="<?php echo $cat['category_id']; ?>"
                                        <?php echo ((int)$cat['category_id'] === $catid) ? 'selected' : ''; ?>>
                                        
                                        <?php echo $cat['category_name']; ?>
                                    
                                    </option>
                            
                                <?php } ?>
                            </select>
                    </div>
                    <div class="form-group">
                          <label>Product Specification</label>
                          <textarea name="product_specification" id="product_specification" class="form-control" rows="6"><?php echo $row['product_specification']; ?></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label>Product Description</label>
                        <textarea class="form-control" id="product_description" name="product_description" rows="5"><?php echo $row['product_description']; ?></textarea>
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

