<?php
include "admin/connection.php";
include "header.php";
?>
  <div class="hero-block inner-hero clear">
      <div class="item"><img src="images/inner-hero.jpg" alt="hero" /></div>
    <div class="caption">
    <div class="table1">
      <div class="table2">
        <div class="containers">
          <div class="content">
            <h1>Our Products</h1>

            <div class="breadcrumb">
  <div class="containers-lg">
  <a href="#">Home</a>
  <span>›</span>
  <span class="current">Products</span>
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
            <div class="flex-card">
               <!--  -->
                <?php
                    $ques = "SELECT product.*, category.category_slug 
                            FROM product 
                            INNER JOIN category 
                            ON product.category_id = category.category_id";
                    
                    $productss = mysqli_query($conn, $ques);
                    
                    if(mysqli_num_rows($productss) > 0){
                        while($datapro = mysqli_fetch_assoc($productss)){
                    ?>
                            <div class="subcard-cat">
                          <div class="cardicon"><img src="<?php echo BASE_URL; ?>/assets/uploads/<?php echo $datapro['product_image']; ?>" alt=""></div>
                          <h3><?php echo $datapro['product_name']; ?></h3>
                          <a href="<?php echo BASE_FRONT_URL.'/'.$datapro['category_slug'].'/'.$datapro['product_slug'].'/p/'.$datapro['product_id']; ?>" class="cta-button2">Add to Cart</a>
                       </div>
                    <?php
                        }
                    }
                    ?>
                
               <!--  -->
         </div>
            
       </div>
       </div>
        </div>
      </section>
<?php
include "footer.php";
?>