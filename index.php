<?php
// Démarrer la session
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>RIVER RIDE</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,900|Playfair+Display:400,700,900 " rel="stylesheet">
    <link rel="stylesheet" href="common/fonts/icomoon/style.css">

    <link rel="stylesheet" href="common/css/bootstrap.min.css">
    <link rel="stylesheet" href="common/css/jquery-ui.css">
    <link rel="stylesheet" href="common/css/owl.carousel.min.css">
    <link rel="stylesheet" href="common/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="common/css/owl.theme.default.min.css">

    <link rel="stylesheet" href="common/css/jquery.fancybox.min.css">

    <link rel="stylesheet" href="common/css/bootstrap-datepicker.css">

    <link rel="stylesheet" href="common/fonts/flaticon/font/flaticon.css">

    <link rel="stylesheet" href="common/css/aos.css">

    <link rel="stylesheet" href="common/css/style.css">
    
  </head>
  <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
  
  <div class="site-wrap">

    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>
   
    
    <header class="site-navbar py-4 js-sticky-header site-navbar-target" role="banner">

      <div class="container">
        <div class="row align-items-center">
          
          <div class="col-6 col-xl-2">
            <h1 class="mb-0 site-logo m-0 p-0"><a href="index.html" class="mb-0">River Ride.</a></h1>
          </div>

          <div class="col-12 col-md-10 d-none d-xl-block">
            <nav class="site-navigation position-relative text-right" role="navigation">

              <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
                <li><a href="#home-section" class="nav-link">Accueil</a></li>
                <li><a href="#properties-section" class="nav-link">Services</a></li>
                <li><a href="#about-section" class="nav-link">Apropos</a></li>
                <li><a href="#contact-section" class="nav-link">Contact</a></li>
              </ul>
            </nav>
          </div>


          <div class="col-6 d-inline-block d-xl-none ml-md-0 py-3"><a href="#" class="site-menu-toggle js-menu-toggle text-black float-right"><span class="icon-menu h3"></span></a></div>

        </div>
      </div>
      
    </header>

  
    
    <div class="site-blocks-cover overlay" style="background-image: url(images/hero_1.jpg);" data-aos="fade" id="home-section">


      <div class="container" style="background-color: antiquewhite;">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-6 mt-lg-5 text-center">
            <h1>Bienvenue</h1>
            <p class="mb-5">Venez decouvrir la Loire et ses paysages avec River Ride</p>
            <div class="row">
              <div class="col-md-12">
                  <a href="client/login.php" class="btn btn-primary btn-md text-white">Connexion</a>
                  <a href="client/signup.php" class="btn btn-primary btn-md text-white">Inscription</a>
              </div>
          </div>          
          </div>
        </div>
      </div>

      <a href="#howitworks-section" class="smoothscroll arrow-down"><span class="icon-arrow_downward"></span></a>
    </div>  

    
    <div class="py-5 bg-light site-section how-it-works" id="howitworks-section">
      <div class="container">
        <div class="row mb-5 justify-content-center">
          <div class="col-md-7 text-center">
            <h2 class="section-title mb-3">Comment ca marche</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4 text-center">
            <div class="pr-5">
              <span class="custom-icon flaticon-house text-primary"></span>
              <h3 class="text-dark">Trouver un hebergement</h3>
              <p>Sur River Ride, trouvez un hebergement a chaque point d'arret</p>
            </div>
          </div>

          <div class="col-md-4 text-center">
            <div class="pr-5">
              <span class="custom-icon flaticon-location text-primary"></span>
              <h3 class="text-dark">Itineraire</h3>
              <p>Composer un itineraire avec plusieurs points d'arret</p>
            </div>
          </div>

          <div class="col-md-4 text-center">
            <div class="pr-5">
              <span class="custom-icon flaticon-home text-primary"></span>
              <h3 class="text-dark">Services</h3>
              <p>Vous pouvez egalement choisir parmis nos services</p>
            </div>
          </div>
        </div>
      </div>  
    </div>


    
    <section class="site-section" id="about-section">
      <div class="container">
        
        <div class="row">
          <div class="col-lg-6">

            <div class="owl-carousel slide-one-item-alt">
              <img src="img/fort-algues.png" alt="Image" class="img-fluid">
              <img src="img/rocarc.png" alt="Image" class="img-fluid">
              <img src="img/lac-cratere.png" alt="Image" class="img-fluid">
              <img src="img/homme-assis.png" alt="Image" class="img-fluid">
            </div>
            <div class="custom-direction">
              <a href="#" class="custom-prev">Pre</a><a href="#" class="custom-next">Suivant</a>
            </div>

          </div>
          <div class="col-lg-5 ml-auto">
            
            <h2 class="section-title mb-3">Qui sommes-nous ?</h2>
                <p class="lead">River Ride est bien plus qu'une simple aventure aquatique. Nous sommes une équipe passionnée et dévouée à vous offrir une expérience unique au cœur de la Loire.</p>
                <p>Notre mission est de vous emmener loin des sentiers battus, le long des cours d'eau les plus captivants et des paysages les plus époustouflants. Avec une combinaison parfaite de sports nautiques passionnants et de découvertes paisibles, nous créons des souvenirs inoubliables pour les voyageurs en quête d'aventure.</p>

          </div>
        </div>
      </div>

    <div class="site-section" id="properties-section">
      <div class="container">
        <div class="row mb-5 align-items-center">
          <div class="col-md-7 text-left">
            <h2 class="section-title mb-3">Services</h2>
          </div>
          <div class="col-md-5 text-left text-md-right">
            <div class="custom-nav1">
              <a href="#" class="custom-prev1">Precedent</a><span class="mx-3">/</span><a href="#" class="custom-next1">Suivant</a>
            </div>
          </div>
        </div>

        <div class="owl-carousel nonloop-block-13 mb-5">

          <div class="property">
            <a href="property-single.html">
              <img src="img/canoe2pers.png" alt="Image" class="img-fluid">
            </a>
            <div class="prop-details p-3">
              <div>River Ride</div>
            </div>
          </div>

          <div class="property">
            <a href="property-single.html">
              <img src="img/canoechateau3pers.png" alt="Image" class="img-fluid">
            </a>
            <div class="prop-details p-3">
              <div>River Ride</div>
            </div>
          </div>

          <div class="property">
            <a href="property-single.html">
              <img src="img/plan-la-loire.png" alt="Image" class="img-fluid">
            </a>
            <div class="prop-details p-3">
              <div>River Ride</div>
            </div>
          </div>

          <div class="property">
            <a href="property-single.html">
              <img src="img/chateau-arcs.png" alt="Image" class="img-fluid">
            </a>
            <div class="prop-details p-3">
              <div>River Ride</div>
            </div>
          </div>

        </div>
      </div>
    </div>

    </section>

    

    <section class="site-section border-bottom bg-light" id="services-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-12 text-center">
            <h2 class="section-title mb-3">Services</h2>
          </div>
        </div>
        <div class="row align-items-stretch">
          <div class="col-md-6 col-lg-4 mb-4 mb-lg-4" data-aos="fade-up">
            <div class="unit-4 d-flex">
              <div class="unit-4-icon mr-4"><span class="text-primary flaticon-house"></span></div>
              <div>
                <h3>Hebergement</h3>
                <p>Sur River Ride, trouvez un hebergement a chaque point d'arret.</p>
                <p><a href="#">En savoir plus...</a></p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 mb-4 mb-lg-4" data-aos="fade-up" data-aos-delay="200">
            <div class="unit-4 d-flex">
              <div class="unit-4-icon mr-4"><span class="text-primary flaticon-home"></span></div>
              <div>
                <h3>Services complementaires</h3>
                <p>Vous pouvez egalement choisir parmis nos services.</p>
                <p><a href="#">En savoir plus...</a></p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 mb-4 mb-lg-4" data-aos="fade-up" data-aos-delay="400">
            <div class="unit-4 d-flex">
              <div class="unit-4-icon mr-4"><span class="text-primary flaticon-location"></span></div>
              <div>
                <h3>Itineraires</h3>
                <p>Composer un itineraire avec plusieurs points d'arret.</p>
                <p><a href="#">En savoir plus...</a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>



    <section class="site-section bg-light bg-image" id="contact-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-12 text-center">
            <!-- <h3 class="section-sub-title">Get</h3> -->
            <h2 class="section-title mb-3">Nous contacter</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-md-7 mb-5">

            

            <form action="#" class="p-5 bg-white">
              
              <h2 class="h4 text-black mb-5">Contact</h2> 

              <div class="row form-group">
                <div class="col-md-6 mb-3 mb-md-0">
                  <label class="text-black" for="fname">Prenom</label>
                  <input type="text" id="fname" class="form-control">
                </div>
                <div class="col-md-6">
                  <label class="text-black" for="lname">Nom</label>
                  <input type="text" id="lname" class="form-control">
                </div>
              </div>

              <div class="row form-group">
                
                <div class="col-md-12">
                  <label class="text-black" for="email">Email</label> 
                  <input type="email" id="email" class="form-control">
                </div>
              </div>

              <div class="row form-group">
                
                <div class="col-md-12">
                  <label class="text-black" for="subject">Suject</label> 
                  <input type="subject" id="subject" class="form-control">
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="message">Message</label> 
                  <textarea name="message" id="message" cols="30" rows="7" class="form-control" placeholder="Ecrivez vos notes ou questions ici..."></textarea>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <input type="submit" value="Envoyer un Message" class="btn btn-primary btn-md text-white">
                </div>
              </div>

  
            </form>
          </div>
          <div class="col-md-5">
            
            <div class="p-4 mb-3 bg-white">
              <p class="mb-0 font-weight-bold">Adresse</p>
              <p class="mb-4">242 Rue du Faubourg Saint-Antoine, 75012 Paris</p>

              <p class="mb-0 font-weight-bold">Telephone</p>
              <p class="mb-4"><a href="#">+ 232 3235 324</a></p>

              <p class="mb-0 font-weight-bold">Adresse Email </p>
              <p class="mb-0"><a href="#">riverride@domain.com</a></p>

            </div>
            
          </div>
        </div>
      </div>
    </section>

    
    <footer class="site-footer">
      <div class="container">
        <div class="row">
          <div class="col-md-8">
            <div class="row">
              <div class="col-md-5">
                <h2 class="footer-heading mb-4">About Stated</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque facere laudantium magnam voluptatum autem. Amet aliquid nesciunt veritatis aliquam.</p>
              </div>
              <div class="col-md-3 ml-auto">
                <h2 class="footer-heading mb-4">Quick Links</h2>
                <ul class="list-unstyled">
                  <li><a href="#">About Us</a></li>
                  <li><a href="#">Services</a></li>
                  <li><a href="#">Testimonials</a></li>
                  <li><a href="#">Contact Us</a></li>
                </ul>
              </div>
              
            </div>
          </div>
          <div class="col-md-4">
            <div class="mb-4">
              <h2 class="footer-heading mb-4">Subscribe Newsletter</h2>
            <form action="#" method="post" class="footer-subscribe">
              <div class="input-group mb-3">
                <input type="text" class="form-control border-secondary text-white bg-transparent" placeholder="Enter Email" aria-label="Enter Email" aria-describedby="button-addon2">
                <div class="input-group-append">
                  <button class="btn btn-primary text-black" type="button" id="button-addon2">Send</button>
                </div>
              </div>
            </form>  
            </div>
            
            <div class="">
              <h2 class="footer-heading mb-4">Follow Us</h2>
                <a href="#" class="pl-0 pr-3"><span class="icon-facebook"></span></a>
                <a href="#" class="pl-3 pr-3"><span class="icon-twitter"></span></a>
                <a href="#" class="pl-3 pr-3"><span class="icon-instagram"></span></a>
                <a href="#" class="pl-3 pr-3"><span class="icon-linkedin"></span></a>
            </div>


          </div>
        </div>
        <div class="row pt-5 mt-5 text-center">
          <div class="col-md-12">
            <div class="border-top pt-5">
            <p>
        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
        Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="dashboard/admin_login.php" target="_blank" >Pauline</a>
        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
      </p>
            </div>
          </div>
          
        </div>
      </div>
    </footer>

  </div> <!-- .site-wrap -->

  <script src="common/js/jquery-3.3.1.min.js"></script>
  <script src="common/js/jquery-migrate-3.0.1.min.js"></script>
  <script src="common/js/jquery-ui.js"></script>
  <script src="common/js/popper.min.js"></script>
  <script src="common/js/bootstrap.min.js"></script>
  <script src="common/js/owl.carousel.min.js"></script>
  <script src="common/js/jquery.stellar.min.js"></script>
  <script src="common/js/jquery.countdown.min.js"></script>
  <script src="common/js/bootstrap-datepicker.min.js"></script>
  <script src="common/js/jquery.easing.1.3.js"></script>
  <script src="common/js/aos.js"></script>
  <script src="common/js/jquery.fancybox.min.js"></script>
  <script src="common/js/jquery.sticky.js"></script>

  
  <script src="common/js/main.js"></script>
    
  </body>
</html>