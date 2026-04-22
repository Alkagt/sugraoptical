 <footer class="footer">
         <div class="containers">
           <div class="flex">
           
            <div class="ft-menu ft-box">
               <h3>Quick Links</h3>
               <ul>
                  <li><a href="<?php echo BASE_FRONT_URL; ?>">Home</a></li>
                  <li><a href="<?php echo BASE_FRONT_URL; ?>/about-us.php">About Us</a> </li>
                  <li><a href="<?php echo BASE_FRONT_URL; ?>/products.php">Products</a></li>
                  <li><a href="<?php echo BASE_FRONT_URL; ?>/contact-us.php">Contact Us</a></li>
                  <li><a href="#">Brochure</a></li>
                
               </ul>
            </div>

                <div class="ft-info ft-box">
                  <a href="<?php echo BASE_FRONT_URL; ?>" class="ft-logo"><img src="<?php echo BASE_FRONT_URL; ?>/images/logo-sugraoptical.png" alt="sugraoptical"></a>
               <a href="mailto:sugraoptical@gmail.com">sugraoptical@gmail.com</a>
                <a href="tel:+91-9911838303">+91-9911838303</a>
                <a href="#">Shop No. - 5971, Ballimaran Chandni Chowk, Delhi - 110006</a>

                <div class="hdr-social">
                     <a href="#"><i class="fa fa-facebook"></i></a>
                      <a href="#"><svg xmlns="http://www.w3.org/2000/svg" fill="#000000" class="bi bi-twitter-x" viewBox="0 0 16 16" id="Twitter-X--Streamline-Bootstrap" height="16" width="16">
  <desc>
    Twitter X Streamline Icon: https://streamlinehq.com
  </desc>
  <path d="M12.6 0.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867 -5.07 -4.425 5.07H0.316l5.733 -6.57L0 0.75h5.063l3.495 4.633L12.601 0.75Zm-0.86 13.028h1.36L4.323 2.145H2.865z" stroke-width="1"></path>
</svg></a>
                       <a href="#"><i class="fa fa-instagram"></i></a>
                  </div>
            </div>

             <div class="ft-menu ft-product ft-box">
               <h3>Our Products</h3>
               <ul>
            
                  <ul>
                       <?php
                    $que = "select * from category LIMIT 4";
                    $ress = mysqli_query($conn,$que);
                    $rows = mysqli_num_rows($ress);
                    if($rows>0){
                        while($results = mysqli_fetch_assoc($ress)){
                        ?>
                      <li><a href="single.php?slug=<?php echo $results['category_slug']; ?>"> <?php echo $results['category_name']; ?></a></li>
                         <?php
                      } 
                    }
                     ?>
                          
                        </ul>
               </ul>
            </div>
           </div>
            <div class="copyright">
               <p>© Copyright <?php echo $year = date("Y"); ?> - All rights reserved. | <a href="#">Sitemap</a></p>
            </div>
         </div>
      </footer>
      <script src="<?php echo BASE_FRONT_URL; ?>/js/jquery.min.js"></script>
      <script src="<?php echo BASE_FRONT_URL; ?>/js/owl.carousel.js"></script>
      <script src="<?php echo BASE_FRONT_URL; ?>/js/custom.js"></script>
      <script type="text/javascript">
  
// --------------------------------- For product tabs
const buttons = document.querySelectorAll(".tab-btn");
const contents = document.querySelectorAll(".tab-content");
const indicator = document.querySelector(".tab-indicator");

function moveIndicator(button) {
  indicator.style.width = button.offsetWidth + "px";
  indicator.style.left = button.offsetLeft + "px";
}

// Initialize indicator
moveIndicator(document.querySelector(".tab-btn.active"));

buttons.forEach(button => {
  button.addEventListener("click", () => {
    
    // Remove active
    buttons.forEach(btn => btn.classList.remove("active"));
    contents.forEach(c => c.classList.remove("active"));

    // Add active
    button.classList.add("active");
    document.getElementById(button.dataset.tab).classList.add("active");

    // Move underline
    moveIndicator(button);
  });
});
// add-to-cart-quantity
$(document).ready(function(){

    $(".qty-btn").click(function(){

        let change = parseInt($(this).data("change"));
        let qty = $("#qty");
        let hiddenQty = $("#finalQty");

        let newVal = parseInt(qty.val()) + change;

        if(newVal < 1) newVal = 1;

        qty.val(newVal);
        hiddenQty.val(newVal);

    });

});
</script>
<script>
document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector('form[action$="enquiry-cart.php"]');
  const modelSelect = document.getElementById('size');
  const qtyInput = document.getElementById('qty');
  const finalQty = document.getElementById('finalQty');
  const selectedModel = document.getElementById('selectedModel');

  if (form) {
    form.addEventListener('submit', function(e){
      if (!modelSelect.value) {
        e.preventDefault();
        alert('Please select model first.');
        modelSelect.focus();
        return;
      }
      selectedModel.value = modelSelect.value;
      finalQty.value = qtyInput.value || 1;
    });
  }
});
</script>
   </body>
</html>