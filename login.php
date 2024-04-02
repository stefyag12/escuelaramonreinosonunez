<?php
session_start();

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

$mensaje = $mensaje2 = ""; // Inicializar mensajes vacíos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT username, password, user_type FROM registro WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_username, $hashed_password, $user_type);
        $stmt->fetch();

        if($password == $hashed_password) {
            $_SESSION["username"] = $user_username;
            $_SESSION["user_type"] = $user_type;

            if ($user_type == "admin") {
                header("Location: menu2.html");
                exit;
            } else {
                header("Location: menu1.html");
                exit;
            }
        } else {
            $mensaje2 = "La contraseña es incorrecta";
        }
    } else {
        $mensaje = "El nombre de usuario no existe";
    }

    $stmt->close();
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
             background-image: url(https://i.ibb.co/7Smjmpk/Colorido-Ilustraci-n-Proyecto-de-Grupo-En-Blanco-Presentaci-n-de-Educaci-n-2.jpg);
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
            <div class="mensaje-error"><?php echo $mensaje; ?></div>
        <?php endif; ?>
        <?php if (!empty($mensaje2)) : ?>
            <div class="mensaje-error"><?php echo $mensaje2; ?></div>
        <?php endif; ?>
        <br>
        <label for="regresar"> Regresar a la página de inicio de sesión</label>
        <br>

        <br>
        <input type="submit" name="regresar" value="Regresar" onclick="location.href='loginvista.html';">
    </div>
</body>
</html>
