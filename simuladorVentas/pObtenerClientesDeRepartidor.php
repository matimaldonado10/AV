<?php
include_once('mysql_crud.php');
{
  $db = new Database();
  $db->connect();
  $idRepartidor=4;
  $dia = 'LUNES';

  $db->select('zonadereparto','ClientesDirectos_Persona_IdCliente, ClientesDirectos_Persona_DNICliente','clientesdirectos__zonadereparto','Repartidor_Persona_IdRepartidor='.$idRepartidor.' AND Dia="'.$dia.'"','ClientesDirectos_Persona_IdCliente'); 
    // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
  $Registros = $db->getResult();
  $db->disconnect();
  echo "<br>";

  echo "<br>";

  print_r($Registros);


}
