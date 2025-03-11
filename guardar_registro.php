<?php
$lang = isset($_POST['lang']) ? $_POST['lang'] : 'es';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "travel_db";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Obtener datos del formulario
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$telefono = $_POST['telefono'];
$adultos = $_POST['adultos'];
$menores = $_POST['menores'];
$lugar = $_POST['lugar'];
$preferencia = $_POST['preferencia'];
$fecha_salida = $_POST['fecha_salida'];
$hora_salida = $_POST['hora_salida'];
$fecha_regreso = $_POST['fecha_regreso'];
$hora_regreso = $_POST['hora_regreso'];

// Preparar y ejecutar la consulta SQL
$sql = "INSERT INTO registros_viajes (nombre, correo, telefono, adultos, menores, lugar, preferencia_hotel, fecha_salida, hora_salida, fecha_regreso, hora_regreso)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssiissssss", $nombre, $correo, $telefono, $adultos, $menores, $lugar, $preferencia, $fecha_salida, $hora_salida, $fecha_regreso, $hora_regreso);

if ($stmt->execute()) {
    if ($lang == 'en') {
        $message = "Registration saved successfully.";
    } else {
        $message = "Registro guardado exitosamente.";
    }
    echo "<script>alert('$message'); window.location.href='registroE.html';</script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Cerrar conexión
$stmt->close();
$conn->close();
?>