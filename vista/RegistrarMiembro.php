<?php
// Incluir el archivo de conexión a la base de datos
include('../Modelo/conexion.php');

// Verificar si se ha enviado el formulario
if (isset($_POST['Guardar'])) {

    // Verificar si hay errores en la conexión
    if ($conn->connect_error) {
        die("Error al conectar a la base de datos: " . $conn->connect_error);
    }

    // Obtener los datos del formulario

    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $ID_unidad = $_POST['ID_unidad']; 
    $fecha_naci = $_POST['fecha_naci'];
    $fecha_ingreso = $_POST['fecha_ingreso'];
    $fecha_promesa = $_POST['fecha_promesa'];
    $contacto = $_POST['contacto']; 
    $email = $_POST['email']; 
    $DNSI = $_POST['DNSI'];

    // Insertar los datos en la tabla de la base de datos
    $sql = "INSERT INTO miembro ( nombres, apellidos, ID_unidad, fecha_naci, fecha_ingreso, fecha_promesa, contacto, email, DNSI)
            VALUES ('$nombres', '$apellidos', '$ID_unidad' ,'$fecha_naci', '$fecha_ingreso', '$fecha_promesa', '$contacto', '$email', '$DNSI' )";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
        alert('Registro exitoso');
    </script>";
    } else{
        echo "Error al registrar los datos: " . $conn->error;
    }
   
     
    
    }   

    // Función para obtener el nombre de la unidad
    function obtenerNombreUnidad($conn, $ID_unidad) {
        $sql = "SELECT unidad FROM unidad WHERE ID_unidad = $ID_unidad";
        $result = mysqli_query($conn, $sql);
 
            if ($row = mysqli_fetch_assoc($result)) {
                 return $row['unidad'];
             } else {
          return "unidad no encontrada";
         }
       }
 
           // Consulta SQL para obtener los datos de los miembros
         $sql = "SELECT * FROM miembro";
         $result = mysqli_query($conn, $sql);
 
         if (!$result) {
       die("Error al consultar la base de datos: " . mysqli_error($conn));
       }

     // Función para eliminar un producto del inventario
        if (isset($_GET['eliminar'])) {
          $ID_miembro = $_GET['eliminar'];

          $sql = "DELETE FROM miembro WHERE ID_miembro=$ID_miembro";
           if (mysqli_query($conn, $sql)) {
               header("Location: RegistrarMiembro.php");
           } else {
        
            echo "Error al eliminar el producto: " . mysqli_error($conn);
               }
        }
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Miembros</title>

    <!-- Agrega la hoja de estilo de Bootstrap -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> 
     <!-- Agrega tu hoja de estilo personalizada -->
     <link rel="stylesheet" type="text/css" href="../controlador/Style_Miembros.css">
</head>
<body>
<div class="container mt-4">
        <h1 class="text-center mb-4">Registrar Miembros</h1>

        <!-- Formulario para agregar un nuevo Miembro -->
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h2 class="my-3">Agregar Nuevo Miembro del Grupo</h2>
                <div class="mt-4">
                    <a href="menuprincipal.php" class="btn btn-secondary">Regresar al Menú Principal</a>
                </div>
            </div>

          <div class="card-body">
             <form method="POST" id="FormularioMiembro" onsubmit="guardarDatos(event)">

                <div class="input-box">
              
                  <label for="DNSI" >DNSI</label>
                 <input type="text" class="form-control" name="DNSI" id="DNSI" placeholder="DNSI" required>
                </div>

                  <div class="input-box">
                 <label for="nombres" >Nombres</label>                               
                 <input type="text" class="form-control" id="nombres" name="nombres" placeholder="Nombres del miembro" required>
                 </div>

             
                 <label for="apellidos" >Apellidos</label>
                 <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Apellidos del miembro">
               
           
              
                 <label for="ID_unidad">Unidad perteneciente actualmente</label>
                   <select class="form-control" id="ID_unidad" name="ID_unidad">
                   <?php
                            // Consulta SQL para obtener las categorías
                            $sqlCategorias = "SELECT ID_unidad, unidad FROM unidad";
                            $resultCategorias = mysqli_query($conn, $sqlCategorias);

                            if ($resultCategorias) {
                                while ($rowCategoria = mysqli_fetch_assoc($resultCategorias)) {
                                    echo "<option value='" . $rowCategoria['ID_unidad'] . "'>" . $rowCategoria['unidad'] . "</option>";
                                }
                            }
                            ?>
             </select>

            
                 <div class="grupo">
                 <label for="fecha_naci" >Fecha de nacimiento</label>
                 <input type="date" class="form-control" id="fecha_naci" name="fecha_naci">
                 </div>
             
              
                 <label for="fecha_ingreso" >Fecha de ingreso al movimiento Scouts</label>
                 <input type="date" class="form-control" id="fecha_ingreso" name="fecha_ingreso" placeholder="">
             

              
                 <label for="fecha_promesa" >Fecha de promesa en el Grupo General Jacinto Lara</label>
                 <input type="date" class="form-control" id="fecha_promesa" name="fecha_promesa" placeholder="">
              

            
                 <label for="contacto" >Contacto</label>
                 <input type="text" class="form-control" id="contacto" name="contacto" placeholder="Numero de contacto">
              

           
                 <label for="email" >Email</label>
                 <input type="email" class="form-control" id="email" name="email" placeholder="Email">
            
             
                  <br>
                 <button type="Guardar" name="Guardar" class="btn btn-primary">Guardar</button>
                 
                 </div>     
              </form>
              <script>/*
                 function guardarDatos(event) {
                  event.preventDefault(); // Evita que el formulario se envíe de forma predeterminada
 
                    // Recolecta los datos del formulario
                    var formulario = document.getElementById("FormularioMiembro");
                    var datos = new FormData(formulario);

                              // Recolecta los datos del formulario
                       var formulario = document.getElementById("FormularioMiembro");
                       var datos = new FormData(formulario);

                       // Realiza la petición AJAX para guardar los datos
                    var xhr = new XMLHttpRequest();
                    xhr.open("POST", "RegistrarMiembro.php", true);
                    xhr.onreadystatechange = function () {

                        if (xhr.readyState === 4 && xhr.status === 200) {
                     // Maneja la respuesta del servidor
                     var respuesta = xhr.responseText;
                       console.log(respuesta); // Verifica la respuesta del servidor en la consola

                       console.log("Registro Exitoso!");
                         }
                        };
                     xhr.send(datos);

                         // Limpia los campos del formulario
                    document.getElementById("FormularioMiembro").reset();
                     }*/
              </script>
              </div>

           </div>


                <!-- Mostrar los datos del inventario en una tabla -->
        <div class="card mt-4">
            <div class="card-header bg-primary text-white">
                <h2 class="my-3">Miembros del Grupo Scouts General Jacinto Lara</h2>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="tabla-inventario">
                        <thead>
                            <tr>
                                <th>DNSI</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Unidad</th>
                                <th>Contacto</th>
                                <th>Correo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            // Mostrar los datos del inventario en la tabla
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['DNSI'] . "</td>";
                                echo "<td>" . $row['nombres'] . "</td>";
                                echo "<td>" . $row['apellidos'] . "</td>";
                                // Utiliza la función para obtener el nombre de la unidad
                                echo "<td>" . obtenerNombreUnidad($conn, $row['ID_unidad']) . "</td>";
                                echo "<td>" . $row['contacto'] . "</td>";
                                echo "<td>" . $row['email'] . "</td>";
                                echo "<td>";
                                echo "<a href='#?id=" . $row['ID_miembro'] . "' class='btn btn-warning btn-sm'>Editar</a> ";
                                echo "<a href='#?eliminar=" . $row['ID_miembro'] . "' class='btn btn-danger btn-sm'>Eliminar</a>";
                                echo "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
               

       
</body>
</html>