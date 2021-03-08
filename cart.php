
<?php
session_start();
if ($_SESSION['cart']){
  $usuario = $_SESSION['cart'];
  require_once('./db.php');
  $pdo = getPdo();
  $total = 0;


  foreach ($usuario as $key => $value) {
    $idParam = $value['idProducto'];
    $cantidad[] = $value['cantidad'];
    $talla[] = $value['talla'];
    $sql = "select * from productos where id= ?";
    $sqlImagenes = "select * from imagenes where productos_id = ?";
    $consulta = $pdo->prepare($sql);
    $consulta->execute([$idParam]);
    $consultaImagenes = $pdo->prepare($sqlImagenes);
    $consultaImagenes->execute([$idParam]);
    $productos[] = $consulta->fetchAll(PDO::FETCH_ASSOC);
    $imagenes[] = $consultaImagenes->fetchALL(PDO::FETCH_ASSOC);
  }
}else{
  header('location: products.php');
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
            <img src="images/logo.png" alt="" width="125px"
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
        /><?php echo count($_SESSION['cart']); ?></a>
        <img
          src="images/menu.png"
          alt=""
          class="menu-icon"
          onclick="menutoggle()"
        />
      </div>
    </div>

    <!-- Cart Items Details -->
    <div class="small-container cart-page">
      <table>
        <tr>
          <th>Product</th>
          <th>Quantity</th>
          <th>Size</th>
          <th>Subtotal</th>
        </tr>

        <?php 
        //$primeraImagen = current ($imagenes);
        foreach ($productos as $llave1 => $key ) {
          foreach ($key as $value) {
        ?>
        <tr>
          <td>
            <div class="cart-info">
            <?php foreach ($imagenes as $llave => $imagen){
              if ($llave1 == $llave){
                foreach ($imagen as  $url){
            ?>   
              <img src="images/<?php echo $url['url'] ?>" alt="" />
              <?php } ?>
            <?php } ?>
            <?php } ?>

              <div>
                <p><?php echo $value['nombre']; ?></p>
                <small>Price: $<?php echo $value['precio']; ?></small>
                <br />
                <a href="removeProducto.php?id_producto=<?php echo $llave1; ?>">Remove</a>
              </div>
            </div>
          </td>
          <td><input type="number" disabled value="<?php echo $cantidad[$llave1]; ?>" /></td>
          <td><input type="text" disabled value="<?php echo $talla[$llave1]; ?>" /></td>
          <?php 
          $suma = $cantidad[$llave1]* $value['precio'];
          $sumaTotal[]= $suma;
          ?>
          <td><?php echo $suma; ?></td>
        </tr>
        <?php } ?>
        <?php } ?>
      </table>

      <div class="total-price">
        <table>
          <tr>
            <td>Subtotal</td>
            <td>$<?php foreach ($sumaTotal as $key => $value){
              $total += $value; 
            }
            echo $total; ?></td>
          </tr>
          <tr>
            <td>IVA</td>
            <?php $iva = $total * 0.19; ?>
            <td>$<?php echo $iva; ?></td>
          </tr>
          <tr>
            <td>Total</td>
            <?php $totalProductos = $total + $iva ;?>
            <td>$<?php echo $totalProductos; ?></td>
          </tr>
        </table>
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
