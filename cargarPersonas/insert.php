<?php
/*
	RECIBE LOS DATOS DE UNA PERSONA (DNI, APELLIDO, NOMBRE, TELEFONO, MAIL) E INSERTA EN LA TABLA PERSONA DE AQUA VITAL



*/
include_once ('class/mysql_crud.php');
class Insertar {
	

	public function insertarDatosPersona ($dni_persona, $apellido_persona, $nombre_persona, $telefono_persona=null, $email_persona=null)
	{
		$db = new Database();
		$db->connect();
		$dni = $db->escapeString($dni_persona);
		$apellido = $db->escapeString($apellido_persona); // Escape any input before insert
		$nombre = $db->escapeString($nombre_persona);
		$telefono = $db->escapeString($telefono_persona);
		$email = $db->escapeString($email_persona);
		$estado = $db->escapeString("1");

		if ($telefono==!NULL) 
		{
			if ($email==!NULL) 
			{
				$db->insert('persona',array('Apellido'=>$apellido,'Nombre'=>$nombre,'Telefono'=>$telefono,'Email'=>$email,'DNI'=>$dni,'Estado'=>$estado));  // Table name, column names and respective values
			}
			else
			{
				$db->insert('persona',array('Apellido'=>$apellido,'Nombre'=>$nombre,'Telefono'=>$telefono,'DNI'=>$dni,'Estado'=>$estado));  // Table name, column names and respective values
			}
		}
		else
		{
			if ($email==!NULL) 
			{
				$db->insert('persona',array('Apellido'=>$apellido,'Nombre'=>$nombre,'DNI'=>$dni,'Estado'=>$estado, 'Email'=>$email));  // Table name, column names and respective values
			}
			else
			{
				$db->insert('persona',array('Apellido'=>$apellido,'Nombre'=>$nombre,'DNI'=>$dni,'Estado'=>$estado));  // Table name, column names and respective values
			}
		}// Table persona, nombres de columnas y respectivos valores

		$res = $db->getResult();  
		
		$db->disconnect();
		print_r($res);
		echo " ";
	}

	public function insertarDireccion ($direccion, $referencia, $idPersona, $dni, $idBarrio)
	{
		$db = new Database();
		$db->connect();
		$dni = $db->escapeString($dni);
		$direccion = $db->escapeString($direccion); // Escape any input before insert
		$referencia = $db->escapeString($referencia);
		$idPersona = $db->escapeString($idPersona);
		$idBarrio = $db->escapeString($idBarrio);
		

		if ($referencia==!NULL) 
		{
			$db->insert('direccion',array('Direccion'=>$direccion,'Barrio_IdBarrio'=>$idBarrio,'Persona_IdPersona'=>$idPersona,'Persona_DNI'=>$dni,'Referencia'=>$referencia));
			//$db->insert('persona',array('Apellido'=>$apellido,'Nombre'=>$nombre,'Telefono'=>$telefono,'Email'=>$email,'DNI'=>$dni,'Estado'=>$estado));  // Table name, column names and respective values
		}
		else
		{
			$db->insert('direccion',array('Direccion'=>$direccion,'Barrio_IdBarrio'=>$idBarrio,'Persona_IdPersona'=>$idPersona,'Persona_DNI'=>$dni));
		}
		//$res = $db->getResult(); 
		$db->disconnect();
		//print_r($res);
	}

		
	public function insertarClienteDirecto($idPersona, $dni)
	{
		$db = new Database();
		$db->connect();
		$dni = $db->escapeString($dni);
		$idPersona = $db->escapeString($idPersona); // Escape any input before insert

		$db->insert('clientesdirectos',array('Persona_IdCliente'=>$idPersona,'Persona_DNICliente'=>$dni));

		$res = $db->getResult();  
		
		$db->disconnect();
		print_r($res);
		echo " ";
		echo " CLIENTE ";
	}
	

	public function insertarDistribuidor($idPersona, $dni)
	{
		$db = new Database();
		$db->connect();
		$dni = $db->escapeString($dni);
		$idPersona = $db->escapeString($idPersona); // Escape any input before insert

		$db->insert('distribuidores',array('Persona_IdDistribuidor'=>$idPersona,'Persona_DNIDistribuidor'=>$dni));

		$res = $db->getResult();  
		
		$db->disconnect();
		print_r($res);
		echo " ";
		echo " DISTRIBUIDOR ";

	}

	public function insertarRepartidor($idPersona, $dni)
	{
		$db = new Database();
		$db->connect();
		$dni = $db->escapeString($dni);
		$idPersona = $db->escapeString($idPersona); // Escape any input before insert

		$db->insert('repartidor',array('Persona_IdRepartidor'=>$idPersona,'Persona_DNIRepartidor'=>$dni));

		$res = $db->getResult();  
		
		$db->disconnect();
		print_r($res);
		echo " ";
		echo " REPARTIDOR ";

	}
}
