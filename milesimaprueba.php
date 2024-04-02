<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$database = "inscripcion";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$grado = isset($_GET['grado']) ? $_GET['grado'] : "";

// Consulta SQL para obtener los datos con la búsqueda
$sql = "SELECT e.cedula, e.nombre_estudiante, e.grado, n.nota
        FROM inscripciones e
        JOIN notas n ON e.cedula = n.cedula
        WHERE (e.grado = '$grado' OR '$grado' = '')";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notas de Estudiantes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        h2 {
            text-align: center;
            margin-top: 20px;
        }
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        form {
            text-align: center;
            margin-bottom: 20px;
        }
        label, select, button {
            margin-right: 10px;
        }
        button {
            padding: 8px 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<h2>Notas de Estudiantes</h2>

<!-- Formulario de búsqueda -->
<form method="get" action="">
    <label for="grado">Grado:</label>
    <select name="grado" id="grado">
        <option value="">Seleccione un grado</option>
        <option value="1ero" <?php echo ($grado == '1ero') ? 'selected' : ''; ?>>1ero</option>
        <option value="2do" <?php echo ($grado == '2do') ? 'selected' : ''; ?>>2do</option>
        <option value="3ero" <?php echo ($grado == '3ero') ? 'selected' : ''; ?>>3ero</option>
        <option value="4to" <?php echo ($grado == '4to') ? 'selected' : ''; ?>>4to</option>
        <option value="5to" <?php echo ($grado == '5to') ? 'selected' : ''; ?>>5to</option>
        <option value="6to" <?php echo ($grado == '6to') ? 'selected' : ''; ?>>6to</option>
    </select>
    <button type="submit">Buscar</button>
</form>

<table>
    <tr>
        <th>Cédula</th>
        <th>Nombre del Estudiante</th>
        <th>Grado</th>
        <th>Nota</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["cedula"] . "</td>";
            echo "<td>" . $row["nombre_estudiante"] . "</td>";
            echo "<td>" . $row["grado"] . "</td>";
            echo "<td>" . $row["nota"] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No se encontraron resultados</td></tr>";
    }
    ?>
</table>

<a href="menu3.html" style="display: block; width: 150px; margin: 20px auto; padding: 10px; text-align: center; background-color: #007bff; color: white; text-decoration: none; border-radius: 4px;">Ir al Menú</a>

</body>
</html>

<?php
// Cerrar conexión
$conn->close();
?>
