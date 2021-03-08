<?php
session_start();
require_once('./db.php');
if (isset($_GET['id_sort'])){
  switch ($_GET['id_sort']) {
    case 2:
      $pdo = getPdo();
      $sql = "select * from imagenes , productos where imagenes.productos_id = productos.id group by productos.id order by precio ASC";
      $consulta = $pdo->prepare($sql);
      $consulta->execute();
      $productos = $consulta->fetchALL(PDO::FETCH_ASSOC);
      break;
    case 3:
      $pdo = getPdo();
      $sql = "select * from imagenes , productos where imagenes.productos_id = productos.id group by productos.id order by puntaje ASC";
      $consulta = $pdo->prepare($sql);
      $consulta->execute();
      $productos = $consulta->fetchALL(PDO::FETCH_ASSOC);
      break;
    case 4:
      $pdo = getPdo();
      $sql = "select * from imagenes , productos where imagenes.productos_id = productos.id group by productos.id order by nombre ASC";
      $consulta = $pdo->prepare($sql);
      $consulta->execute();
      $productos = $consulta->fetchALL(PDO::FETCH_ASSOC);
      break;   
  }
}else{
  $pdo = getPdo();
  $sql = "select * from imagenes , productos where imagenes.productos_id = productos.id group by productos.id";
  $consulta = $pdo->prepare($sql);
  $consulta->execute();
  $productos = $consulta->fetchALL(PDO::FETCH_ASSOC);
}



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
            <li><?php 

              if (isset($_SESSION['logueado']) && isset($_SESSION['user'])){
                $userLogueado = $_SESSION['user'];
                $nombreUser = $userLogueado['nombre'];
                echo "<a href='profile.php'>Bienvenido $nombreUser </a>";
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
    </div>

    <div class="small-container">
      <div class="row row-2">
        <h2>All Products</h2>
        <select name="sort" onchange="location = this.value;">
          <option value="">Order By</option>
          <option value="products.php">Default Sorting</option>
          <option value="products.php?id_sort=2">Sort by Price</option>
          <option value="products.php?id_sort=3">Sort by Rating</option>
          <option value="products.php?id_sort=4">Sort by Name</option>
        </select>
      </div>

      <div class="row">
       <?php foreach ($productos as $prod) {  ?>
        <div class="col-4">
          <a href=" <?php echo "product-details.php?id=".$prod['id']; ?>"> <img src="images/<?php echo $prod['url']; ?>" alt="" />
          <h4>
          <a href=" <?php echo "product-details.php?id=".$prod['id']; ?>"> <?php echo $prod['nombre']; ?></a>
          </h4>
          <div class="rating">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star-o"></i>
            <i><?php echo $prod['puntaje']; ?></i>  
          </div>
          <p>$<?php echo $prod['precio']; ?></p>
        </div> 
        <?php } ?>
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
  </body>
</html>
