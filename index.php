<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        h2 {
            text-align: center;
            margin-top: 20px;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 10px;
            border-bottom: 1px solid #dddddd;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        .regresar {
            text-decoration: none;
            color: blue;
            display: inline-block;
            padding: 10px 20px;
            background-color: #f2f2f2;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 10px; /* Ajuste para separar del formulario */
            margin-left: 1500px; /* Mueve el enlace al lado izquierdo */
        }

        .regresar:hover {
            background-color: #ddd;
        }

        form > label {
            margin-right: 10px;
        }
    </style>
    <title>Editar Estudiantes</title>
</head>
<body>

<h2>Lista de Estudiantes</h2>

<!-- Botón de regresar -->
<a href="menu3.html" class="regresar">Regresar al menú</a>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="grado">Buscar por grado:</label>
    <select id="grado" name="grado">
        <option value="">Todos los grados</option>
        <option value="1ero">1ero</option>
        <option value="2do">2do</option>
        <option value="3ero">3ero</option>
        <option value="4to">4to</option>
        <option value="5to">5to</option>
        <option value="6to">6to</option>
    </select>

    <label for="cedulaBuscar">Cédula:</label>
    <input type="text" id="cedulaBuscar" name="cedulaBuscar" placeholder="Cédula">

    <label for="nombreBuscar">Nombre:</label>
    <input type="text" id="nombreBuscar" name="nombreBuscar" placeholder="Nombre">

    <input type="submit" value="Buscar">
</form>

<table border="1">
    <tr>
        <th>Cedula</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Edad</th>
        <th>telefono</th>
        <th>email</th>
        <th>grado</th>
        <th>fecha_nacimiento</th>
        <th>sexo</th>
        <th>direccion</th>
        <th>acta</th>
        <th>fotorep</th>
        <th>cardio</th>
        <th>vacuna</th>
        <th>certificado</th>
        <th>fotoest</th>
        <th>observacion</th>
        <th>Acción</th>
    </tr>
    <?php
    $conexion = new mysqli("localhost", "root", "", "inscripcion");
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    $whereClauses = [];
    if (!empty($_POST['grado'])) {
        $grado = $conexion->real_escape_string($_POST['grado']);
        $whereClauses[] = "grado = '$grado'";
    }
    if (!empty($_POST['cedulaBuscar'])) {
        $cedulaBuscar = $conexion->real_escape_string($_POST['cedulaBuscar']);
        $whereClauses[] = "cedula LIKE '%$cedulaBuscar%'";
    }
    if (!empty($_POST['nombreBuscar'])) {
        $nombreBuscar = $conexion->real_escape_string($_POST['nombreBuscar']);
        $whereClauses[] = "nombre_estudiante LIKE '%$nombreBuscar%'";
    }

    $sql = "SELECT * FROM inscripciones";
    if (!empty($whereClauses)) {
        $sql .= " WHERE " . join(' OR ', $whereClauses);
    }

    $result = $conexion->query($sql);

    if ($result->num_rows > 0) {
        while ($fila = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($fila['cedula']) . "</td>";
            echo "<td>" . htmlspecialchars($fila['nombre_estudiante']) . "</td>";
            echo "<td>" . htmlspecialchars($fila['nombre_representante']) . "</td>";
            echo "<td>" . htmlspecialchars($fila['edad']) . "</td>";
            echo "<td>" . htmlspecialchars($fila["telefono"]) . "</td>";
            echo "<td>" . htmlspecialchars($fila["email"]) . "</td>";
            echo "<td>" . htmlspecialchars($fila["grado"]) . "</td>";
            echo "<td>" . htmlspecialchars($fila["fecha_nacimiento"]) . "</td>";
            echo "<td>" . htmlspecialchars($fila["sexo"]) . "</td>";
            echo "<td>" . htmlspecialchars($fila["direccion"]) . "</td>";
            echo "<td>" . htmlspecialchars($fila["acta"]) . "</td>";
            echo "<td>" . htmlspecialchars($fila["fotorep"]) . "</td>";
            echo "<td>" . htmlspecialchars($fila["cardio"]) . "</td>";
            echo "<td>" . htmlspecialchars($fila["vacuna"]) . "</td>";
            echo "<td>" . htmlspecialchars($fila["certificado"]) . "</td>";
            echo "<td>" . htmlspecialchars($fila["fotoest"]) . "</td>";
            echo "<td>" . htmlspecialchars($fila["observacion"]) . "</td>";
            echo "<td><a href='editar_estudiante.php?cedula=" . htmlspecialchars($fila['cedula']) . "'>Editar</a></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='18'>No se encontraron estudiantes</td></tr>";
    }

    $conexion->close();
    ?>
</table>

</body>
</html>
