<?php

// Definimos las credenciales válidas
$credenciales_validas = array(
	"stefanycac" => "stefany12",
	"aleGon" => "stefany12"
);

// Obtenemos los datos enviados por el formulario
$nombre_usuario = $_POST["username"];
$contraseña = $_POST["password"];

// Validamos las credenciales
if (isset($credenciales_validas[$nombre_usuario]) && $credenciales_validas[$nombre_usuario] == $contraseña) {
	// Si son válidas, redireccionamos al usuario a la siguiente página
	header("Location: formulario.html");
	exit();
} else {
	// Si no son válidas, mostramos un mensaje de error
	echo "Nombre de usuario o contraseña incorrectos.";
}

?>
