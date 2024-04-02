<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "inscripcion");

// Comprobar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Verificar si se ha pasado el parámetro cedula
if (isset($_GET['cedula'])) {
    $cedula = $_GET['cedula'];

    // Consulta para obtener los datos del estudiante seleccionado
    $consulta = "SELECT * FROM inscripciones WHERE cedula = ?";
    $stmt = $conexion->prepare($consulta);
    $stmt->bind_param("s", $cedula);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $estudiante = $resultado->fetch_assoc();
    } else {
        echo "Estudiante no encontrado.";
        exit;
    }
} else {
    echo "Cedula de estudiante no proporcionada.";
    exit;
}

// Procesar los datos del formulario de edición
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cedula_actual = $estudiante['cedula']; // Cédula actual del estudiante
    $cedula_nueva = $_POST['cedula'];
    $nombre_estudiante = $_POST['nombre_estudiante'];
    $nombre_representante = $_POST['nombre_representante'];
    $edad = $_POST['edad'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $grado = $_POST['grado'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $sexo = isset($_POST['sexo']) ? $_POST['sexo'] : 'Varon';
    $direccion = $_POST['direccion'];
    $observacion = $_POST['observacion'];
    $acta = isset($_POST['acta']) ? $_POST['acta'] : 'No';
    $fotorep = isset($_POST['fotorep']) ? $_POST['fotorep'] : 'No';
    $fotoest = isset($_POST['fotoest']) ? $_POST['fotoest'] : 'No';
    $vacuna = isset($_POST['vacuna']) ? $_POST['vacuna'] : 'No';
    $certificado = isset($_POST['certificado']) ? $_POST['certificado'] : 'No';
    $cardio = isset($_POST['cardio']) ? $_POST['cardio'] : 'No';

    // Verificar si la cédula ha cambiado y si la nueva cédula no existe en la base de datos
    if ($cedula_actual != $cedula_nueva) {
        $verificar_cedula = "SELECT * FROM inscripciones WHERE cedula = ?";
        $stmt = $conexion->prepare($verificar_cedula);
        $stmt->bind_param("s", $cedula_nueva);
        $stmt->execute();
        $resultado_verificacion = $stmt->get_result();

        if ($resultado_verificacion->num_rows > 0) {
            echo "La nueva cédula ya existe en la base de datos.";
            exit;
        }
    }

    // Actualizar los datos del estudiante en la base de datos
    $actualizar = "UPDATE inscripciones SET cedula=?, nombre_estudiante=?, nombre_representante=?, edad=?, telefono=?, email=?, grado=?, fecha_nacimiento=?, sexo=?, direccion=?, observacion=? WHERE cedula=?";
    $stmt = $conexion->prepare($actualizar);
    $stmt->bind_param("sssissssssss", $cedula_nueva, $nombre_estudiante, $nombre_representante, $edad, $telefono, $email, $grado, $fecha_nacimiento, $sexo, $direccion, $observacion, $cedula_actual);

    if ($stmt->execute()) {
        echo "Los datos del estudiante han sido actualizados correctamente.";
        // Actualizar la cédula del estudiante en la variable $estudiante para reflejar los cambios
        $estudiante['cedula'] = $cedula_nueva;
    } else {
        echo "Error al actualizar los datos del estudiante: " . $conexion->error;
    }
}

$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Docente</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .title {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .form-column {
            flex-basis: calc(50% - 10px);
            margin-bottom: 20px;
        }

        .form-column input,
        .form-column select {
            width: 100%;
            margin-bottom: 10px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .form-column input[type="date"] {
            padding: 8px;
        }

        .form-column input[type="submit"] {
            width: 100%;
            margin-top: 20px;
            background-color: #00A3DC;
            color: white;
            border: none;
            border-radius: 20px;
            padding: 15px;
            cursor: pointer;
            font-size: 18px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .form-column input[type="submit"]:hover {
            background-color: #45a049;
        }

        /* Estilos para etiquetas */
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;

        }

    .boton-regresar {
        display: inline-block;
        background-color: #00A3DC;
        color: white;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
        border: none;
        border-radius: 5px;
    }
    </style>
</head>
<body>
    <div class="container">
                  <a href="siguiente.php" class="boton-regresar">Regresar</a>
                  <br>
        <h2 class="title">Editar Estudiante</h2>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?cedula=" . $estudiante['cedula']); ?>">
            <div class="form-container">
                <div class="form-column">
                    <label for="cedula">Cedula:</label>
                    <input type="text" id="cedula" name="cedula" value="<?php echo htmlspecialchars($estudiante['cedula']); ?>">
                    <label for="nombre_estudiante">Nombre:</label>
                    <input type="text" id="nombre_estudiante" name="nombre_estudiante" value="<?php echo htmlspecialchars($estudiante['nombre_estudiante']); ?>">
                    <label for="nombre_representante">Nombre del representante:</label>
                    <input type="text" id="nombre_representante" name="nombre_representante" value="<?php echo htmlspecialchars($estudiante['nombre_representante']); ?>">
                    <label for="edad">Edad:</label>
                    <input type="text" id="edad" name="edad" value="<?php echo htmlspecialchars($estudiante['edad']); ?>">
                    <label for="telefono">Telefono:</label>
                    <input type="text" id="telefono" name="telefono" value="<?php echo htmlspecialchars($estudiante['telefono']); ?>">
                    <label for="email">Email:</label>
                    <input type="text" id="email" name="email" value="<?php echo htmlspecialchars($estudiante['email']); ?>">
                    <label for="grado">Grado:</label>
                    <input type="text" id="grado" name="grado" value="<?php echo htmlspecialchars($estudiante['grado']); ?>">
                    <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                    <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="<?php echo htmlspecialchars($estudiante['fecha_nacimiento']); ?>">
                
                    <label for="sexo">Sexo:</label>
                    <input type="text" id="sexo" name="sexo" value="<?php echo htmlspecialchars($estudiante['sexo']); ?>">
                    </div>
                <div class="form-column">
                    <label for="direccion">Dirección:</label>
                    <input type="text" id="direccion" name="direccion" value="<?php echo htmlspecialchars($estudiante['direccion']); ?>">
                    <label for="observacion">Observación:</label>
                    <input type="text" id="observacion" name="observacion" value="<?php echo htmlspecialchars($estudiante['observacion']); ?>">
                    <label for="acta">Acta:</label>
                    <input type="text" id="acta" name="acta" value="<?php echo htmlspecialchars($estudiante['acta']); ?>">
                    <label for="fotorep">Fotorep:</label>
                    <input type="text" id="fotorep" name="fotorep" value="<?php echo htmlspecialchars($estudiante['fotorep']); ?>">
                    <label for="fotoest">Fotoest:</label>
                    <input type="text" id="fotoest" name="fotoest" value="<?php echo htmlspecialchars($estudiante['fotoest']); ?>">
                    <label for="vacuna">Vacuna:</label>
                    <input type="text" id="vacuna" name="vacuna" value="<?php echo htmlspecialchars($estudiante['vacuna']); ?>">
                    <label for="certificado">Certificado:</label>
                    <input type="text" id="certificado" name="certificado" value="<?php echo htmlspecialchars($estudiante['certificado']); ?>">
                    <label for="cardio">Cardiovascular:</label>
                    <input type="text" id="cardio" name="cardio" value="<?php echo htmlspecialchars($estudiante['cardio']); ?>">
                </div>
            </div>
            <input type="submit" value="Actualizar" style="background-color: #00A3DC; color: #FFF; border-color:#FFF; border-radius: 20px; width: 800px; height: 40px; font-size: 18px; ">
          

        </form>
    </div>
</body>
</html>

