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
            <h1>About Us</h1>

            <div class="breadcrumb">
  <div class="containers-lg">
  <a href="index.html">Home</a>
  <span>›</span>
  <span class="current"> About Us </span>
 
  </div>
 </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--  -->

  </div>



<section class="about-section clear">
  <div class="containers">
   
    <div class="flex">
      <div class="about-content">
         <h2>Our Story</h2>
        <h3>Find The Best Quality Ophthalmic Equipments</h3>
        <p>We <strong>“Sugra Optical”</strong> are engaged in <strong>manufacturer and trader</strong> a qualitative assortment of <strong>Trial Lens Set and many more</strong></p>
       
        <img src="images/about-img.jpg" alt="">

        <p>
Sugra Optical was Established in <strong>2018</strong>, in the city of Delhi by Mr. Abdul Majid, Who have <span class="exp-txt">10+ years of experience</span> as a optician. There are a variety of sectors where ophthalmic instruments are used. Most importantly, these instruments are concerned with the eye’s health. In surgical holdings, a range of tools that an ophthalmologist requires to give visual and eye care. These instruments are specially designed and manufactured to prevent potential eye damage, injuries, or diseases.</p>

<p>
  Before buying ophthalmic equipment for your practice purpose, you need to have all the knowledge about the features and the function. Thus it will be an asset to you through which you can get maximum. Our firm is <strong>Ophthalmic Instruments Suppliers</strong> in Delhi, India. Our firm is one of the recognized and reputed firms. All the material used in manufacturing instruments is of superior and A-grade quality. <strong>Sugra Optical</strong> is a reputed manufacturer, trader, wholesaler, supplier, and exporter of medical and industrial products like ophthalmic instruments that are in demand for being good in all aspects. <strong>Optical Equipment Manufacturers,</strong> our optical devices are designed for various purposes, for example, educational, scientific research, medical, etc. Equipment like Ophthalmic Chair Unit, Ophthalmic Equipments, Ophthalmoscope, Trial Lenses Set, Trial Case (illumination), Prism Bar Set Loose, etc.
</p>

<p>Making an informed decision is always a concern, whenever it is about money and quality. So, it is always better to make decisions with single-mindedness and not haste. Our firm will not misguide or misinform you about any service or product. Various products are in demand Trial Lens Set, Near Vision Drum, Retino Scope Rack, Red Green Goggles, RAF Ruller, Tonometer, Trial Frame, Ishiara Book, Snellen and Vision Chart,  etc.</p>

<p>Our products are safe to use, give accurate results, and you will find them reliable. Visit <strong>Sugra Optical</strong> today for more follow-ups.</p>
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
<?php
include "footer.php";
?>
      