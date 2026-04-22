<?php
include "connection.php";
include "auth-check.php";
include "header.php";
$category_id =  $_GET['cat_id']; 
$result = mysqli_query($conn,"select * from category where category_id='$category_id'");
$row = mysqli_fetch_assoc($result);
?> 
<div class="user-dashboard dashboard-all-content">
	  <div class="titles">
             <h1>Edit Category</h1>
        </div>

         <div class="content">
            <div class="card">
            	<div class="msgs"></div>
                <form id="category_frm" method="post" enctype="multipart/form-data" data-mode="edit">

					<!-- First Row -->
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label>Category Name</label>
								<input type="text" name="category_name"
									   class="form-control"
									   value="<?php echo $row['category_name']; ?>">
									   <input type="hidden" name="id" value="<?php echo $row['category_id']; ?>">
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label>Slug</label>
								<input type="text" name="slug"
									   class="form-control" value="<?php echo $row['category_slug']; ?>" readonly>
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label>Category Image</label>
								<div id="category_preview_box" class="current-image-box" style="margin-bottom:10px; padding:10px; border:1px solid #ddd; border-radius:4px; <?php echo empty($row['category_image']) ? 'display:none;' : ''; ?>">
									<p style="margin-bottom:5px;"><strong>Preview:</strong></p>
									<img id="category_image_preview" 
										 src="<?php echo !empty($row['category_image']) ? 'assets/uploads/' . htmlspecialchars($row['category_image']) : ''; ?>" 
										 width="120" height="120" style="object-fit:cover; display:block;">
									<p class="category-image-filename" style="margin-top:5px; font-size:12px; color:#666;"><?php echo !empty($row['category_image']) ? htmlspecialchars($row['category_image']) : ''; ?></p>
									<?php if(!empty($row['category_image'])){ ?>
										<input type="hidden" name="current_image" value="<?php echo htmlspecialchars($row['category_image']); ?>">
									<?php } ?>
								</div>
								<input type="file" name="category_image" class="form-control" accept="image/*">
							</div>
						</div>
					</div>

					<!-- Second Row -->
					<div class="form-group">
						<label>Category Description</label>
						<textarea name="description"
								  class="form-control"
								  rows="5" id="description"><?php echo $row['category_description']; ?></textarea>
					</div>

					<!-- Buttons -->
					<div class="text-right">
						<button type="submit" class="btn add-project">
							Update Category
						</button>
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
