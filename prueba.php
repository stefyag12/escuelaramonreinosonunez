<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matricula Escolar</title>
       <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        select {
            padding: 5px;
            margin: 0 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            padding: 5px 10px;
            border-radius: 5px;
            border: none;
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }

        table {
            width: 80%;
            margin: 0 auto;
            border-collapse: collapse;
            border: 1px solid #ddd;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        td[colspan="3"] {
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Matricula Escolar</h1>
     <br> <br>
    <form method="GET">
        <label for="grado">Seleccione el grado:</label>
        <select name="grado" id="grado">
            <option value="1">Primero</option>
            <option value="2">Segundo</option>
            <option value="3">Tercero</option>
            <option value="4">Cuarto</option>
            <option value="5">Quinto</option>
            <option value="6">Sexto</option>
        </select>
        <input type="submit" value="Buscar">
    </form>
     <br> <br>

    <table border="1">
        <tr>
            <th>Nombre Estudiante</th>
            <th>Grado</th>
            <th>Profesor Asignado</th>
        </tr>
        <?php
        // Conexión a la base de datos
        $conexion = new mysqli("localhost", "root", "", "inscripcion");
        if ($conexion->connect_error) {
            die("Conexión fallida: " . $conexion->connect_error);
        }

        // Obtener el grado seleccionado del formulario
        $grado_seleccionado = isset($_GET['grado']) ? $_GET['grado'] : null;

        // Consulta SQL para obtener la información de la relación estudiante-profesor filtrada por grado
        $consulta = "SELECT i.nombre_estudiante, i.grado AS grado_estudiante, r.nombre_docente
                     FROM inscripciones i
                     JOIN registrodocente r ON i.grado = r.grado
                     WHERE i.grado = ?";
                     
        // Preparar la consulta
        $stmt = $conexion->prepare($consulta);
        if ($stmt) {
            // Asignar el grado seleccionado como parámetro de la consulta preparada
            $stmt->bind_param("i", $grado_seleccionado);
            // Ejecutar la consulta
            $stmt->execute();
            // Obtener resultados
            $resultado = $stmt->get_result();

            // Mostrar resultados en la tabla
            if ($resultado->num_rows > 0) {
                while ($fila = $resultado->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $fila["nombre_estudiante"] . "</td>";
                    echo "<td>" . $fila["grado_estudiante"] . "</td>";
                    echo "<td>" . $fila["nombre_docente"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No hay resultados</td></tr>";
            }
            // Cerrar consulta preparada
            $stmt->close();
        } else {
            echo "Error al preparar la consulta: " . $conexion->error;
        }

        // Cerrar conexión
        $conexion->close();
        ?>
    </table>
</body>
</html>
