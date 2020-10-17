<?php
include_once 'buscarUsuario.php';

$username = $_POST["usuario"];
$password = $_POST["contraseña"];

//declaro un objeto de la clase buscarUsuario
$userlogin          = new buscarUsuario();
$RegistroSupervisor = $userlogin->getSupervisor($username);
$RegistroRepartidor = $userlogin->getRepartidor($username);

$response          = array();
$response["exito"] = false;

function verificarContrasena($RegistroUsuario, $contrasena)
{

	$pass     = false;
	$password = $contrasena;

	if (password_verify($password, $RegistroUsuario[0]["Contrasena"])) {
    $pass = true;

	}

	return $pass;
}

//verifica que la contraseña y usuario contengan un valor
if ($password != null && $username != null) {

	// La condición es verdadera únicamente si el usuario es Supervisor
	if ($RegistroSupervisor != null) {
		//
		$login = verificarContrasena($RegistroSupervisor, $password);
		$usr   = "sup";
	} elseif ($RegistroRepartidor != null) {
		$login = verificarContrasena($RegistroRepartidor, $password);
		$usr   = "rep";

	} else {
		// code...
		$login           = false;
		$response["msj"] = "Usuario o Contraseña incorrecta";

	}
} else {
	// code...
	$login           = false;
	$response["msj"] = "Contraseña o Usuario nulo";

}

/*
if ($password!= NULL && $username!= NULL)
{
if ($password == $RegistroSupervisor[0]["Contrasena"])
{
$response["exito"] = true;
$response["id"] = $RegistroSupervisor[0]["Persona_IdSupervisor"];
$response["dni"] = $RegistroSupervisor[0]["Persona_DNISupervisor"];
}
elseif ($password  == $RegistroRepartidor[0]["Contrasena"])
{
$response["exito"] = true;
$response["id"] = $RegistroRepartidor[0]["Persona_IdRepartidor"];
$response["dni"] = $RegistroRepartidor[0]["Persona_DNIRepartidor"];
}
else
{
$response["exito"] = false;
$response["id"] = $RegistroRepartidor[0]["Persona_IdRepartidor"];
$response["dni"] = $RegistroRepartidor[0]["Persona_DNIRepartidor"];
$response["usr"] = $RegistroRepartidor[0]["Usuario"];
$response["pass"] = $RegistroRepartidor[0]["Contraseña"];
}

}
else
{
$response["exito"] = false;
}
 */
if ($login) {
	// code...
	$response["exito"] = true;
	if ($usr == "sup") {
		// code...
		$response["id"]  = $RegistroSupervisor[0][
						      "Persona_IdSupervisor"];
		$response["dni"] = $RegistroSupervisor[0][
						      "Persona_DNISupervisor"];
		$response["msj"] = "supervisor";
	} else {
		// code...
		$response["id"]  = $RegistroRepartidor[0][
						      "Persona_IdRepartidor"];
		$response["dni"] = $RegistroRepartidor[0][
						      "Persona_DNIRepartidor"];
		$response["msj"] = "repartidor";
	}
} else {
	// code...
	$response["exito"] = false;
	$response["msj"]   = "Usuario o contraseña incorrecta";
	//$response["repartidor"]= $RegistroRepartidor;
}

echo json_encode($response);
