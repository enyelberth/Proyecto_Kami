<?php 
// Incluir el archivo de conexión a la base de datos
include('../Modelo/conexion.php');

// Obtener la unidad manada
$unidad = "manada";

// Consulta SQL para filtrar los miembros según la unidad
$sql = "SELECT m.nombres, m.apellidos, m.contacto, m.email, m.DNSI, m.fecha_naci
        FROM miembro m
        JOIN unidad u ON m.ID_unidad = u.ID_unidad
        WHERE u.unidad = '$unidad'";
// Ejecutar la consulta
$result = $conn->query($sql);

/*// Verificar si se encontraron resultados
if ($result->num_rows > 0) {
    // Recorrer los resultados y mostrar los miembros
    while ($row = $result->fetch_assoc()) {
        echo "Nombre: " . $row["nombres"] . ", Email: " . $row["email"] . "<br>";
    }
} else {
    echo "No se encontraron miembros en la unidad especificada.";
}
*/
// Cerrar la conexión
$conn->close();
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-------boopstrap------------>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
     <!-------css------------>
     <link rel="stylesheet" href="controlador/style_HistorialManada.css">
    <title>Historial Manada</title>
    
</head>
<body>
<div class="card mt-4">
    <div class="card-header p-3 mb-2 bg-warning text-dark">
        <h2 class="my-3">Historial de Miembros de Manada</h2>
    </div>
   <div class="table-responsive">
            <a href="MenuPrincipal.php" class="btn btn-primary">Menu Principal</a>
            <br>
            <input type="text" id="busqueda" placeholder="Buscar por Cédula de Productor">
            <br>
            <table class="table table-striped" id="tabla-StockMuestraSuelo">
                <thead>
                    <tr>
                        <th>DNSI</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>fecha nacimiento</th>
                        <th>Correo</th>
                    </tr>
                </thead>
                <tbody>
                    
                   <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['DNSI'] . "</td>";
                        echo "<td>" . $row['nombres'] . "</td>";
                        echo "<td>" . $row['apellidos'] . "</td>";
                        echo "<td>" . $row['fecha_naci'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>