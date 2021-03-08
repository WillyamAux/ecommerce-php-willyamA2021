<?php
session_start();
$usuario=$_SESSION['user'];
require_once('./db.php');


$pdo = getPdo();

$idParam = $_GET['id'];
$sql = "select * from productos where id= ?";
$sqlImagenes ="select * from imagenes where productos_id = ?";
$consulta = $pdo->prepare($sql);
$consulta->execute([$idParam]);
$consultaImagenes = $pdo->prepare($sqlImagenes);
$consultaImagenes->execute([$idParam]);
$productos=$consulta->fetch(PDO::FETCH_ASSOC);
$imagenes=$consultaImagenes->fetchALL(PDO::FETCH_ASSOC);



?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>All Products - Red store</title>
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
    <div class="container">
      <div class="navbar">
        <div class="logo">
          <a href="index.php">
            <img src="images/logo.png" alt="" width="170px"
          /></a>
        </div>
        <nav>
          <ul id="MenuItems">
            <li><a href="index.php">Home</a></li>
            <li><a href="products.php">Products</a></li>
            <li><a href="account.php">Account</a></li>
            <li><a href="account.php">Logout</a></li>
            <!-- TODo: 22:20 -->
          </ul>
        </nav>
        <a href="cart.php"
          ><img src="images/cart.png" alt="" width="30px" height="30px"
        /></a>
        <img
          src="images/menu.png"
          alt=""
          class="menu-icon"
          onclick="menutoggle()"
        />
      </div>
    </div>

    <!-- Single Products Detail -->
    <div class="small-container single-product">
      <div class="row">
        <div class="col-2">

        <?php 
        $primeraImagen = current ($imagenes);
        
        ?>
          <img src="images/<?php echo $primeraImagen['url'] ?>" width="100%" id="ProductImg" />

          <div class="small-img-row">
          <?php foreach ($imagenes as $imagen ) { ?>
      
            <div class="small-img-col">
              <img src="images/<?php echo $imagen['url']; ?>" class="small-img" />
            </div>
          <?php } ?>
          </div>
        </div>
        <div class="col-2">
          <p>Home / T-shirt</p>
          <h2><?php echo $productos['nombre']?></h2>
          <h4>$<?php echo $productos['precio']?></h4>
          <form action ="addToCart.php" method="post">
          <select required name = "talla" >
            <option value="">Select Size</option>
            <option value="XXL">XXL</option>
            <option value="XL">XL</option>
            <option value="L">Large</option>
            <option value="M">Medium</option>
            <option value="S">Small</option>
          </select>
          <input name="cantidad" type="number" value="1" />
          <input name="idProducto" type="hidden" value="<?php echo $productos['id'] ?>" />
          <input  type="submit" href="" class="btn" value ="Add to Cart"></input>
          </form>
          <h3>Product Details<i class="fa fa-indent"></i></h3>
          <br />
          <p>
          <?php echo $productos['descripcion']?>
          </p>
        </div>
      </div>
    </div>

    <!-- Title -->
    <div class="small-container">
      <div class="row row-2">
        <h2>Related Products</h2>
        <p>View More</p>
      </div>
    </div>

    <!-- Similar Products -->

    <div class="small-container">
      <div class="row">
        <div class="col-4">
          <img src="images/product-9.jpg" alt="" />
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
          <img src="images/product-10.jpg" alt="" />
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
          <img src="images/product-11.jpg" alt="" />
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
          <img src="images/product-12.jpg" alt="" />
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
    </div>

    <!-- Footer -->
    <div class="footer">
      <div class="container">
        <div class="row">
          
          <div class="footer-col-4">
            <h3>Follow us</h3>
            <ul>
              <li>Facebook</li>
              <li>Twitter</li>
              <li>Instagram</li>
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

    <!-- js for product gallery -->
    <script>
      var ProductImg = document.getElementById("ProductImg");
      var smallImg = document.getElementsByClassName("small-img");
      smallImg[0].onclick = function () {
        ProductImg.src = smallImg[0].src;
      };
      smallImg[1].onclick = function () {
        ProductImg.src = smallImg[1].src;
      };
      smallImg[2].onclick = function () {
        ProductImg.src = smallImg[2].src;
      };
      smallImg[3].onclick = function () {
        ProductImg.src = smallImg[3].src;
      };
    </script>
  </body>
</html>
