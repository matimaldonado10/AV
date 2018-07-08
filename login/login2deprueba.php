<?php
include_once('buscarUsuario.php');
include_once('tablas.php');


$username = $_POST["usuario"];
$password = $_POST["contraseña"];
$primerLogin= $_POST["intento"];

//declaro un objeto de la clase buscarUsuario
$userlogin = new buscarUsuario();
$tablas = new tablas();

$RegistroSupervisor = $userlogin->getSupervisor($username);
$RegistroRepartidor = $userlogin->getRepartidor($username);

$response = new stdClass();
$data = new stdClass();
$response->exito = false;


function verificarContrasena($RegistroUsuario, $contrasena)
{

    $pass = FALSE;
    $password = $contrasena;

    if (password_verify($password, $RegistroUsuario[0]["Contrasena"]))
    {
      $pass = true;

    }

    return $pass;
}

//verifica que la contraseña y usuario contengan un valor
if ($password!= NULL && $username!= NULL) {

  // La condición es verdadera únicamente si el usuario es Supervisor
  if ($RegistroSupervisor!=NULL)
   {
    //
    $login= verificarContrasena($RegistroSupervisor, $password);
    $usr= "sup";
  }
  elseif ($RegistroRepartidor!=NULL)
  {
    $login= verificarContrasena($RegistroRepartidor, $password);
    $usr="rep";

  }
    else
    {
      // code...
      $login=false;
      $response->msj = "Usuario o Contraseña incorrecta";

    }
}
else
{
  // code...
  $login=false;
  $response->msj= "Contraseña o Usuario nulo";

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
if ($login)
{
  // code...
  $response->exito = true;
      if ($usr == "sup")
      {
        // code...
        //$response->id = $RegistroSupervisor[0]["Persona_IdSupervisor"];
        //$response->dni = $RegistroSupervisor[0]["Persona_DNISupervisor"];
        $response->msj = "supervisor";
        $response->nuevo = $RegistroSupervisor;
      }
      else
      {
        // code...
        $data->id = $RegistroRepartidor[0]["Persona_IdRepartidor"];
        $dni= $RegistroRepartidor[0]["Persona_DNIRepartidor"];
        $data->dni = $dni;
        $data->msj = "repartidor";
        //$data->usuario = $RegistroRepartidor;

        if (strcmp($primerLogin, "true") == 0) //IGUAL A CERO SIGNIFICA QUE $primerLogin es igual a true, por lo tanto, el usuario se loguea por primera vez
        {

          /*
              Se obtienen todos los clientes del repartidor
          */
        //  $RegistroClientesRepartidor = $tablas->obtenerClientesDeRepartidor($dni);

            $RegistroClientes = $tablas->obtenerClientesDeRepartidor($dni);
/*
            echo "<br>";
            print_r($RegistroCortoDeClientes);
            echo "<br>";
*/          $Dias = array();
            for ($i=0; $i <count($RegistroClientes) ; $i++) {
              // code...
              if ($i=0)
              {
                $dniDistinto = $RegistroClientes[$i]["DNI"];
                $indice = $i;
              }

              if ($dniDistinto=$RegistroClientes[$i]["DNI"]) {
                array_push ($Dias, $RegistroClientes[$i]["Dia"])

              }
              else
              {

                $RegistroClientesRepartidor[$indice]["IdPersona"] = $RegistroClientesRepartidor[$indice]["IdPersona"];
                $RegistroClientesRepartidor[$indice]["DNI"] = $RegistroClientesRepartidor[$indice]["DNI"];
                $RegistroClientesRepartidor[$indice]["Apellido"] = $RegistroClientesRepartidor[$indice]["Apellido"];
                $RegistroClientesRepartidor[$indice]["Nombre"] = $RegistroClientesRepartidor[$indice]["Nombre"];
                $RegistroClientesRepartidor[$indice]["Telefono"] = $RegistroClientesRepartidor[$indice]["Telefono"];
                $RegistroClientesRepartidor[$indice]["Email"] = $RegistroClientesRepartidor[$indice]["Email"];
                $RegistroClientesRepartidor[$indice]["Direccion"] = $RegistroClientesRepartidor[$indice]["Direccion"];
                $RegistroClientesRepartidor[$indice]["Referencia"] = $RegistroClientesRepartidor[$indice]["Referencia"];
                $RegistroClientesRepartidor[$indice]["Barrio"] = $RegistroClientesRepartidor[$indice]["Barrio"];
                $RegistroClientesRepartidor[$indice]["Dia"] = $Dias;


                $dniDistinto = $RegistroClientes[$i]["DNI"];
                unset($Dias);
                array_push ($Dias, $RegistroClientes[$i]["Dia"])
                $indice = $i;

              }


            }


//count($RegistroClientesRepartidor)-1
          for ($i=0; $i<count($RegistroClientesRepartidor); $i++)
          {

            $RegistroDeDias=$tablas->obtenerDiasDeReparto($RegistroClientesRepartidor[$i]["ClientesDirectos_Persona_DNICliente"]);
            $RegistroClientesRepartidor[$i]["Dia"] = $RegistroDeDias;

            $RegistroClientesRepartidor[$i]["IdPersona"] = utf8_encode($RegistroClientesRepartidor[$i]["ClientesDirectos_Persona_IdCliente"]);
            $RegistroClientesRepartidor[$i]["DNI"] = utf8_encode($RegistroClientesRepartidor[$i]["ClientesDirectos_Persona_DNICliente"]);
            $RegistroClientesRepartidor[$i]["Apellido"] = utf8_encode($RegistroClientesRepartidor[$i]["Apellido"]);
            $RegistroClientesRepartidor[$i]["Nombre"] = utf8_encode($RegistroClientesRepartidor[$i]["Nombre"]);
            $RegistroClientesRepartidor[$i]["Telefono"] = utf8_encode($RegistroClientesRepartidor[$i]["Telefono"]);
            $RegistroClientesRepartidor[$i]["Email"] = utf8_encode($RegistroClientesRepartidor[$i]["Email"]);
            $RegistroClientesRepartidor[$i]["Direccion"] = utf8_encode($RegistroClientesRepartidor[$i]["Direccion"]);
            $RegistroClientesRepartidor[$i]["Referencia"] = utf8_encode($RegistroClientesRepartidor[$i]["Referencia"]);
            $RegistroClientesRepartidor[$i]["Barrio"] = utf8_encode($RegistroClientesRepartidor[$i]["Barrio"]);
            //$RegistroClientesRepartidor[$i]["Dia"] = utf8_encode($RegistroClientesRepartidor[$i]["Dia"]);


  /*
            $RegistroClientesRepartidor[$i]["ClientesDirectos_Persona_IdCliente"] = json_encode($RegistroClientesRepartidor[$i]["ClientesDirectos_Persona_IdCliente"], JSON_UNESCAPED_UNICODE);
            $RegistroClientesRepartidor[$i]["ClientesDirectos_Persona_DNICliente"] = json_encode($RegistroClientesRepartidor[$i]["ClientesDirectos_Persona_DNICliente"], JSON_UNESCAPED_UNICODE);
            $RegistroClientesRepartidor[$i]["Apellido"] = json_encode($RegistroClientesRepartidor[$i]["Apellido"], JSON_UNESCAPED_UNICODE);
            $RegistroClientesRepartidor[$i]["Nombre"] = json_encode($RegistroClientesRepartidor[$i]["Nombre"], JSON_UNESCAPED_UNICODE);
            $RegistroClientesRepartidor[$i]["Telefono"] = json_encode($RegistroClientesRepartidor[$i]["Telefono"], JSON_UNESCAPED_UNICODE);
            $RegistroClientesRepartidor[$i]["Email"] = json_encode($RegistroClientesRepartidor[$i]["Email"], JSON_UNESCAPED_UNICODE);
            $RegistroClientesRepartidor[$i]["Direccion"] = json_encode($RegistroClientesRepartidor[$i]["Direccion"], JSON_UNESCAPED_UNICODE);
            $RegistroClientesRepartidor[$i]["Referencia"] = json_encode($RegistroClientesRepartidor[$i]["Referencia"], JSON_UNESCAPED_UNICODE);
            $RegistroClientesRepartidor[$i]["Barrio"] = json_encode($RegistroClientesRepartidor[$i]["Barrio"], JSON_UNESCAPED_UNICODE);
            $RegistroClientesRepartidor[$i]["Dia"] = json_encode($RegistroClientesRepartidor[$i]["Dia"], JSON_UNESCAPED_UNICODE);

  */



          }
          /*
          echo "<br>";
          print_r($RegistroClientesRepartidor);
          echo "<br>";
          */
          $data->clientes = $RegistroClientesRepartidor;
        }
        else
        {
          // code...
        }





      }
}
else
{
  // code...
  $response->exito= false;
  $response->msj= "Usuario o contraseña incorrecta";
  //$response["repartidor"]= $RegistroRepartidor;
}

$response->data = $data;
//echo json_encode($response,JSON_UNESCAPED_UNICODE);
echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
/*
echo json_last_error();
echo "<br>";
json_last_error_msg();
*/
?>
