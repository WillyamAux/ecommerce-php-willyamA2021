<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="account-page">
      <div class="container">
        <div class="row">
          <div class="col-2">
            <img src="images/image1.png" width="100%" />
          </div>
          <div class="col-2">
            <div class="form-container">
              <div class="form-btn">
                <span onclick="login()">Login</span>
                <span onclick="register()">Register</span>
                <hr id="indicator" />
              </div>
              <!-- FORMULARIO LOGIN -->
              <form method='POST' action="login.php" id="LoginForm">
                <input name="username" type="text" placeholder="Username" />
                <input name="password" type="password" placeholder="Password" />

                <button type="submit" class="btn">Login</button>
                <a href="">Forgot Password</a>
              </form>
                             <!-- FORMULARIO REGISTRO -->
              <form method='POST' action="registro.php" id="RegForm">
                <input required name="username" type="text" placeholder="Username" />
                <input required name="email" type="email" placeholder="Email" />
                <input required name="password" type="password" placeholder="Password" />
                <button type="submit" class="btn">Register</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
</body>
</html>