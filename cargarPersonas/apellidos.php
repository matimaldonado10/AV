<?php

/**
* 
*/
class apellidos

{
    
    public function obtenerApellido()
    
    {
        if (($fichero = fopen("apellidos.csv", "r")) !== FALSE) 
        {
            // Lee los nombres de los campos
            //$nombres_campos = fgetcsv($fichero, 1000, ",");
            //$num_campos = count($nombres_campos);
            // Lee los registros
            $icampo = 1;

            

            while (($datos = fgetcsv($fichero, 1000, ",")) !== FALSE) 
            {
                // Crea un array asociativo con los nombres y valores de los campos
                
                $registros[$icampo] = $datos[0];
                $icampo++;
                // Añade el registro leido al array de registros
               
            }
           
            fclose($fichero);
         
           
        }

    return $registros;

    }
}
