
// --------------------------------- For Menu Scroll
window.addEventListener("scroll", () => {
  const nav = document.getElementById("navbar");
  nav.classList.toggle("scrolled", window.scrollY > 50);
});


// --------------------------------- For Mobile/Tabs Navigation

$(document).ready(function(){
  $(".menu-toggle-icon").click(function(){
    $("body").toggleClass("toggle-open");
  });
});



// --------------------------------- For Hero Slider
  $('#hero').owlCarousel({
      animateOut: 'fadeOut',
      items:1,
      loop:true,
      autoplayHoverPause: false,
      autoplay: true,
      smartSpeed: 1000,
       dots: false,
       nav:true,
    })

// --------------------------------- For client-relationship Slider

$('#relationship').owlCarousel({
    loop:true,
    margin:30,
    nav:true,
     //navText: ["<img src='images/arrow-left-b.png' alt=''>","<img src='images/arrow-right-b.png' alt=''>"],
    dots: false,
    autoplay:true,
    responsive:{
        0:{
            items:1
        },
        768:{
            items:2
        },
        1024:{
            items:3
        },
         1299:{
            items:3
        }
    }
});



// --------------------------------- For client-relationship Slider

$('.product-cat').owlCarousel({
    loop:false,
    margin:10,
    nav:true,
     //navText: ["<img src='images/arrow-left-b.png' alt=''>","<img src='images/arrow-right-b.png' alt=''>"],
    dots: false,
    autoplay:false,
    responsive:{
        0:{
            items:1
        },
        768:{
            items:2
        },
        1024:{
            items:3
        },
         1299:{
            items:4
        }
    }
});




// --------------------------------- For testimonials Slider

$('#testimonials').owlCarousel({
    loop:true,
    margin:0,
    nav:true,
     //navText: ["<img src='images/arrow-left-b.png' alt=''>","<img src='images/arrow-right-b.png' alt=''>"],
    dots: false,
    autoplay:true,
    responsive:{
        0:{
            items:1
        },
        768:{
            items:2
        },
        1024:{
            items:3
        },
         1299:{
            items:3
        }
    }
});
// --------------------------------- For youtubevideo-Popup
const openBtn = document.querySelector('.open-popup');
  const closeBtn = document.querySelector('.close-popup');
  const overlay = document.querySelector('.popup-overlay');

  openBtn.addEventListener('click', () => {
    overlay.classList.add('active');
  });

  closeBtn.addEventListener('click', () => {
    overlay.classList.remove('active');
  });


// --------------------------------- For product image zoom

const image = document.querySelector(".main-image");

image.addEventListener("mousemove", (e) => {
  const rect = image.getBoundingClientRect();
  const x = ((e.clientX - rect.left) / rect.width) * 100;
  const y = ((e.clientY - rect.top) / rect.height) * 100;

  image.style.transformOrigin = `${x}% ${y}%`;
  image.style.transform = "scale(1.6)";
});

image.addEventListener("mouseleave", () => {
  image.style.transform = "scale(1)";
  image.style.transformOrigin = "center";
});
