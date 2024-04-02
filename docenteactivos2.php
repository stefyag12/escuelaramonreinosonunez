<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
         <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        h2 {
            text-align: center;
            margin-top: 20px;
            color: #333;
        }

        form {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            margin-right: 10px;
        }

        select {
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        input[type="submit"] {
            padding: 8px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        table {
            width: 100%;
            margin: 0 auto;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            color: #333;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
             padding: 8px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;

        }

        a:hover {
            text-decoration: underline;
        }
    </style>
   
    <title>Docentes activos</title>
</head>
<body>

<h2>Docentes Activos</h2>
<a href="menu5.html">Volver a menú anterior </a>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="grado">Buscar por grado:</label>
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
        <th>Cedula</th>
        <th>Nombre Completo</th>
        <th>Fecha de Ingreso</th>
        <th>Edad</th>
        <th>telefono</th>
        <th>email</th>
        <th>grado</th>
        <th>fecha de nacimiento</th>
        <th>sexo</th>
        <th>direccion</th>
        <th>Titulo de licenciatura</th>
        <th>Copia de Cédula</th>
        <th>Foto tipo Carnet</th>
        <th>Constancia de residencia</th>
        <th>Curriculum Vitae</th>
        <th>observacion</th>
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
        $grado= isset($_POST["grado"]) ? $_POST["grado"] : '';

        if (!empty($grado)) {
            $sql = "SELECT * FROM registrodocente WHERE grado = '$grado'";
            $result = $conexion->query($sql);

            if ($result->num_rows > 0) {
                // Mostrar datos de cada estudiante
                while ($fila = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $fila['cedula'] . "</td>";
                    echo "<td>" . $fila['nombre_docente'] . "</td>";
                    echo "<td>" . $fila['fecha_ingreso'] . "</td>";
                    echo "<td>" . $fila['edad'] . "</td>";
                    echo "<td>" . $fila["telefono"] . "</td>";
                    echo "<td>" . $fila["email"] . "</td>";
                    echo "<td>" . $fila["grado"] . "</td>";
                    echo "<td>" . $fila["fecha_nacimiento"] . "</td>";
                    echo "<td>" . $fila["sexo"] . "</td>";
                    echo "<td>" . $fila["direccion"] . "</td>";
                    echo "<td>" . $fila["acta"] . "</td>";
                    echo "<td>" . $fila["fotorep"] . "</td>";
                    echo "<td>" . $fila["vacuna"] . "</td>";
                    echo "<td>" . $fila["certificado"] . "</td>";
                    echo "<td>" . $fila["fotoest"] . "</td>";
                    echo "<td>" . $fila["observacion"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No se encontraron docentes</td></tr>";
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