<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Home Page | Sugraoptical </title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="shortcut icon" type="image/x-icon" href="images/fevicon.png">
      <!-- fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
      <!-- style-css -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="<?php echo BASE_FRONT_URL; ?>/css/owl.carousel.min.css" type="text/css"/>
      <link rel="stylesheet" href="<?php echo BASE_FRONT_URL; ?>/css/owl.theme.default.min.css" type="text/css"/>
      <link rel="stylesheet" href="<?php echo BASE_FRONT_URL; ?>/css/style.css" type="text/css">
   </head>
   <body>
      <header class="header-block" id="navbar">
         <div class="hdr-top">
            <div class="containers">
               <div class="flex">
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
                  <div class="hdr-info">
                     <a href="tel:+91-9911838303"><i class="fa fa-phone"></i> <span>+91-9911838303</span></a>
                     <a href="mailto:sugraoptical@gmail.com"><i class="fa fa-envelope-o"></i> <span>sugraoptical@gmail.com</span></a>
                     <label><i class="fa fa-calendar-o"></i> Mon - Sat : 10:00 AM - 20:00 PM</label>
                  </div>
               </div>
            </div>
         </div>
        <div class="hdr-center">
      
         <div class="containers">
            <div class="flex">
               <div class="logo">
                  <a href="<?php echo BASE_FRONT_URL; ?>"><img src="<?php echo BASE_FRONT_URL; ?>/images/logo-sugraoptical.png" alt="sugraoptical"></a>
               </div>
               <div class="menu-toggle">
                  <div class="menu-toggle-icon"> <span class="bars"><img src="<?php echo BASE_FRONT_URL; ?>/images/bars.png" alt="bars"></span> <span class="close-bars"><img src="<?php echo BASE_FRONT_URL; ?>/images/close-bars.png" alt="close-bars"></span> </div>
               </div>


            
               <div class="search-cart">

                  <div class="search-box">
        <input type="text" placeholder="Search...">
        <div class="search-btn"><img src="<?php echo BASE_FRONT_URL; ?>/images/search.png" alt="search"></div>
    </div>
     <a href="#" class="get-hdr"><img src="<?php echo BASE_FRONT_URL; ?>/images/user.png" alt="user"></a>
                  <a href="#" class="cart-hdr"><img src="<?php echo BASE_FRONT_URL; ?>/images/cart-bag.png" alt="cart-bag"><sup>0</sup></a>
                 
               </div>



            </div>
         </div>
           </div>

          <div class="hdr-bottom">
          <div class="containers">
              <div class="primary-menu">
                  <ul>
                     <li class="current-menu-item"><a href="<?php echo BASE_FRONT_URL; ?>">Home</a></li> 
                     <li><a href="<?php echo BASE_FRONT_URL; ?>/about-us.php">About Us</a></li>
                     <li class="listmenu">
                        <a href="<?php echo BASE_FRONT_URL; ?>/products.php">Products</a>
                        <ul class="submenu">
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
                     </li>
                     <li><a href="<?php echo BASE_FRONT_URL; ?>/contact-us.php">Contact Us</a></li>
                     <li><a href="#" target="_blank">Brochure</a></li>
                  </ul>
               </div>
          </div>
        </div>
      </header>