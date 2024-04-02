<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guardar Nota</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
        }

        .container {
            text-align: center;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        input[type="text"],
        input[type="number"],
        input[type="submit"] {
            margin-bottom: 10px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .buttons {
            margin-top: 20px;
        }

        .buttons a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            margin-right: 10px;
        }

        .buttons a:last-child {
            margin-right: 0;
        }

        .buttons a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
       <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener la información del formulario
    $cedula = $_POST["cedula"];
    $nota = $_POST["nota"];

    // Validar que la cédula y la nota no estén vacías
    if (!empty($cedula) && !empty($nota)) {
        // Conectar a la base de datos
        $conexion = new mysqli("localhost", "root", "", "inscripcion");

        // Verificar la conexión
        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }

        // Verificar si ya existe una nota para el estudiante
        $consulta_existencia = "SELECT * FROM notas WHERE cedula = ?";
        $stmt_existencia = $conexion->prepare($consulta_existencia);
        $stmt_existencia->bind_param("s", $cedula);
        $stmt_existencia->execute();
        $resultado_existencia = $stmt_existencia->get_result();

        // Si no existe una nota para el estudiante, insertar una nueva nota
        if ($resultado_existencia->num_rows == 0) {
            // Preparar la consulta para insertar la nota en la tabla notas
            $sql = "INSERT INTO notas (cedula, nota) VALUES (?, ?)";

            // Preparar la sentencia
            $stmt = $conexion->prepare($sql);

            // Verificar si la sentencia se preparó correctamente
            if ($stmt === false) {
                die("Error al preparar la consulta: " . $conexion->error);
            }

            // Vincular los parámetros
            $stmt->bind_param("ss", $cedula, $nota);

            // Ejecutar la consulta
            if ($stmt->execute() === true) {
                echo "<p>La nota se guardó correctamente.</p>";
            } else {
                echo "<p>Error al guardar la nota: " . $stmt->error . "</p>";
            }

            // Cerrar la sentencia
            $stmt->close();
        } else {
            echo "<p>Ya existe una nota para este estudiante.</p>";
        }

        // Cerrar la conexión y liberar los recursos
        $stmt_existencia->close();
        $conexion->close();
    } else {
        echo "<p>La nota no pueden estar vacías.</p>";
    }
} else {
    // Si no es una solicitud POST, redireccionar a la página principal
    header("Location: index.php");
    exit();
}
?>

        <div class="buttons">
            <a href="notas.php">Regresar</a>
            <a href="menu3.html">Volver a inicio</a>
        </div>
    </div>
</body>
</html>
