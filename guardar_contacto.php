<?php
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    die("Método no permitido");
}

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "travel_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener datos del formulario
$nombre = $conn->real_escape_string($_POST['nombre']);
$correo = $conn->real_escape_string($_POST['correo']);
$telefono = $conn->real_escape_string($_POST['telefono']);
$mensaje = $conn->real_escape_string($_POST['mensaje']);

$sql = "INSERT INTO contactos (nombre, correo, telefono, mensaje) VALUES ('$nombre', '$correo', '$telefono', '$mensaje')";
if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Comentario enviado exitosamente'); window.location.href='contacto.html';</script>";
} else {
    echo "Error al guardar los datos: " . $conn->error;
}

$conn->close();
?>
