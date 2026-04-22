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
	add_category();
});
function add_category(){
    $("#category_frm").on("submit", function(e){
		e.preventDefault();
        var formData = new FormData($("#category_frm")[0]); 
           formData.append('action', 'insert_category'); // Add action parameter
			$.ajax({
				type: "POST",
				url: "insert-cat-ajax.php",
				data: formData,
				dataType: 'text',
				contentType: false,
				cache: false,
				processData:false,
				beforeSend: function(){
					$('#fupForm').css("opacity",".5"); 
				},
				success: function(data) {
					console.log('AJAX Success:', data); // Log the response data
					window.alert('AJAX Success: ' + data);
					 console.log("Element count:", $("#msg").length);

    $("#msgs").html(data);
					
				},
				error: function(xhr, status, error) {
					console.log('AJAX Error:', xhr.responseText); // Log the error
					window.alert('AJAX Error: ' + error);
				}
			});
	});
}

