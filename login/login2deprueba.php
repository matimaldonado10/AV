<?php
include_once('../path.php');

include_once(path::dirProyecto.'/login/buscarUsuario.php');
include_once(path::dirProyecto.'/login/tablas.php');



$username = $_POST["usuario"];
$password = $_POST["contraseña"];
$primerLogin= $_POST["intento"];

$userlogin = new buscarUsuario();
$tablas = new tablas();

$RegistroSupervisor = $userlogin->getSupervisor($username);
$RegistroRepartidor = $userlogin->getRepartidor($username);

$response = new stdClass();
$data = new stdClass();
$response->exito = false;

$Dias = array();



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

function codificarCaracteresAUtf8($RegistroClientesRepartidor){

  for ($i=0; $i<count($RegistroClientesRepartidor); $i++)
          {

          
            $RegistroClientesRepartidor[$i]["ClientesDirectos_Persona_IdCliente"] = utf8_encode($RegistroClientesRepartidor[$i]["ClientesDirectos_Persona_IdCliente"]);
            $RegistroClientesRepartidor[$i]["ClientesDirectos_Persona_DNICliente"] = utf8_encode($RegistroClientesRepartidor[$i]["ClientesDirectos_Persona_DNICliente"]);
            //$RegistroClientesRepartidor[$i]["Apellido"] = utf8_encode($RegistroClientesRepartidor[$i]["Apellido"]);
            $RegistroClientesRepartidor[$i]["Apellido"] = iconv("CP1255", "UTF-8", $RegistroClientesRepartidor[$i]["Apellido"] );

            //$RegistroClientesRepartidor[$i]["Nombre"] = utf8_encode($RegistroClientesRepartidor[$i]["Nombre"]);

            $RegistroClientesRepartidor[$i]["Nombre"] = iconv("CP1255", "UTF-8", $RegistroClientesRepartidor[$i]["Nombre"] );

            $RegistroClientesRepartidor[$i]["Telefono"] = utf8_encode($RegistroClientesRepartidor[$i]["Telefono"]);
            $RegistroClientesRepartidor[$i]["Email"] = utf8_encode($RegistroClientesRepartidor[$i]["Email"]);
            $RegistroClientesRepartidor[$i]["Direccion"] = utf8_encode($RegistroClientesRepartidor[$i]["Direccion"]);
            $RegistroClientesRepartidor[$i]["Referencia"] = utf8_encode($RegistroClientesRepartidor[$i]["Referencia"]);
            $RegistroClientesRepartidor[$i]["Barrio"] = utf8_encode($RegistroClientesRepartidor[$i]["Barrio"]);
            //$RegistroClientesRepartidor[$i]["Dia"] = utf8_encode($RegistroClientesRepartidor[$i]["Dia"]);




          }
          /*
          echo "<br>";
          print_r($RegistroClientesRepartidor);
          echo "<br>";
          */

          return $RegistroClientesRepartidor;
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
      $login=false;
      $response->msj = "Usuario o Contraseña incorrecta";

    }
}
else
{
  $login=false;
  $response->msj= "Contraseña o Usuario nulo";

}


if ($login)
{
  // code...
  $response->exito = true;
      if ($usr == "sup")
      {
        $data->id = $RegistroSupervisor[0]["Persona_IdSupervisor"];
        $dni= $RegistroSupervisor[0]["Persona_DNISupervisor"];
        $data->dni = $dni;
        $data->msj = "supervisor";

      

        $data->repartidores = $tablas->obtenerRepartidores();
      }
      else
      {
        $data->id = $RegistroRepartidor[0]["Persona_IdRepartidor"];
        $dni= $RegistroRepartidor[0]["Persona_DNIRepartidor"];
        $data->dni = $dni;
        $data->msj = "repartidor";

        if (strcmp($primerLogin, "true") == 0) //IGUAL A CERO SIGNIFICA QUE $primerLogin es igual a true, por lo tanto, el usuario se loguea por primera vez
        {

          /*
              Se obtienen todos los clientes del repartidor
          */

          $RegistroClientes = $tablas->obtenerClientesDeRepartidor($dni);



          // SIRVE PARA QUE EL REGISTRO DE CLIENTES CONTENGA CLIENTES ÚNICOS
            $j=0;
            $RegistroClientesRepartidor = array();

            for ($i=0; $i <count($RegistroClientes) ; $i++) {

              // code...
              if ($i==0)
              {
                $dniDistinto = $RegistroClientes[$i]["DNI"];
                $indice = $i;
              }



              if (strcmp($dniDistinto, $RegistroClientes[$i]["DNI"]) == 0)
              {
                $aux = array('Dia' => $RegistroClientes[$i]['Dia']);
                array_push($Dias,$aux);


              }
              else
              {

                $RegistroClientesRepartidor[$j]["ClientesDirectos_Persona_IdCliente"] = $RegistroClientes[$indice]["IdPersona"];
                $RegistroClientesRepartidor[$j]["ClientesDirectos_Persona_DNICliente"] = $RegistroClientes[$indice]["DNI"];
                $RegistroClientesRepartidor[$j]["Apellido"] = $RegistroClientes[$indice]["Apellido"];
                $RegistroClientesRepartidor[$j]["Nombre"] = $RegistroClientes[$indice]["Nombre"];
                $RegistroClientesRepartidor[$j]["Telefono"] = $RegistroClientes[$indice]["Telefono"];
                $RegistroClientesRepartidor[$j]["Email"] = $RegistroClientes[$indice]["Email"];
                $RegistroClientesRepartidor[$j]["Direccion"] = $RegistroClientes[$indice]["Direccion"];
                $RegistroClientesRepartidor[$j]["Referencia"] = $RegistroClientes[$indice]["Referencia"];
                $RegistroClientesRepartidor[$j]["Barrio"] = $RegistroClientes[$indice]["Barrio"];
                $RegistroClientesRepartidor[$j]["Dia"] = $Dias;
                $j++;

                $dniDistinto = $RegistroClientes[$i]["DNI"];
                unset($Dias);
                unset($aux);
                $Dias = array();
                $aux = array('Dia' => $RegistroClientes[$i]['Dia']);
                array_push($Dias,$aux);
                $indice = $i;



              }


            }


            $registroClientesFinal = codificarCaracteresAUtf8($RegistroClientesRepartidor);



          /*
            echo "<br>";
            print_r($RegistroClientesRepartidor);
            echo "<br>";
          */



      //count($RegistroClientesRepartidor)-1
          
          $data->clientes = $registroClientesFinal;
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

echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK );


/*
echo json_last_error();
echo "<br>";
json_last_error_msg();
*/

