<?php
include "connection.php";
include "auth-check.php";

if(isset($_POST['action']) && $_POST['action'] == 'insert_category'){

    $category_name = trim($_POST['category_name']);
    $slug = $_POST['slug'];
    $description = trim($_POST['description']);

    // ✅ CATEGORY NAME REQUIRED
    if(empty($category_name)){
        echo '<div class="alert alert-danger alert-dismissible fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Sorry!</strong> Category name is required.
              </div>';
        exit;
    }

    // ✅ CATEGORY NAME SHOULD NOT CONTAIN DIGITS
    if(preg_match('/[0-9]/', $category_name)){
        echo '<div class="alert alert-danger alert-dismissible fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Sorry!</strong> Category name cannot contain numbers.
              </div>';
        exit;
    }

    // ✅ DESCRIPTION REQUIRED
    if(empty($description)){
        echo '<div class="alert alert-danger alert-dismissible fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Sorry!</strong> Category description is required.
              </div>';
        exit;
    }

    $filename = $_FILES['category_image']['name'];
    $filetmpname = $_FILES['category_image']['tmp_name'];
    $fileSize = $_FILES['category_image']['size'];
    $fileError = $_FILES['category_image']['error'];

    // ✅ Allowed Extensions
    $allowed = array('jpg','jpeg','png','gif','webp');
    $fileExt = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

    // ✅ Check File Error First
    if($fileError === 0){

        // ✅ Check Extension
        if(in_array($fileExt, $allowed)){

            // Rename file to prevent duplicate
            $newFileName = time() . "_" . $filename;
            // ✅ CHECK IF SLUG ALREADY EXISTS
            $check = mysqli_query($conn, "SELECT 1 FROM category WHERE category_slug = '$slug' LIMIT 1");
            if (mysqli_num_rows($check) > 0) {
                echo '<div class="alert alert-danger alert-dismissible fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Sorry!</strong> Category with this slug already exists.
                      </div>';
                exit;
            }
            $insert_cat = "INSERT INTO category 
            (`category_name`,`category_slug`,`category_image`,`category_description`) 
            VALUES ('$category_name','$slug','$newFileName','$description')";

            $data_insert = mysqli_query($conn,$insert_cat);

            if($data_insert){

                $uploadPath = __DIR__ . "/assets/uploads/" . $newFileName;
                move_uploaded_file($filetmpname, $uploadPath);

                echo '<div class="alert alert-success alert-dismissible fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Aww yeah!</strong> Category inserted successfully.
                      </div>';

            } else {
                echo '<div class="alert alert-danger alert-dismissible fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Sorry!</strong> Category not inserted.
                      </div>';
            }

        } else {
            echo '<div class="alert alert-danger alert-dismissible fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Sorry!</strong> Invalid file type. Only JPG, JPEG, PNG, GIF, WEBP allowed.
                  </div>';
        }

    } else {
        echo '<div class="alert alert-danger alert-dismissible fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Sorry!</strong> File upload error.
              </div>';
    }

}



elseif(isset($_POST['action']) && $_POST['action'] == 'update_category'){
    $category_id = (int)$_POST['id'];
    $category_name = trim($_POST['category_name']);
    $slug = trim($_POST['slug']);
    $description = trim($_POST['description']);
    $current_image = isset($_POST['current_image']) ? trim($_POST['current_image']) : '';

    // ✅ CATEGORY NAME REQUIRED
    if(empty($category_name)){
        echo '<div class="alert alert-danger alert-dismissible fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Sorry!</strong> Category name is required.
              </div>';
        exit;
    }

    // ✅ CATEGORY NAME SHOULD NOT CONTAIN DIGITS
    if(preg_match('/[0-9]/', $category_name)){
        echo '<div class="alert alert-danger alert-dismissible fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Sorry!</strong> Category name cannot contain numbers.
              </div>';
        exit;
    }

    // ✅ DESCRIPTION REQUIRED
    if(empty($description)){
        echo '<div class="alert alert-danger alert-dismissible fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Sorry!</strong> Category description is required.
              </div>';
        exit;
    }

    // ✅ Image: use current if no new file, otherwise use new uploaded image
    $image_to_save = $current_image;

    $filename = $_FILES['category_image']['name'];
    $filetmpname = $_FILES['category_image']['tmp_name'];
    $fileError = $_FILES['category_image']['error'];

    if($fileError === 0){
        // New file uploaded
        $allowed = array('jpg','jpeg','png','gif','webp');
        $fileExt = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        if(in_array($fileExt, $allowed)){
            $newFileName = time() . "_" . $filename;
            $uploadPath = __DIR__ . "/assets/uploads/" . $newFileName;
            move_uploaded_file($filetmpname, $uploadPath);
            $image_to_save = $newFileName;
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Sorry!</strong> Invalid file type. Only JPG, JPEG, PNG, GIF, WEBP allowed.
                  </div>';
            exit;
        }
    }
    // else: no new file (fileError 4 = UPLOAD_ERR_NO_FILE) → keep $image_to_save = $current_image

    $update_cat = "UPDATE category SET category_name='$category_name', category_slug='$slug', category_image='$image_to_save', category_description='$description' WHERE category_id='$category_id'";
    $data_update = mysqli_query($conn,$update_cat);

    if($data_update){
        echo '<div class="alert alert-success alert-dismissible fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Aww yeah!</strong> Category updated successfully.
              </div>';
    } else {
        echo '<div class="alert alert-danger alert-dismissible fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Sorry!</strong> Category not updated.
              </div>';
    }
}
elseif(isset($_POST['action']) && $_POST['action'] == 'delete_category' ){
    $category_id = $_POST['category_id'];
    //echo $category_id;
    if($category_id<=0){
         echo '<div class="alert alert-danger alert-dismissible fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Sorry!</strong> Invalid category id.
              </div>';
        exit;
    }
    // Optional: if you want to delete the image file too, first fetch it:
    
    $res = mysqli_query($conn, "SELECT category_image FROM category WHERE category_id = '$category_id'");
    $row = mysqli_fetch_assoc($res);
    if(!empty($row['category_image'])){
        $imagePath = __DIR__ . "/assets/uploads/" . $row['category_image'];
        if(file_exists($imagePath)){
            @unlink($imagePath);
        }
    }
    
    $del_category = "delete from category where category_id='$category_id'";
    $data_delete = mysqli_query($conn,$del_category);
    if($data_delete){
         echo '<div class="alert alert-success alert-dismissible fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success!</strong> Category deleted successfully.
              </div>';
    }
    else{
         echo '<div class="alert alert-danger alert-dismissible fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Sorry!</strong> Category could not be deleted.
              </div>';
    }
}
elseif(isset($_POST['action']) && $_POST['action'] == 'add_product'){
     $product_name = $_POST['product_name'];
     $product_slug = $_POST['product_slug'];
     $category_id = $_POST['categories'];
     $price = $_POST['price'];
     $brand = $_POST['brand'];
     $country = $_POST['country'];
     $packaging_type = $_POST['packaging_type'];
     $material = $_POST['material'];
     $size = $_POST['size'];
     $product_specification = $_POST['product_specification'];
     $product_description = $_POST['product_description'];
     $product_imgname = $_FILES['product_image']['name'];
     $product_imgtmp = $_FILES['product_image']['tmp_name'];
     $product_imgsize = $_FILES['product_image']['size'];
     $product_imgerr = $_FILES['product_image']['error'];
     $allwed_ext = array('jpg','jpeg','png','gif','webp');
     $product_img_ext =  strtolower(pathinfo($product_imgname,PATHINFO_EXTENSION));
     if(empty($product_name)){
        echo '<div class="alert alert-danger alert-dismissible fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Sorry!</strong> Product name is required.
              </div>';
        exit; 
     }
    if(preg_match('/^[0-9]+$/', $product_name)){
        echo '<div class="alert alert-danger alert-dismissible fade in">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong>Sorry!</strong> Product name cannot contain only numbers.
              </div>';
        exit;
    }
    if(empty($price)){
         echo '<div class="alert alert-danger alert-dismissible fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Sorry!</strong> Product price is required.
              </div>';
        exit;
    }
     if(empty($brand)){
        echo '<div class="alert alert-danger alert-dismissible fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Sorry!</strong> Product brand is required.
              </div>';
        exit; 
     }
    if(preg_match('/^[0-9]+$/',$brand)){
         echo '<div class="alert alert-danger alert-dismissible fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Sorry!</strong> Product brand cannot contain only numbers.
              </div>';
        exit;
    }
    // Required
    if (empty($packaging_type)) {
        echo '<div class="alert alert-danger alert-dismissible fade in">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong>Sorry!</strong> Packaging type is required.
              </div>';
        exit;
    }
    
    
    // Not only numbers
    if (preg_match('/^[0-9]+$/', $packaging_type)) {
        echo '<div class="alert alert-danger alert-dismissible fade in">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong>Sorry!</strong> Packaging type cannot contain only numbers.
              </div>';
        exit;
    }
    // Required
    if (empty($material)) {
        echo '<div class="alert alert-danger alert-dismissible fade in">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong>Sorry!</strong> Material is required.
              </div>';
        exit;
    }
    
    // Not only numbers
    if (preg_match('/^[0-9]+$/', $material)) {
        echo '<div class="alert alert-danger alert-dismissible fade in">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong>Sorry!</strong> Material cannot contain only numbers.
              </div>';
        exit;
    }
    // Required
    if (empty($size)) {
        echo '<div class="alert alert-danger alert-dismissible fade in">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong>Sorry!</strong> Size is required.
              </div>';
        exit;
    }
    if (empty($product_specification)) {
        echo '<div class="alert alert-danger alert-dismissible fade in">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong>Sorry!</strong> Product specification is required.
              </div>';
        exit;
    }
    if (empty($product_description)) {
        echo '<div class="alert alert-danger alert-dismissible fade in">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong>Sorry!</strong> Product description is required.
              </div>';
        exit;
    }
    if($product_imgerr===0){
         if(in_array($product_img_ext,$allwed_ext)){
              // Rename file to prevent duplicate
            $newproduct_imgname = time() . "_" . $product_imgname;
            $checkproduct = mysqli_query($conn, "SELECT 1 FROM product WHERE product_name = '$product_name' LIMIT 1");
            if (mysqli_num_rows($checkproduct) > 0) {
                echo '<div class="alert alert-danger alert-dismissible fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Sorry!</strong> product with this name already exists.
                      </div>';
                exit;
            }
            $product_insert = "insert into product(`product_name`,`product_slug`,`category_id`,`price`,`brand`,`country`,`product_image`,`packaging_type`,`material`,`size`,`product_specification`,`product_description`) values('$product_name','$product_slug','$category_id','$price','$brand','$country','$newproduct_imgname','$packaging_type','$material','$size','$product_specification','$product_description')";
            $product_res = mysqli_query($conn,$product_insert);
               if($product_res){
                   $upload_path = __DIR__."/assets/uploads/".$newproduct_imgname;
                   move_uploaded_file($product_imgtmp,$upload_path);
                            echo '<div class="alert alert-success alert-dismissible fade in">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Aww yeah!</strong> Product inserted successfully.
                                  </div>';
    
                } else {
                    echo '<div class="alert alert-danger alert-dismissible fade in">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Sorry!</strong> Product not inserted.
                          </div>';
                }
         }
         else{
             echo '<div class="alert alert-danger alert-dismissible fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Sorry!</strong> Invalid file type. Only JPG, JPEG, PNG, GIF allowed.
                  </div>';
         }
    }
    else {
        echo '<div class="alert alert-danger alert-dismissible fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Sorry!</strong> File upload error.
              </div>';
    }
   
}
elseif(isset($_POST['action']) && $_POST['action'] == 'delete_product'){
    $product_id = $_POST['product_id'];
    if($product_id<=0){
        echo '<div class="alert alert-danger alert-dismissible fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Sorry!</strong> Invalid product id.
              </div>';
        exit;
    }
    $res = mysqli_query($conn,"delete from product where product_id=$product_id");
    if($res){
         echo '<div class="alert alert-success alert-dismissible fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success!</strong> Product deleted successfully.
              </div>';
    }
    else{
         echo '<div class="alert alert-danger alert-dismissible fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Sorry!</strong> Product could not be deleted.
              </div>';
    }
    
}
elseif(isset($_POST['action']) && $_POST['action'] == 'update_product'){
     $productid = (int)$_POST['pro_id'];
     $product_name = $_POST['product_name'];
     $product_slug = $_POST['product_slug'];
     $category_id = $_POST['categories'];
     $price = $_POST['price'];
     $brand = $_POST['brand'];
     $country = $_POST['country'];
     $packaging_type = $_POST['packaging_type'];
     $material = $_POST['material'];
     $size = $_POST['size'];
     $product_specification = $_POST['product_specification'];
     $product_description = $_POST['product_description'];
     $current_image = isset($_POST['current_image']) ? trim($_POST['current_image']) : '';
     if(empty($product_name)){
         echo '<div class="alert alert-danger alert-dismissible fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Sorry!</strong> Product name is required.
              </div>';
        exit;
    }
    if(preg_match('/^[0-9]+$/', $product_name)){
        echo '<div class="alert alert-danger alert-dismissible fade in">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong>Sorry!</strong> Product name cannot contain only numbers.
              </div>';
        exit;
    }
    if(empty($price)){
         echo '<div class="alert alert-danger alert-dismissible fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Sorry!</strong> Product price is required.
              </div>';
        exit;
    }
     if(empty($brand)){
        echo '<div class="alert alert-danger alert-dismissible fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Sorry!</strong> Product brand is required.
              </div>';
        exit; 
     }
    if(preg_match('/^[0-9]+$/',$brand)){
         echo '<div class="alert alert-danger alert-dismissible fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Sorry!</strong> Product brand cannot contain only numbers.
              </div>';
        exit;
    }
    // Required
    if (empty($packaging_type)) {
        echo '<div class="alert alert-danger alert-dismissible fade in">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong>Sorry!</strong> Packaging type is required.
              </div>';
        exit;
    }
    
    
    // Not only numbers
    if (preg_match('/^[0-9]+$/', $packaging_type)) {
        echo '<div class="alert alert-danger alert-dismissible fade in">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong>Sorry!</strong> Packaging type cannot contain only numbers.
              </div>';
        exit;
    }
    // Required
    if (empty($material)) {
        echo '<div class="alert alert-danger alert-dismissible fade in">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong>Sorry!</strong> Material is required.
              </div>';
        exit;
    }
    
    // Not only numbers
    if (preg_match('/^[0-9]+$/', $material)) {
        echo '<div class="alert alert-danger alert-dismissible fade in">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong>Sorry!</strong> Material cannot contain only numbers.
              </div>';
        exit;
    }
    // Required
    if (empty($size)) {
        echo '<div class="alert alert-danger alert-dismissible fade in">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong>Sorry!</strong> Size is required.
              </div>';
        exit;
    }
    if (empty($product_specification)) {
        echo '<div class="alert alert-danger alert-dismissible fade in">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong>Sorry!</strong> Product specification is required.
              </div>';
        exit;
    }
    if (empty($product_description)) {
        echo '<div class="alert alert-danger alert-dismissible fade in">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong>Sorry!</strong> Product description is required.
              </div>';
        exit;
    }
    
    $product_imgname = $_FILES['product_image']['name'];
    $product_imgtmp  = $_FILES['product_image']['tmp_name'];
    
    $img_to_save = $current_image;
    $new_uploaded = false;
    
    if(!empty($product_imgname)){
    
        $allowed_ext = array('jpg','jpeg','png','gif','webp');
        $product_img_ext = strtolower(pathinfo($product_imgname, PATHINFO_EXTENSION));
    
        if(!in_array($product_img_ext,$allowed_ext)){
            echo '<div class="alert alert-danger">Invalid image type</div>';
            exit;
        }
    
        $newproduct_imgname = time().'_'.$product_imgname;
        $img_to_save = $newproduct_imgname;
        $new_uploaded = true;
    
        move_uploaded_file($product_imgtmp, __DIR__."/assets/uploads/".$newproduct_imgname);
    }


    /* Duplicate check (important for update) */
    $checkproduct = mysqli_query($conn,
    "SELECT 1 FROM product 
    WHERE product_name='$product_name'
    AND product_id!='$productid'
    LIMIT 1");
    
    if(mysqli_num_rows($checkproduct)>0){
        echo '<div class="alert alert-danger">Product name already exists</div>';
        exit;
    }
    
    
    /* UPDATE QUERY */
    $product_update = "UPDATE product SET
    product_name='$product_name',
    product_slug='$product_slug',
    category_id='$category_id',
    price='$price',
    brand='$brand',
    country='$country',
    product_image='$img_to_save',
    packaging_type='$packaging_type',
    material='$material',
    size='$size',
    product_specification='$product_specification',
    product_description='$product_description'
    WHERE product_id='$productid'";
    
    $product_res = mysqli_query($conn,$product_update);
    
    if($product_res){

    if($new_uploaded == true && $current_image != ""){

        $uploadDir = __DIR__ . "/assets/uploads/";
        $oldImage = $uploadDir . $current_image;

        if(is_file($oldImage)){
            unlink($oldImage);
        }

    }

    echo '<div class="alert alert-success">Product updated successfully</div>';
    }else{
                    echo '<div class="alert alert-danger">Product not updated</div>';
                }
       
}
?>