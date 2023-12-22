<?php
// Incluir el archivo de conexión a la base de datos
include("../modelo/conexion.php");

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Inicializar variables de error
$nombreError = $usuarioError = $claveError = $rolError = "";
$nombre = $usuario = $clave = $rol = "";

// Procesar el formulario cuando se envía
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar el nombre
    if (empty($_POST["nombre"])) {
        $nombreError = "El nombre es requerido";
    } else {
        $nombre = test_input($_POST["nombre"]);
    }

    // Validar el usuario
    if (empty($_POST["username"])) {
        $usuarioError = "El usuario es requerido";
    } else {
        $usuario = test_input($_POST["username"]);
    }

    // Validar la clave
    if (empty($_POST["clave"])) {
        $claveError = "La clave es requerida";
    } else {
        $clave = test_input($_POST["clave"]);
    }

    // Si no hay errores, insertar el nuevo usuario en la base de datos
    if (empty($nombreError) && empty($usuarioError) && empty($claveError) && empty($rolError)) {
        // Hash de la clave antes de almacenarla en la base de datos (se recomienda usar algoritmos de hash más seguros que md5)
        $hashedClave = password_hash($clave, PASSWORD_DEFAULT);

        // Insertar el usuario en la base de datos utilizando sentencias preparadas para prevenir ataques de inyección SQL
        $stmt = $conn->prepare("INSERT INTO usuarios (nombre, username, clave) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nombre, $usuario, $hashedClave);

        if ($stmt->execute()) {
            // Redirigir al usuario a la página de inicio de sesión
            header("Location: login.php");
            exit();
        } else {
            echo "Error al registrar el usuario: " . $stmt->error;
        }

        $stmt->close();
    }
}
?>