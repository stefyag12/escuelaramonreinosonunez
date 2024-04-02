<!DOCTYPE html>
<html>
<head>
    <title>Data Estudiantil</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script> setTimeout(function () { window.location.href = 'siguiente.php'; }, 1000); </script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Ajustar el zoom al 67%
        document.body.style.zoom = "67%";
    });
</script>
<style>
        body {
            font-family: Arial, sans-serif;

        }

        .container {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            margin-bottom: 20px auto;
             max-width: 1200px; /* Establece un ancho máximo para el contenedor */
    margin: 0 auto; /* Centra el contenedor horizontalmente */
    padding: 0 20px; /* Añade un poco de espacio en los lados */
        }

        form {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        label {
            margin-right: 10px;
        }

        input[type="text"], select {
            margin-right: 10px;
        }

        table {
    width: 100%; /* Haz que la tabla ocupe todo el ancho del contenedor */
    overflow-x: auto; /* Permitir desplazamiento horizontal si es necesario */
    border-collapse: collapse;

  }
    table, th, td {
    border: 1px solid black;
    padding: 8px;
}
    </style>

</head>
<body>
    <h1>Data Estudiantil</h1>
    <br>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="busqueda">Buscar por cédula o nombre:</label>
    <input type="text" name="busqueda" id="busqueda">
    <input type="submit" value="Buscar">
</form>
    <br>
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
    <br>
<!-- Botón para eliminar datos --> <form action="eliminar.php" method="post"> <label for="id">Eliminar por c&eacutedula:</label> <input type="number" name="id" id="id"> <input type="submit" value="Eliminar"> </form>

    <form action="imprimir.php" method="post">
    <input type="submit" value="Imprimir" onclick="imprimirYPausar()">
</form>
<div class="regresar-container">
      <label for="regresar"> Redirigir al menú principal</label>
    <input type="submit" name="regresar" value="Regresar"  onclick="location.href='menu2.html';">
</div>
 <br>

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "inscripcion";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $user_type = isset($_POST["user_type"]) ? $_POST["user_type"] : '';

    // Función para imprimir los datos en una tabla HTML
    function imprimir_datos($result) {
        echo "<table>";
        echo "<tr><th>C&eacute;dula</th><th>Nombre Estudiante</th><th>Nombre Representante</th><th>Tel&eacute;fono</th><th>Email</th><th>Grado</th><th>Fecha Nacimiento</th><th>Edad</th><th>Sexo</th><th>Direcci&oacute;n</th><th>Acta de Nacimiento</th><th>Copia de c&eacute;dula del representante</th><th>Cardiovascular</th><th>Carton de Vacunación</th><th>Certificado del &uacute;ltimo grado aprobado</th><th>Foto del estudiante</th><th>Observaci&oacute;n</th></tr>";
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row["cedula"] . "</td>";
            echo "<td>" . $row["nombre_estudiante"] . "</td>";
            echo "<td>" . $row["nombre_representante"] . "</td>";
            echo "<td>" . $row["telefono"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["grado"] . "</td>";
            echo "<td>" . $row["fecha_nacimiento"] . "</td>";
            echo "<td>" . $row["edad"] . "</td>";
            echo "<td>" . $row["sexo"] . "</td>";
            echo "<td>" . $row["direccion"] . "</td>";
            echo "<td>" . $row["acta"] . "</td>";
            echo "<td>" . $row["fotorep"] . "</td>";
            echo "<td>" . $row["cardio"] . "</td>";
            echo "<td>" . $row["vacuna"] . "</td>";
            echo "<td>" . $row["certificado"] . "</td>";
            echo "<td>" . $row["fotoest"] . "</td>";
            echo "<td>" . $row["observacion"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    $sql = "SELECT * FROM inscripciones";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Procesar la entrada del usuario
    $busqueda = isset($_POST["busqueda"]) ? $_POST["busqueda"] : '';
    $grado = isset($_POST["grado"]) ? $_POST["grado"] : '';

    if (!empty($busqueda)) {
        $sql = "SELECT * FROM inscripciones WHERE cedula LIKE '%" . $busqueda . "%' OR nombre_estudiante LIKE '%" . $busqueda . "%'";
} elseif (!empty($grado)) {
$sql = "SELECT * FROM inscripciones WHERE grado = '$grado'";
}
}

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
// Si hay datos, imprimirlos en una tabla
imprimir_datos($result);
} else {
echo "0 resultados";
}


mysqli_close($conn);
?>
 <br> <br>
<p>
    <br> <br>

<script> setTimeout(function () { window.location.href = 'siguiente.php'; }, 1000); </script>
</body>
</html>
