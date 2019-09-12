<?php

require_once ('mysql_crud.php');



$db = new Database();

$sql = 'SELECT clientesdir.Repartidor_Persona_IdRepartidor, clientesdir.ClientesDirectos_Persona_IdCliente, clientesdir.Direccion, clientesdir.Barrio_IdBarrio, clientesdir.Referencia, clientesdir.Latitud, clientesdir.Longitud, clientesdir.Barrio, p.Apellido, p.Nombre
        FROM (SELECT idRRC.Repartidor_Persona_IdRepartidor, idRRC.ClientesDirectos_Persona_IdCliente, d.Direccion, d.Barrio_IdBarrio, d.Referencia, d.Latitud, d.Longitud, b.Nombre as Barrio
	    FROM (SELECT dr.Repartidor_Persona_IdRepartidor, cddr.ClientesDirectos_Persona_IdCliente
		FROM (SELECT idRutaDeReparto, Repartidor_Persona_IdRepartidor FROM diadereparto WHERE Dia = "LUNES") as dr, clientesdirectos__diadereparto as cddr
		WHERE dr.idRutaDeReparto = cddr.ZonaDeReparto_idRutaDeReparto) as idRRC, direccion as d, barrio as b 
	WHERE idRRC.ClientesDirectos_Persona_IdCliente = d.Persona_IdPersona AND d.Barrio_IdBarrio = b.IdBarrio) as clientesdir , persona p 

WHERE p.IdPersona = clientesdir.ClientesDirectos_Persona_IdCliente';

    $db->connect();
    $db->sql($sql);
    $resultado = $db->getResult();
    $db->disconnect();

    print_r($resultado);


