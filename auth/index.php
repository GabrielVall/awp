<?php
session_start();
if( isset($_SESSION['id_usuario_bxpress']) && isset($_SESSION['nivel_bxpress']) ){
    switch ($_SESSION['nivel_bxpress']) {
      case 5:
        case 1:
        header('Location: ../sucursal/');
        break;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="style.css" />
    <title>Accede</title>
  </head>
  <body>
    
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
          <div class="form sign-in-form">
            <h2 class="title">Inicia sesión</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Correo o usuario" id="usuario"/>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Contraseña" id="pass"/>
            </div>
            <input type="submit" id="btn_login" value="Accede" class="btn solid" />
            <p class="social-text">O accede con una plataforma</p>
            <div class="social-media">
              <a href="#" class="social-icon">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-google"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </div>
          </div>
          <div class="form sign-up-form">
            <h2 class="title">Registrate</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Usuario" />
            </div>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="email" placeholder="Correo" />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Contraseña" />
            </div>
            <input type="submit" class="btn" value="Registrate" />
            <p class="social-text">O accede con una plataforma</p>
            <div class="social-media">
              <a href="#" class="social-icon">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-google"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </div>
          </div>
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>¿Eres nuevo?</h3>
            <p>¡Crea tu cuenta ahora y obten todas las ofertas que tenemos para ti! </p>
            <button class="btn transparent" id="sign-up-btn">
              Registrate
            </button>
          </div>
          <img src="img/login.png" class="image" alt="" />
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3>¿Tienes tu cuenta?</h3>
            <p>
              Ingresa a tu cuenta
            </p>
            <button class="btn transparent" id="sign-in-btn">
              Acceder
            </button>
          </div>
          <img src="img/register.png" class="image" alt="" />
        </div>
      </div>
    </div>
    <script src="jquery-3.6.0.min.js"></script>
    <script src="sweet_alert.min.js"></script>
    <script src="app.js"></script>
  </body>
</html>
