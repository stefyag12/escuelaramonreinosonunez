<?php
// Conexión a la base de datos
$conexion = new mysqli('localhost', 'root', '', 'inscripcion');

// Verificar si se ha producido algún error
if ($conexion->connect_error) {
    die('Error de conexión: ' . $conexion->connect_error);
}

// Obtener la cédula a eliminar desde el formulario
$id = $_POST['id'];

// Eliminar el registro correspondiente de la tabla "nombre_de_la_tabla"
$sql = "DELETE FROM inscripciones WHERE cedula = $id";
if ($conexion->query($sql) === TRUE) {
    echo "Registro eliminado satisfactoriamente";
} else {
    echo "Error al eliminar el registro: " . $conexion->error;
}

// Cerrar la conexión
$conexion->close();

header('Location: siguiente.php');
exit;
?>
