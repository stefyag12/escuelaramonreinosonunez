<?php
session_start(); // Iniciar sesión si aún no se ha iniciado

// Datos de conexión a la base de datos
$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "inscripcion";

// Crear conexión
$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$mensaje = ''; // Variable para almacenar mensajes de error

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $repeatpassword = $_POST["repeatpassword"];
    $user_type = isset($_POST["user_type"]) ? $_POST["user_type"] : '';

    $errors = [];

    if (empty($username)) {
        $errors[] = "Nombre completo es obligatorio.";
    }

    if (empty($password)) {
        $errors[] = "Contraseña es obligatoria.";
    } elseif (strlen($password) < 6) {
        $errors[] = "La contraseña debe tener al menos 6 caracteres.";
    } elseif ($password != $repeatpassword) {
        $errors[] = "Las contraseñas no coinciden.";
    }

    if (empty($user_type)) {
        $errors[] = "El tipo de usuario es obligatorio.";
    }

    if (count($errors) == 0) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO registro (username, password, user_type) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $hashed_password, $user_type);
        $result = $stmt->execute();

        if ($result) {
            $mensaje = "Usuario registrado exitosamente.";
        } else {
            $mensaje = "Error al registrar el usuario. Por favor, inténtalo de nuevo.";
        }

        $stmt->close();
    } else {
        $mensaje = implode("<br>", $errors); // Concatenar mensajes de error
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volver a Intentar</title>
    <style>
        body {
            background-image: url(img-2.png);
            background-size: cover;
            background-attachment: fixed;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 300px;
            text-align: center;
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .mensaje-error {
            background-color: #ffcdd2;
            color: #d32f2f;
            padding: 10px;
            margin-top: 10px;
            border-radius: 4px;
        }

        .mensaje-exito {
            background-color: #d0e9c6;
            color: #4caf50;
            padding: 10px;
            margin-top: 10px;
            border-radius: 4px;
        }

        h1 {
            color: #333;
        }

        label {
            font-size: 18px;
            margin-right: 10px;
        }

        input[type="submit"] {
            background-color: #1a2537;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #1a2537;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Volver a Intentar</h1>
       <?php if (!empty($mensaje)) : ?>
    <?php if (strpos($mensaje, 'exitosamente') !== false) : ?>
        <div class="mensaje-exito"><?php echo $mensaje; ?></div>
        <script>
            setTimeout(function () {
                window.location.href = 'menu2.html';
            }, 3000);
        </script>
    <?php else: ?>
        <div class="mensaje-error"><?php echo $mensaje; ?></div>
        <form action="registrarvista.html">
            <input type="submit" value="Regresar">
        </form>
    <?php endif; ?>
<?php endif; ?>

        <br>
    </div>
</body>
</html>
