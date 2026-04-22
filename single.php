<?php
include "admin/connection.php";
include "header.php";
$slug = $_GET['slug'];
$catquery = mysqli_query($conn,"select * from category where category_slug='$slug'");
$catdata = mysqli_fetch_assoc($catquery);
$catid = $catdata['category_id'];
?>

 <div class="hero-block inner-hero clear">
      <div class="item"><img src="images/inner-hero.jpg" alt="hero" /></div>
    <div class="caption">
    <div class="table1">
      <div class="table2">
        <div class="containers">
          <div class="content">
            <h1>Our Categories</h1>

            <div class="breadcrumb">
              <div class="containers-lg">
              <a href="index.html">Home</a>
              <span>›</span>
               <a href="products.html">Categories</a>
              <span>›</span>
              <span class="current"> <?php echo $catdata['category_name']; ?></span>
              
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--  -->

  </div>



      
      <section class="products-categories clear">
        <div class="containers">
          <div class="flex">
            <div class="left-side">
              <h2>Categories</h2>
              <ul>
                 <?php
                    $que = "select * from category";
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
            </div>
        
      
         <div class="right-side">
           
               <div class="card card-categories">
                 <h1><?php echo $catdata['category_name']; ?></h1>

                 <img src="<?php echo BASE_URL; ?>/assets/uploads/<?php echo $catdata['category_image']; ?>" alt="">
                   <?php echo str_replace(
    'src="assets/uploads/',
    'src="admin/assets/uploads/',
    $catdata['category_description']
); ?>
   <p><strong>Find here your product under below listed categories</strong></p>
                   <div class="flex-subcard">
                       <?php
                       $related_products = "select product.*,category.category_slug from product INNER JOIN category ON product.category_id=category.category_id where product.category_id='$catid'";
                       $relproducts = mysqli_query($conn,$related_products);
                       if(mysqli_num_rows($relproducts)>0){
                           while($data = mysqli_fetch_assoc($relproducts)){ ?>
                               <div class="subcard-cat">
                                  <div class="cardicon"><img src="<?php echo BASE_URL; ?>/assets/uploads/<?php echo $data['product_image']; ?>" alt=""></div>
                                  <h3><?php echo $data['product_name']; ?> </h3>
                                  <a href="<?php echo BASE_FRONT_URL.'/'.$data['category_slug'].'/'.$data['product_slug'].'/p/'.$data['product_id']; ?>" class="cta-button2">Explore More</a>
                               </div>
                           <?php }
                           
                       }
                       else{
                           echo "<p class='rel_product'>Related Products not found</p>";
                       }
                       ?>
                       
                    </div>
               </div>
               <!--  -->

        
            
                </div>
             </div>
          </div>
       </section>
    
    
  <?php
  include "footer.php";
  ?>