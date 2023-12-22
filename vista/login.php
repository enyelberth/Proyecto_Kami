<?php 
include("../modelo/conexion.php");

// Verificar si se han enviado los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Obtener los datos del formulario
  $Usuario = $_POST["username"];
  $Clave = $_POST["clave"];


  // Preparar la consulta SQL para verificar las credenciales del usuario
  $sql = "SELECT * FROM usuarios WHERE username = '$Usuario'";

  // Ejecutar la consulta SQL
  $result = $conn->query($sql);

  // Verificar si se encontró un usuario con el nombre de usuario proporcionado
  if ($result->num_rows == 1) {
      // Obtener los datos del usuario de la consulta
      $datosUsuario = $result->fetch_assoc();

      // Verificar la contraseña
      if (password_verify($Clave, $datosUsuario["clave"])) {
          // Las credenciales son válidas, iniciar sesión aquí
          // ...
          // Redirigir al usuario a la página del menú principal, por ejemplo
          header("Location: MenuPrincipal.php");
          exit(); // Asegúrate de detener la ejecución del código después de la redirección
      } else {
          echo "Contraseña incorrecta. Por favor, verifique su contraseña.";
      }
  } else {
      echo "Usuario no encontrado. Por favor, verifique su nombre de usuario.";
  }

  // Cerrar la conexión a la base de datos
  $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="fondo.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>SRGJL</title>
    
    
    <!-- Agrega tu hoja de estilo personalizada -->
    <link rel="stylesheet" type="text/css" href="../Controlador/style_login.css">

    
</head>
<body>


    <div class="fondo" ></div>
    <div class="container">
        <div class="contenido">
       
        <h2>Sistema de Registro del G.S General Jacinto Lara</h2> <img src="../recursos/logo-jacinto.png" alt=""class="logo" style="width: 200px; height: 200px;"> 
             <!-- puede ir un icono -->

             <div class="text-sci">
                <h4>"El escultismo es la educación más poderosa del carácter que existe. Fortalece la moral y el espíritu de abnegación." -Pensamientos de BP</h4>
                
                  
            </div>
        </div>


        <div class="logreg-box">
          <div class="form-box login" >
             <form method="POST" action="login.php">
                 <h2>Iniciar Sesion</h2>

                 <div class="input-box" >
                   <span class="icon" ><i class='bx bx-user-circle'></i></span>
                   <input type="texto" required name="username">
                   <label for="username"> Usuario</label>
                 </div>

                 <div class="input-box" >
                   <span class="icon" ><i class='bx bx-lock-alt'></i></span>
                   <input type="password" required name="clave">
                   <label for="clave"> Clave</label>
                 </div>
                 <button type="submit" class="btn" >Iniciar sesion</button>

                 <div class="login-registrar" >
                    <p>¿No te haz registrado? <a 
                    href="#" class="registrar-link" >Registrate aqui</a></p>
                 </div>
              </form>
          </div>

          <div class="form-box registrar" >
             <form method="POST" action="RegistrarUsuario.php">
                 <h2>Registrar Usuario</h2>

                 <div class="input-box" >
                   <span class="icon" ><i class='bx bx-user'></i></span>
                   <input type="text" required name="nombre">
                   <label for="nombre"> Nombre</label>
                 </div>

                 <div class="input-box" >
                   <span class="icon" ><i class='bx bx-user-circle'></i></span>
                   <input type="text" required name="username">
                   <label for="username"> Usuario</label>
              
                 </div>

                 <div class="input-box" >
                   <span class="icon" ><i class='bx bx-lock-alt'></i></span>
                   <input type="password" required name="clave">
                   <label for="clave"> Clave</label>
                 </div>
                 <button type="submit" class="btn" >Registrarse</button>

                 <div class="login-registrar" >

                    <p>¿Listo para iniciar sesion? <a 
                    href="#" class="login-link" >Inicia Sesion aqui</a> </p>
                 </div>
                </form>
        </div>
    </div>
    
      <script src="../controlador/scripts_login.js" ></script>
    </body>
</html>