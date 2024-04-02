<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscador de Estudiantes por Fecha de Inscripción</title>
    <style>
        body {
            background-image: url(https://i.ibb.co/hKtwSRf/Colorido-Ilustraci-n-Proyecto-de-Grupo-En-Blanco-Presentaci-n-de-Educaci-n-1.jpg);
            background-repeat: no-repeat;
            background-size: cover;
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;

        }
        h2 {
            color: #333;
        }
        form {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 7px 50px rgba(4, 113, 132, 1);
            padding: 20px;
            width: 300px;
            margin: 0 auto;

        }
        label {
            display: block;
            margin-bottom: 10px;
            color: #666;
        }
        input[type="date"],
        button {
            padding: 8px;
            width: 100%;
            box-sizing: border-box;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }
        button {
            background-color: #047184;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #047184;
        }
    </style>
</head>
<body>
    <br><br><br><br><br><br><br><br><br><br>
    <h2 align="center">INGRESA UN RANGO DE FECHA DE INSCRIPCION</h2>
    <br><br>
<p align="center">Aqui podrás encontrar la estadistica por fecha de los estudiantes inscrito en la institución desde 2022</p>
<br><br>
    <form action="datos.php" method="POST">
        <label for="fecha_desde">Buscar desde:</label>
        <input type="date" id="fecha_desde" name="fecha_desde" required>
        <br><br>
        <label for="fecha_hasta">Hasta:</label>
        <input type="date" id="fecha_hasta" name="fecha_hasta" required>
        <br><br>
        <button type="submit">Buscar</button>
        <button onclick="window.location.href='total.php';" type="button">Ver totales</button>
        <button onclick="window.location.href='menu2.html';" type="button">Regresar</button>
    </form>
</body>
</html>
