<?php if (!isset($page) || $page != 'login'): ?>
        </div> <!-- end right content -->
    </div>
</div>
<?php endif; ?>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script  type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.tiny.cloud/1/1uuqydm63bywsxpt5imfgr2mu0we7rfhi8sz2x842g33mwav/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const navItems = document.querySelectorAll(".navi ul li");

        navItems.forEach(function (item) {
            item.addEventListener("click", function () {

                // Sabhi li se active remove karo
                navItems.forEach(function (li) {
                    li.classList.remove("active");
                });

                // Sirf clicked li me active add karo
                this.classList.add("active");
            });
        });
    });

function toggleSidebar() {
    document.body.classList.toggle('sidebar-open');
}
/***********jquery-insert-category-form-data*****************/
jQuery(document).ready(function(){
    //alert("dsf");
	add_category();
	/********change-category-slug-automatically-when-keyup-category-name*******/
	$("input[name='category_name']").on("keyup", function(){

        let category = $(this).val();

        // Convert to lowercase
        let slug = category.toLowerCase();

        // Remove special characters
        slug = slug.replace(/[^\w\s-]/g, '');

        // Replace spaces with -
        slug = slug.replace(/\s+/g, '-');

        // Remove multiple -
        slug = slug.replace(/-+/g, '-');

        $("input[name='slug']").val(slug);
    });
    
    /*******************product-slug*********************/
    	$("input[name='product_name']").on("keyup", function(){

        let products = $(this).val();

        // Convert to lowercase
        let slug = products.toLowerCase();

        // Remove special characters
        slug = slug.replace(/[^\w\s-]/g, '');

        // Replace spaces with -
        slug = slug.replace(/\s+/g, '-');

        // Remove multiple -
        slug = slug.replace(/-+/g, '-');

        $("input[name='product_slug']").val(slug);
    });
    /********change-category-slug-automatically-when-keyup-category-name*******/
    /*******change-preview-image********/
    // Live preview when user selects a new image
// Live preview when user selects a new image
$("input[name='category_image']").on("change", function(){
    var file = this.files[0];
    var previewBox = $("#category_preview_box");
    var preview = $("#category_image_preview");
    var filenameLabel = $(".category-image-filename");

    if (file && file.type.indexOf("image") === 0) {
        var reader = new FileReader(); 
        reader.onload = function(e) {
            preview.attr("src", e.target.result);
            filenameLabel.text(file.name);
            previewBox.show();  // Show preview when new file selected
        };
        reader.readAsDataURL(file);
    } else {
        // User cleared the file - hide if no existing image in DB
        var currentImg = $("input[name='current_image']").val();
        if (currentImg) {
            preview.attr("src", "assets/uploads/" + currentImg);
            filenameLabel.text(currentImg);
            previewBox.show();
        } else {
            preview.attr("src", "").hide();
            previewBox.hide();  // Hide when no image in DB and no file selected
        }
    }
});
/*********end-of-change-preview-image*******/
/********load-tinymce-editor***********/
  tinymce.init({
    selector: '#product_specification',
    menubar: false,
    plugins: 'lists link image',
    toolbar: 'bold italic | link unlink | link image | bullist numlist | undo redo',
    images_upload_url: 'upload.php',  // upload from computer
    automatic_uploads: true,
    file_picker_types: 'image',
    branding: false
  });
  tinymce.init({
    selector: '#product_description',
    menubar: false,
    plugins: 'lists link image',
    toolbar: 'bold italic | link unlink | link image | bullist numlist | undo redo',
    images_upload_url: 'upload.php',  // upload from computer
    automatic_uploads: true,
    file_picker_types: 'image',
    branding: false
  });
  tinymce.init({
    selector: '#description',
    menubar: false,
    plugins: 'lists link image',
    toolbar: 'bold italic | link unlink | link image | bullist numlist | undo redo',
    images_upload_url: 'upload.php',  // upload from computer
    automatic_uploads: true,
    file_picker_types: 'image',
    branding: false
  });
  
/*********end-of-load-tinymce-editor*********/
});
function add_category(){
    $(document).on("submit","#category_frm",function(e){
        e.preventDefault();
        var formData = new FormData($("#category_frm")[0]);

        var isEdit = $("#category_frm").attr("data-mode") === "edit";
        var action = isEdit ? 'update_category' : 'insert_category';

        formData.append('action', action);

        $.ajax({
            type: "POST",
            url: "ajax-data.php",    // same file for both   
            data: formData,
            dataType: 'text',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function(){
                $('#fupForm').css("opacity",".5");
            },
            success: function(data) {
                console.log('AJAX Success:', data);
                $(".msgs").html(data);
                
            },
            error: function(xhr, status, error) {
                console.log('AJAX Error:', xhr.responseText);
            }
        });
    });
}


     function delete_category(){
 $(document).on("click",".delete-category",function(e){
        e.preventDefault();
        var category_id = $(this).data("id");
        var row = $(this).closest("tr");
        //alert(category_id);
        if(!confirm("Are you sure you want to delete this category?")){
        return;
        }
        $.ajax({
            type: "POST",
            url: "ajax-data.php",
            data: {action: "delete_category", category_id:category_id},
            dataType: "text",
            success: function(data){
                console.log("Delete ajax success:",data);
                $(".del-msg").html(data);
            row.fadeOut(1000, function(){
                $(this).remove();
                 // After removing, if no more rows, show "Categories not added"
                var $tbody = $("table.table-striped tbody");
                if ($tbody.find("tr").length === 0) {
                    $tbody.append(
                        '<tr>' +
                            '<td colspan="6" class="text-center"><h3>Categories Not Added</h3></td>' +
                        '</tr>'
                    );
                }
            });
            },
            error: function(xhr, status, error){
            console.log("Delete AJAX Error:", xhr.responseText);
           }
        });
    });
 }
 function add_product(){
     $("#product_frm").on("submit",function(e){
         e.preventDefault();
         var formData = new FormData($("#product_frm")[0]);
         var isAdd = $("#product_frm").attr("data-mode") === "add";
         var action = isAdd ? 'add_product' : 'update_product';
         formData.append('action',action);
         $.ajax({
             type: 'POST',
             url: 'ajax-data.php',
             data: formData,
             dataType: 'text',
             contentType: false,
             cache: false,
             processData: false,
             beforeSend: function(){
                $('#fupForm').css("opacity",".5");
            },
             success: function(data){
                console.log('AJAX Success:', data);
                $(".product-errors").html(data);
             },
             error: function(xhr, status, error){
                console.log('AJAX Error:', xhr.responseText);
             }
         });
         
     });
 }
 function delete_product(){
     $(document).on("click",'.product-delete',function(){
         var product_id = $(this).data("id");
         var current_row = $(this).closest("tr");
         //console.log(current_row.find("td:eq(1)").text());
         if(!confirm("Are you sure you want to delete this Product?")){
           return;
         }
         $.ajax({
            type: "POST",
            url: "ajax-data.php",
            data: {action: "delete_product", product_id:product_id},
            dataType: "text",
            success: function(data){
                console.log("Delete ajax success:",data);
                $(".del-pro").html(data);
            current_row.fadeOut(1000, function(){
                $(this).remove();
                 // After removing, if no more rows, show "products not added"
                var $tbody = $("table.table-striped tbody");
                if ($tbody.find("tr").length === 0) {
                    $tbody.append(
                        '<tr>' +
                            '<td colspan="6" class="text-center"><h3>Products Not Added</h3></td>' +
                        '</tr>'
                    );
                }
            });
            },
            error: function(xhr, status, error){
            console.log("Delete AJAX Error:", xhr.responseText);
           }
        });
     });
 }
 $(document).ready(function(){
     delete_product();
     delete_category();
     add_product();
 });
 /************end-of-my-code********************/
</script>
</body>
</html>
