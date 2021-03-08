<?php
session_start();
require_once('./db.php');


$pdo = getPdo();
$sql = "select * from imagenes , productos where imagenes.productos_id = productos.id group by productos.id";
$consulta = $pdo->prepare($sql);
$consulta->execute();
$productos=$consulta->fetchALL(PDO::FETCH_ASSOC);



?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Waarshop | Ecommerce Website Design</title>
    <link rel="stylesheet" href="style.css" />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,200&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
    />
  </head>
  <body>
    <div class="header">
      <div class="container">
        <div class="navbar">
          <div class="logo">
            <a href="index.php">
              <img src="images/logo.png" alt="" width="150px"
            /></a>
          </div>
          <nav>
            <ul id="MenuItems">
              <li><a href="index.php">Home</a></li>
              <li><a href="products.php">Products</a></li>
              <li><?php 

              if (isset($_SESSION['logueado']) && isset($_SESSION['user'])){
                $userLogueado = $_SESSION['user'];
                $nombreUser = $userLogueado['nombre'];
                echo "<a href='products.php'>Bienvenido $nombreUser </a>";
              }else {
                echo '<a href="account.php">Account</a>';
              }
              ?>
              <li>  
              <?php 
              if (isset($_SESSION['logueado']) && isset($_SESSION['user'])){
                $userLogueado = $_SESSION['user'];
                $nombreUser = $userLogueado['nombre'];
                echo "<a href='logout.php'>Logout </a>";
              }else {
                echo '';
              
              }
              ?>
            
            </li>
              <!-- TODo: 22:20 -->
            </ul>
          </nav>
          <a href="cart.php"
            ><img src="images/cart.png" alt="" width="80px" height="80px"
          /></a>
          <img
            src="images/menu.png"
            alt=""
            class="menu-icon"
            onclick="menutoggle()"
          />
        </div>
        <div class="row">
          <div class="col-2">
            <h1>
              En los pequeños detalles se <br />
              conocen las grandes personas!
            </h1>
            <p>
              Lorem ipsum dolor sit amet consectetur adipisicing elit.<br />
              Voluptas rerum maiores animi officiis
            </p>
            <a href="" class="btn">Explore Now &#8594;</a>
          </div>
          <div class="col-2">
            <img src="images/image1.png" alt="" />
          </div>
        </div>
      </div>
    </div>
    <!----- Featurd Categories
    <div class="categories">
      <div class="small-container">
        <div class="row">
          <div class="col-3">
            <img src="images/category-1.jpg" alt="" />
          </div>
          <div class="col-3">
            <img src="images/category-2.jpg" alt="" />
          </div>
          <div class="col-3">
            <img src="images/category-3.jpg" alt="" />
          </div>
        </div>
      </div>
    </div>
     Featurd Products
    <div class="small-container">
      <h2 class="title">Featured Products</h2>
      <div class="row">
        <div class="col-4">
          <a href="product-details.php">
            <img src="images/product-1.jpg" alt=""
          /></a>
          <h4>Red Printed T-shirt</h4>
          <div class="rating">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star-o"></i>
          </div>
          <p>$50.00</p>
        </div>
        <div class="col-4">
          <img src="images/product-2.jpg" alt="" />
          <h4>Red Printed T-shirt</h4>
          <div class="rating">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star-half-o"></i>
            <i class="fa fa-star-o"></i>
          </div>
          <p>$50.00</p>
        </div>
        <div class="col-4">
          <img src="images/product-3.jpg" alt="" />
          <h4>Red Printed T-shirt</h4>
          <div class="rating">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star-half-o"></i>
          </div>
          <p>$50.00</p>
        </div>
        <div class="col-4">
          <img src="images/product-4.jpg" alt="" />
          <h4>Red Printed T-shirt</h4>
          <div class="rating">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star-o"></i>
          </div>
          <p>$50.00</p>
        </div>
      </div>
      --------->
      <div class="small-container">
      <h2 class="title">Featured Products</h2>
      <div class="row">

      <?php foreach ($productos as $prod){?>
        <div class="col-4">
        <a href=" <?php echo "product-details.php?id=".$prod['id']; ?>"> <img src="images/<?php echo $prod['url']; ?>" alt="" />
          <a href=" <?php echo "product-details.php?id=".$prod['id']; ?>"> <?php echo $prod['nombre']; ?></a>
          </h4>
          <div class="rating">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star-o"></i>
          </div>
          <p>$<?php echo $prod['precio']; ?></p>
        </div>
      <?php } ?>
      </div>
    </div>

    <!-------- Offer --------->
    <div class="offer">
      <div class="small-container">
        <div class="row">
          <div class="col-2">
            <img src="images/exclusive.png" class="offer-img" alt="" />
          </div>
          <div class="col-2">
            <p>Exclusively available on Waarshop</p>
            <h1></h1>
            <small
              >Lorem ipsum dolor sit amet consectetur adipisicing elit.
              Excepturi rerum maiores eveniet minus ut deserunt vitae
            </small>
            <a href="" class="btn">Buy Now &#8594;</a>
          </div>
        </div>
      </div>
    </div>

    <!------ Testimonial  ------>
    <div class="testimonial">
      <div class="small-container">
        <div class="row">
          <div class="col-3">
            <i class="fa fa-quote-left"></i>

            <p>
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea, esse
              quae ex sequi praesentium fuga voluptatem placeat voluptates odio
              rerum.
            </p>
            <div class="rating">
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star-o"></i>
            </div>
            <img src="images/user-1.png" alt="" />
            <h3>Willyam Aux</h3>
          </div>

          
        </div>
      </div>
    </div>

    <!-- Brands -->

    <!---------<div class="brands">
      <div class="small-container">
        <div class="row">
          <div class="col-5">
            <img src="images/logo-godrej.png" alt="" />
          </div>
          <div class="col-5">
            <img src="images/logo-oppo.png" alt="" />
          </div>
          <div class="col-5">
            <img src="images/logo-paypal.png" alt="" />
          </div>
          <div class="col-5">
            <img src="images/logo-philips.png" alt="" />
          </div>
          <div class="col-5">
            <img src="images/logo-coca-cola.png" alt="" />
          </div>
        </div>
      </div>
    </div>
    ---------->
    <!-- Footer -->
    <div class="footer">
      <div class="container">
        <div class="row">
          <div class="footer-col-1">
            <h3>Download Our App</h3>
            <p>
              Download App for Android <br />
              and ios mobile phone
            </p>
            <div class="app-logo">
              <img src="images/play-store.png" alt="" />
              <img src="images/app-store.png" alt="" />
            </div>
          </div>
          <div class="footer-col-2">
            <img src="images/logo-white.png" alt="" />
            <p>
              Lorem, ipsum dolor sit amet consectetur <br />adipisicing elit.
              Porro, eum?
            </p>
          </div>
          <div class="footer-col-3">
            <h3>Useful Links</h3>
            <ul>
              <li>Coupons</li>
              <li>Blog Post</li>
              <li>Return Policy</li>
              <li>Join Affiliate</li>
            </ul>
          </div>

          <div class="footer-col-4">
            <h3>Follow us</h3>
            <ul>
              <li>Facebook</li>
              <li>Twitter</li>
              <li>Instagram</li>                                   m                                                                                                                                                                                                                                                  m                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
              <li>YouTube</li>
            </ul>
          </div>
        </div>
        <hr />
        <p class="copyright">Copyright 2021 - introidx</p>
      </div>
    </div>
    <!-- JS for Toggle menu -->
    <script>
      var MenuItems = document.getElementById("MenuItems");

      MenuItems.style.maxHeight = "0px";

      function menutoggle() {
        if (MenuItems.style.maxHeight == "0px") {
          MenuItems.style.maxHeight = "200px";
        } else {
          MenuItems.style.maxHeight = "0px";
        }
      }
    </script>
  </body>
</html>