<?php
class constantesDB{
   public static $articulo_id                      =   'IdArticulo';
   public static $articulo_nombre                  =   'Nombre';
   public static $articulo_precio                  =   'Precio';

   public static $barrio_id                        =   'IdBarrio';
   public static $barrio_nombre                    =   'Nombre';

   public static $cargaDescarga_id                 =   'idCarga';
   public static $cargaDescarga_fecha              =   'Fecha';
   public static $cargaDescarga_idRepartidor       =   'Repartidor_Persona_IdRepartidor';
   public static $cargaDescarga_dniRepartidor      =   'Repartidor_Persona_DNIRepartidor';
   public static $cargaDescarga_plataCarga         =   'PlataCarga';
   public static $cargaDescarga_plataDescarga      =   'PlataDescarga';
   public static $cargaDescarga_idSupervisor       =   'Supervisor_Persona_IdSupervisor';
   public static $cargaDescarga_dniSupervisor      =   'Supervisor_Persona_DNISupervisor';

   public static $clientesDirectos_id              =   'Persona_IdCliente';
   public static $clientesDirectos_dni             =   'Persona_DNICliente';

   public static $clientesDirectosDiaDeReparto_idCliente        =   'ClientesDirectos_Persona_IdCliente';
   public static $clientesDirectosDiaDeReparto_dniCliente       =   'ClientesDirectos_Persona_DNICliente';
   public static $clientesDirectosDiaDeReparto_idRutaDeReparto  =   'ZonaDeReparto_idRutaDeReparto';
   public static $clientesDirectosDiaDeReparto_orden            =   'Orden';

   public static $detalleCargaDescarga_id             =   'idDetalleCarga';
   public static $detalleCargaDescarga_carga          =   'Carga';
   public static $detalleCargaDescarga_descarga       =   'Descarga';
   public static $detalleCargaDescarga_idCarga        =   'Carga_idCarga';
   public static $detalleCargaDescarga_idArticulo     =   'Articulo_IdArticulo';

   public static $detalleVenta_id             =   'IdDetalleVenta';
   public static $detalleVenta_cantidad       =   'Cantidad';
   public static $detalleVenta_subtotal       =   'SubTotal';
   public static $detalleVenta_idVenta        =   'Venta_IdVentas';
   public static $detalleVenta_idArticulo     =   'Articulo_IdArticulo';

   public static $diaDeReparto_id               =   'idRutaDeReparto';
   public static $diaDeReparto_dia              =   'Dia';
   public static $diaDeReparto_idRepartidor     =   'Repartidor_Persona_IdRepartidor';
   public static $diaDeReparto_dniRepartidor    =   'Repartidor_Persona_DNIRepartidor';

   public static $direccion_id            =   'IdDireccion';
   public static $direccion_direccion     =   'Direccion';
   public static $direccion_idBarrio      =   'Barrio_IdBarrio';
   public static $direccion_idPersona     =   'Persona_IdPersona';
   public static $direccion_dni           =   'Persona_DNI';
   public static $direccion_referencia    =   'Referencia';
   public static $direccion_latitud       =   'Latitud';
   public static $direccion_longitud      =   'Longitud';

   public static $distribuidores_id       =   'Persona_IdDistribuidor';
   public static $distribuidores_dni      =   'Persona_DNIDistribuidor';

   public static $faltanteSobrante_id               =   'idFaltanteSobrante';
   public static $faltanteSobrante_plata            =   'Plata';
   public static $faltanteSobrante_idRepartidor     =   'Repartidor_Persona_IdRepartidor';
   public static $faltanteSobrante_dniRepartidor    =   'Repartidor_Persona_DNIRepartidor';
   public static $faltanteSobrante_fecha            =   'Fecha';

   public static $persona_id            =   'IdPersona';
   public static $persona_apellido      =   'Apellido';
   public static $persona_nombre        =   'Nombre';
   public static $persona_telefono      =   'Telefono';
   public static $persona_email         =   'Email';
   public static $persona_dni           =   'DNI';
   public static $persona_estado        =   'Estado';

   public static $repartidor_id              =   'Persona_IdRepartidor';
   public static $repartidor_dni             =   'Persona_DNIRepartidor';
   public static $repartidor_usuario         =   'Usuario';
   public static $repartidor_contraseña      =   'Contrasena';

   public static $supervisor_id              =   'Persona_IdSupervisor';
   public static $supervisor_dni             =   'Persona_DNISupervisor';
   public static $supervisor_usuario         =   'Usuario';
   public static $supervisor_contraseña      =   'Contrasena';

   public static $ventas_id                  =   'IdVentas';
   public static $ventas_envasesVacios       =   'EnvasesVacios';
   public static $ventas_fecha               =   'Fecha';
   public static $ventas_pago                =   'Pago';
   public static $ventas_idCliente           =   'ClienteDirecto_Persona_IdCliente';
   public static $ventas_dniCliente          =   'ClienteDirecto_Persona_DNICliente';
   public static $ventas_idDistribuidor      =   'Distribuidores_Persona_IdDistribuidor';
   public static $ventas_dniDistribuidor     =   'Distribuidores_Persona_DNIDistribuidor';
   public static $ventas_idRepartidor        =   'Repartidor_Persona_IdRepartidor';
   public static $ventas_dniRepartidor       =   'Repartidor_Persona_DNIRepartidor';
   public static $ventas_comprobado          =   'Comprobado';
   public static $ventas_total               =   'Total';

















   










 
}