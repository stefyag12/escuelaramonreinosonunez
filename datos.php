<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados de la Búsqueda</title>
    <!-- Agrega la biblioteca Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
               background-size: cover;
            background-image: url(https://i.ibb.co/J2Xg7kL/Colorido-Ilustraci-n-Proyecto-de-Grupo-En-Blanco-Presentaci-n-de-Educaci-n-1.jpg);
            background-repeat: no-repeat;
            background-size: cover;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;

        }

        .grafica-container {
            width: 45%;
            display: inline-block;
            margin-right: 10px;
            vertical-align: top;
        }
    </style>
</head>
<body>
    <br><br><br><br><br><br><br><br><br><br>
    <h2 align="center" style="color:black; font: 28px;">Estadisticas de estudiantes Inscritos</h2><br><br><br>

    <?php
    // Verificar si se enviaron las fechas desde el formulario
    if (isset($_POST['fecha_desde']) && isset($_POST['fecha_hasta'])) {
        // Conectar a la base de datos
        $conexion = new mysqli("localhost", "root", "", "inscripcion");

        // Verificar la conexión
        if ($conexion->connect_error) {
            die("Error al conectar con la base de datos: " . $conexion->connect_error);
        }

        // Obtener las fechas del formulario
        $fecha_desde = $_POST['fecha_desde'];
        $fecha_hasta = $_POST['fecha_hasta'];

        // Consulta SQL
        $consulta = "SELECT sexo, grado FROM inscripciones WHERE fecha BETWEEN '$fecha_desde' AND '$fecha_hasta'";

        // Ejecutar la consulta
        $resultado = $conexion->query($consulta);

        // Inicializar arrays para contar la cantidad de estudiantes por grado y sexo
        $estudiantes_por_grado = array();
        $estudiantes_por_sexo = array("Masculino" => 0, "Femenino" => 0);

        // Contar la cantidad de estudiantes por grado y sexo
        while ($fila = $resultado->fetch_assoc()) {
            // Contar por grado
            $grado = $fila['grado'];
            if (!isset($estudiantes_por_grado[$grado])) {
                $estudiantes_por_grado[$grado] = 0;
            }
            $estudiantes_por_grado[$grado]++;

            // Contar por sexo (manejar "varón" correctamente)
            $sexo = ($fila['sexo'] == "Hembra") ? "Femenino" : (($fila['sexo'] == "Varon") ? "Masculino" : $fila['sexo']);
            if (!isset($estudiantes_por_sexo[$sexo])) {
                $estudiantes_por_sexo[$sexo] = 0;
            }
            $estudiantes_por_sexo[$sexo]++;
        }

        // Cerrar la conexión
        $conexion->close();

        // Crear la estructura de datos para la gráfica
        $labels = array_keys($estudiantes_por_grado);
        $data = array_values($estudiantes_por_grado);
        $sexo_labels = array("Masculino", "Femenino");
        $sexo_data = array_values($estudiantes_por_sexo);
    ?>
        <!-- Mostrar la gráfica de estudiantes por grado -->
        <div class="grafica-container">
            <h3>Total de estudiantes inscritos</h3>
            <canvas id="grafica-grado" width="400" height="400"></canvas> <!-- Misma dimensión para ambas gráficas -->
        </div>

        <!-- Mostrar la gráfica de estudiantes por sexo -->
        <div class="grafica-container">
            <h3>División de estudiantes por género</h3>
            <canvas id="grafica-sexo" width="400" height="400"></canvas> <!-- Misma dimensión para ambas gráficas -->
        </div>

        <script>
            // Configuración de la gráfica de estudiantes por grado
            var ctxGrado = document.getElementById('grafica-grado').getContext('2d');
            var graficaGrado = new Chart(ctxGrado, {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode($labels); ?>,
                    datasets: [{
                        label: 'Estudiantes',
                        data: <?php echo json_encode($data); ?>,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Configuración de la gráfica de estudiantes por sexo
            var ctxSexo = document.getElementById('grafica-sexo').getContext('2d');
            var graficaSexo = new Chart(ctxSexo, {
                type: 'doughnut',
                data: {
                    labels: <?php echo json_encode($sexo_labels); ?>,
                    datasets: [{
                        label: 'Genero del estudiante',
                        data: <?php echo json_encode($sexo_data); ?>,
                        backgroundColor: [
                            'rgba(54, 162, 235, 0.2)', // Azul
                            'rgba(255, 99, 132, 0.2)' // Rosa
                        ],
                        borderColor: [
                            'rgba(54, 162, 235, 1)', // Azul
                            'rgba(255, 99, 132, 1)' // Rosa
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    <?php
    } else {
        // Si no se enviaron las fechas, mostrar un mensaje de error
        echo "<p>Error: Debes ingresar las fechas en el formulario.</p>";
    }
    ?>
</body>
</html>
