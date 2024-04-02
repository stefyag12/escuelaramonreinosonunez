<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            background-image: url(https://i.ibb.co/wpXRc8c/Colorido-Ilustraci-n-Proyecto-de-Grupo-En-Blanco-Presentaci-n-de-Educaci-n-6.png);
            background-repeat: no-repeat;
            background-size: cover;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        h2 {
            text-align: center;
            margin-top: 20px;
            color: #333;
            font-size: 36px;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #dddddd;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            color: #333;
        }

        tr:nth-child(even) {
            background-color: #f8f8f8;
        }

        tr:hover {
            background-color: #ddd;
        }

        select, input[type="submit"], input[type="text"] {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        select {
            width: 150px;
        }

        input[type="submit"] {
            background-color: #047184;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: ##047184;
        }

        input[type="text"] {
            width: 80px; /* Reducido el ancho del campo de texto */
            margin-right: 10px; /* Añadido espacio entre el campo de texto y el botón */
        }

        a {
            text-decoration: none;
            color: #1e90ff;
            font-weight: bold;
            transition: color 0.3s;
            display: inline-block;
            padding: 10px 20px;
            background-color: ##047184;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            margin-right: 10px;
        }

        a:hover {
            color: ##047184;
        }
        
        .regresar {
            text-decoration: none;
            color: white;
            display: inline-block;
            padding: 10px 20px;
            background-color: #047184;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 10px; /* Ajuste para separar del formulario */
            margin-left: 1500px; /* Mueve el enlace al lado izquierdo */
        }
        
    </style>
    <title>Notas Detalladas</title>
</head>
<body>
<br><br>
<h2 style="color: white;">Visualizar las notas de los Estudiantes</h2><br><br><br>

<!-- Botón de regresar -->
<a href="menu3.html" class="regresar">Regresar al menú</a>
</p>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

    <select id="grado" name="grado" required>
        <option value="">Grado</option>
        <option value="1ero">1ero</option>
        <option value="2do">2do</option>
        <option value="3ero">3ero</option>
        <option value="4to">4to</option>
        <option value="5to">5to</option>
        <option value="6to">6to</option>
    </select>
    <input type="submit" value="Buscar">
</form>

<table border="1">
    <tr>
        <th>Cédula</th>
        <th>Nombre</th>
        <th>Grado</th>
        <th>Profesor Asignado</th>
        <th>Nota Final</th>
    </tr>
   <?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "inscripcion");

// Comprobar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Procesar la entrada del usuario
    $grado = isset($_POST["grado"]) ? $_POST["grado"] : '';

    if (!empty($grado)) {
        // Consulta SQL para obtener la información del estudiante, profesor y nota
        $sql = "SELECT inscripciones.cedula, inscripciones.nombre_estudiante, inscripciones.grado, registrodocente.nombre_docente, notas.nota 
                FROM inscripciones 
                INNER JOIN registrodocente ON inscripciones.grado = registrodocente.grado 
                LEFT JOIN notas ON inscripciones.cedula = notas.cedula 
                WHERE inscripciones.grado = '$grado'";

        $result = $conexion->query($sql);

        if ($result->num_rows > 0) {
            // Mostrar datos de cada estudiante
            while ($fila = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $fila['cedula'] . "</td>";
                echo "<td>" . $fila['nombre_estudiante'] . "</td>";
                echo "<td>" . $fila['grado'] . "</td>";
                echo "<td>" . $fila['nombre_docente'] . "</td>";
                echo "<td>";
                // Mostrar la nota del estudiante si está definida
                if (!empty($fila['nota'])) {
                    echo $fila['nota'];
                } else {
                    echo "S/N";
                }
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No se encontraron estudiantes</td></tr>";
        }
    } else {
        echo "<tr><td colspan='5'>Seleccione un grado para buscar</td></tr>";
    }
}

$conexion->close();
?>

</table>

</body>
</html>
