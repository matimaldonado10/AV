<?php
include_once('buscarUsuario.php');

$username = 'samuel';
$password = 'samu1234';

echo $username;
echo "<br>";
//declaro un objeto de la clase buscarUsuario
$userlogin = new buscarUsuario();
$RegistroSupervisor = $userlogin->getSupervisor($username);
$RegistroRepartidor = $userlogin->getRepartidor($username);

echo "trajo el registro Supervisor";
echo "<br>";
print_r($RegistroSupervisor);
echo "<br>";

echo "trajo el registro Repartidor";
echo "<br>";
print_r($RegistroRepartidor);
echo "<br>";
//$response = array();
$response = false;

/*
    if ($password == $RegistroUsuario[0]["Contrasena"]) {
        $response = true;
        //echo "$RegistroUsuario[0]["Persona_IdSupervisor"]";
        print_r($RegistroUsuario);

        echo "laputaquetepario";
}else {
  echo "nopasóuncarajo";
}

*/

  function verificarContrasena($RegistroUsuario, $contrasena)
  {

      $pass = FALSE;
      $password = $contrasena;
      echo "<br>";
      print_r($password);
      echo "<br>";

      if ($password == $RegistroUsuario[0]["Contrasena"])
      {
        $pass = true;

      }

      return $pass;
  }





  //verifica que la contraseña y usuario contengan un valor
  if ($password!= NULL && $username!= NULL) {

    // La condición es verdadera si el usuario es Supervisor
    if ($RegistroSupervisor!=NULL)
     {
      //
      $login= verificarContrasena($RegistroSupervisor, $password);
      $usr="spvr";
      echo "Es un supervisor";
      echo "<br>";
    }
    elseif ($RegistroRepartidor!=NULL)
    {
      $login= verificarContrasena($RegistroRepartidor, $password);
      echo "Es un repartidor";
      echo "<br>";
      print_r($RegistroRepartidor);
      $usr="rep";

    }
      else
      {
        // code...
        echo "Usuario o contraseña incorrecta";
        echo "<br>";
      }
  }
  else
  {
    // code...
    echo "contraseña o usuario nulo";
    echo "<br>";
  }
