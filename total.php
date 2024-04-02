<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estadísticas de Estudiantes</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div style="width:75%;">
        <canvas id="myChart"></canvas>
    </div>

    <?php
    // Conexión a la base de datos
    $conn = mysqli_connect("localhost", "root", "", "inscripcion");

    // Verificar la conexión
    if (!$conn) {
        die("Conexión fallida: " . mysqli_connect_error());
    }

    // Consulta SQL para obtener el recuento total de estudiantes por grado y sexo
    $sql = "SELECT grado, sexo, COUNT(*) as total FROM inscripciones GROUP BY grado, sexo";
    $result = mysqli_query($conn, $sql);

    // Preparar los datos para la gráfica
    $data = array();
    $labels = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $grado = $row['grado'];
        $sexo = $row['sexo'];
        $total = $row['total'];

        if (!isset($data[$grado])) {
            $data[$grado] = array();
        }
        if (!isset($data[$grado][$sexo])) {
            $data[$grado][$sexo] = 0;
        }
        $data[$grado][$sexo] += $total;

        if (!in_array($grado, $labels)) {
            $labels[] = $grado;
        }
    }

    // Cerrar la conexión
    mysqli_close($conn);
    ?>

    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($labels); ?>,
                datasets: [
                    <?php
                    $colors = array("blue", "red", "green", "yellow", "orange", "purple");
                    $sexes = array("Masculino", "Femenino"); // Agregar más opciones si es necesario
                    foreach ($sexes as $index => $sex) {
                        echo "{";
                        echo "label: '$sex',";
                        echo "backgroundColor: '" . $colors[$index] . "',";
                        echo "data: [";
                        foreach ($labels as $label) {
                            if (isset($data[$label][$sex])) {
                                echo $data[$label][$sex] . ",";
                            } else {
                                echo "0,";
                            }
                        }
                        echo "],";
                        echo "},";
                    }
                    ?>
                ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
</body>
</html>
