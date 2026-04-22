<?php
include "connection.php";
include "auth-check.php";
include "header.php";
?> 
<div class="user-dashboard dashboard-all-content">
	  <div class="titles">
             <h1>Add Category</h1>
        </div>

         <div class="content">
            <div class="card">
            	<div class="msgs"></div>
                <form id="category_frm" method="post" enctype="multipart/form-data" data-mode="add">

					<!-- First Row -->
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label>Category Name</label>
								<input type="text" name="category_name"
									   class="form-control"
									   placeholder="Enter category name">
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label>Slug</label>
								<input type="text" name="slug"
									   class="form-control" readonly>
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label>Category Image</label>
								<input type="file" name="category_image"
									   class="form-control"
									   accept="image/*">
							</div>
						</div>
					</div>

					<!-- Second Row -->
					<div class="form-group">
						<label>Category Description</label>
						<textarea name="description"
								  class="form-control"
								  rows="5"
								  id="description"></textarea>
					</div>

					<!-- Buttons -->
					<div class="text-right">
						<button type="submit" class="btn add-project">
							Save Category
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
