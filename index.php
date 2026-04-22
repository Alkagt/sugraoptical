<?php
include "admin/connection.php";
include "header.php";
?>
 <div class="hero-block clear">
    <div class="owl-carousel owl-theme" id="hero">
       <div class="item"><img src="images/hero1.jpg" alt="hero" /></div>
     <div class="item"><img src="images/hero2.jpg" alt="hero" /></div>
     <div class="item"><img src="images/hero3.jpg" alt="hero" /></div>
      <div class="item"><img src="images/hero4.jpg" alt="hero" /></div>
       <div class="item"><img src="images/hero5.jpg" alt="hero" /></div>
    </div>
    <div class="caption">
    <div class="table1">
      <div class="table2">
        <div class="containers">
          <div class="content">
            <h1><span>Welcome to</span> Sugraoptical</h1>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
              <div class="buttons">
                 <a href="<?php echo BASE_FRONT_URL; ?>/products.php" class="cta-button2">Shop Now</a>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--  -->

  </div>


      <section class="home-about clear">
         <div class="containers">
           <div class="sec-title">
              <h2><span>Our Story</span> About Us and Our Services</h2>
           </div>
           <div class="flex">
            <div class="video-side">
               <figure>
                  <img src="images/about1.jpg" alt="">
               </figure>

                <figure>
                  <img src="images/about2.jpg" alt="">
               </figure>

              <div class="play-btn">
                  <button class="open-popup"><i class="fa fa-play"></i></button>
              </div>

<div class="popup-overlay" id="utube-popup">
  <div class="popup">
    <span class="close-popup">&times;</span>
  <iframe src="https://www.youtube.com/embed/_CfmLW_xTQQ?si=8Wz_W-okfVw97gv-" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
  </div>
</div>
               
              </div>
              <div class="content-side">
                 <p>Established in the year 2018, at Delhi, India, we <strong>“Sugra Optical”</strong> are one of the trusted manufacturers and suppliers of an extensive range of ophthalmic instruments, optical instrument, optical equipment and vision testing instrument. These are manufactured using quality basic material which is procured from reliable sources. We offer rotter test type drum, slit lamp microscope, keratometer, artificial eye, cosmetic shell and prism bar set. other than this, we also supply test of colour – blindness, auto kerato – refractometer / auto refractometer and spare / extra diamond wheel. These are designed in accordance with the set industry standards as well as per specifications laid by the clients.</p>

                 <div class="buttons">
                 <a href="#" class="cta-button2">Read More</a>
                 <a href="#" class="cta-button"><i class="fa fa-phone"></i> +91-9911838303</a>
              </div>
              </div>
           </div>
         </div>
      </section>
      
      <section class="home-product clear">
         <div class="containers">
            <div class="sec-title">
               <h2><span>Our Product</span> Product Categories</h2>
            </div>
            <div class="flex">
                <?php
                $query = "select * from category";
                $res = mysqli_query($conn,$query);
                $row = mysqli_num_rows($res);
                if($row>0){
                while($result = mysqli_fetch_assoc($res)){
                    ?>
                    <div class="card">
                      <div class="cardicon"><img src="<?php echo BASE_URL; ?>/assets/uploads/<?php echo $result['category_image']; ?>" alt=""></div>
                      <h3><?php echo $result['category_name']; ?></h3>
                      <a href="<?php echo BASE_FRONT_URL; ?>/single.php?slug=<?php echo $result['category_slug']; ?>" class="cta-button2">Explore More</a>
                   </div>
                    <?php
                }
                }
                ?>
            </div>
         </div>
      </section>
      <section class="home-relationship clear">
         <div class="containers">
            <div class="sec-title">
               <h2>To build long term relationship with our Customers and Clients</h2>
            </div>
            <div class="owl-carousel owl-theme arrow-owl" id="relationship">
                <?php
                    $que = "SELECT product.*, category.category_slug 
                            FROM product 
                            INNER JOIN category 
                            ON product.category_id = category.category_id";
                    
                    $products = mysqli_query($conn, $que);
                    
                    if(mysqli_num_rows($products) > 0){
                        while($data = mysqli_fetch_assoc($products)){
                    ?>
                            <a href="<?php echo BASE_FRONT_URL.'/'.$data['category_slug'].'/'.$data['product_slug'].'/p/'.$data['product_id']; ?>">
                                <figure>
                                    <img src="<?php echo BASE_URL; ?>/assets/uploads/<?php echo $data['product_image']; ?>" alt="">
                                </figure>
                            </a>
                    <?php
                        }
                    }
                    ?>
               
         </div>
      </section>
    
    
      <section class="home-testimonials clear">
         <div class="containers-lg">
            <div class="sec-title">
               <h2><span>Testimonials</span> What Our Customers Say</h2>
            </div>
            <div class="overall-rating">
               <div class="stars">★★★★★</div>
               Rated <span>4.1/5</span> by <span>5,000+</span> happy customers
            </div>
            <div class="testimonial-grid owl-carousel owl-theme arrow-owl" id="testimonials">
               <!-- Testimonial 1 -->
               <div class="testimonial-card">
                  <div class="stars">★★★★★</div>
            
                  <p class="testimonial-text">
                     “Excellent quality optical instruments from Sugra Optical! Enhanced accuracy and durability make them our top choice for diagnostics.”
                  </p>
                  <div class="customer-name">— Moshin Khan</div>
               </div>
               <!-- Testimonial 2 -->
               <div class="testimonial-card">
                  <div class="stars">★★★★★</div>
                  <p class="testimonial-text">
                     “Sugra Optical's trial lens set is precise, durable, and perfect for professional use. Highly recommend for optometry practices!”
                  </p>
                  <div class="customer-name">— Amit Singh</div>
               </div>
               <!-- Testimonial 3 -->
               <div class="testimonial-card">
                  <div class="stars">★★★★★</div>
                 
                  <p class="testimonial-text">
                     “Sugra Optical provided top-notch ophthalmic equipment that transformed our clinic's diagnostics. Reliable quality and exceptional customer service!”
                  </p>
                  <div class="customer-name">— Mohd. Rihan</div>
               </div>
               <!-- Testimonial 4 -->
                <div class="testimonial-card">
                  <div class="stars">★★★★★</div>
                 
                  <p class="testimonial-text">
                     “Sugra Optical provided top-notch ophthalmic equipment that transformed our clinic's diagnostics. Reliable quality and exceptional customer service!”
                  </p>
                  <div class="customer-name">— Mohd. Rihan</div>
               </div>
            </div>
         </div>
      </section>
      <?php
      include "footer.php";
      ?>