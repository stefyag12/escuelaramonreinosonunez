<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado de la inscripción</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
        }
        h1 {
            color: #333;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        ul li {
            color: red;
            margin-bottom: 5px;
        }


        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
            margin-top: 20px;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>


    <div class="container">
        <?php
        // Tu script PHP irá aquí

        // Datos de conexión a la base de datos
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "inscripcion";

        // Crear conexión
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificar conexión
        if ($conn->connect_error) {
            die("Falló la conexión: " . $conn->connect_error);
        }

        // Validar formulario
        $errors = array();

        if (empty($_POST['cedula'])) {
            $errors[] = "Cédula es requerida";
        }

        if (empty($_POST['nombre_docente'])) {
            $errors[] = "Nombre del docente es requerido";
        }

        // Si hay errores, mostrarlos
        if (!empty($errors)) {
            echo "<h1>Errores encontrados:</h1>";
            echo "<ul>";
            foreach ($errors as $error) {
                echo "<li>$error</li>";
            }
            echo "</ul>";
            echo '<a href="inscribirdocente.html"><button>Volver a formulario de inscripción<br></button></a><br>';
            echo '<a href="menu2.html"><button>Volver a menú<br></button></a><br>';
        } else {
            // No hay errores, procede con la inserción de datos

            // Verificar si la cédula ya existe
            $cedula = $_POST['cedula'];
            $check_query = "SELECT * FROM registrodocente WHERE cedula = '$cedula'";
            $check_result = $conn->query($check_query);

            if ($check_result->num_rows > 0) {
                echo "<p style= color: red;>Datos repetidos, cédula estudiantil ya existente<br></p>";
                echo '<a href="inscribirdocente.html"><button>Volver a formulario de inscripción</button></a>';
            } else {
                // Datos a insertar
                $cedula = $_POST['cedula'];
                $nombre_docente = $_POST['nombre_docente'];
                $fecha_ingreso = $_POST['fecha_ingreso'];
                $telefono = $_POST['telefono'];
                $email = $_POST['email'];
                $grado = $_POST['grado'];
                $fecha_nacimiento = $_POST['fecha_nacimiento'];
                $sexo = isset($_POST['sexo']) ? $_POST['sexo'] : 'Varon';
                $direccion = $_POST['direccion'];
                $edad = $_POST['edad'];
                $observacion = $_POST['observacion'];
                $acta = isset($_POST['acta']) ? $_POST['acta'] : 'No';
                $fotorep = isset($_POST['fotorep']) ? $_POST['fotorep'] : 'No';
                $fotoest = isset($_POST['fotoest']) ? $_POST['fotoest'] : 'No';
                $vacuna = isset($_POST['vacuna']) ? $_POST['vacuna'] : 'No';
                $certificado = isset($_POST['certificado']) ? $_POST['certificado'] : 'No';

                // Consulta SQL para insertar datos
                $sql = "INSERT INTO registrodocente (cedula, nombre_docente, fecha_ingreso, telefono, email, grado, fecha_nacimiento, sexo, direccion, acta, fotorep, fotoest, vacuna, certificado, observacion, edad) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssssssssssssssss", $cedula, $nombre_docente, $fecha_ingreso, $telefono, $email, $grado, $fecha_nacimiento, $sexo, $direccion, $acta, $fotorep, $fotoest, $vacuna, $certificado, $observacion, $edad);

                if ($stmt->execute() === TRUE) {
                    echo "Datos insertados correctamente<br>";
                    echo '<a href="menu2.html"><button>Volver a menú principal</button></a>';
                } else {
                    echo "Error al insertar datos: " . $conn->error;
                    echo '<a href="inscribirdocente.html"><button>Volver a registrar</button></a>';
                }

                // Cerrar conexión
                $stmt->close();
            }

        }

        // Cerrar conexión
        $conn->close();
        ?>
    </div>
</body>
</html>
