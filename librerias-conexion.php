<?php
	session_start();
	/*--- LIBRERIAS Y CONEXIONES ---*/
	/*
	Este archivo es lo primero que se incluye en todas las paginas, y contiene las llamadas a las 
	librerias principales y la conexión con la base de datos. Dejando la posibilidad de inicializar
	aqui una sesión.
	*/
	
	/* LIBRERIAS */
	require_once("conf/conf.php"); //CONTIENE LOS PARAMETROS DE CONFIGURACIÓN DEL SITIO
	require_once("includes/common.lib.php"); //CONTIENE LIBRERIAS COMUNES PARA TRATIMIENTO HTML
	require_once("includes/class.db.php");	//CONTIENE LOS METODOS PARA ESTABLECER CONEXIÓN CON LA BASE DE DATOS
	require_once("includes/admin_logs.php"); //CONTIENE METODOS PARA CONEXIÓN EJECUTAR CONSULTA CON CONTROL DE ERRORES
	require_once("includes/class.parametros.php");
	require_once("includes/conectarBD.php");
  	require_once("includes/clase_seccion.php");
	require_once("includes/clase_subSeccion.php");
	require_once("includes/clase_parte.php");
	
	/* CONEXION DB */
	//INICIALIZO LA CLASE Y ESTABLESCO CONEXIÓN CON LA BASE DE DATOS  
	$db = new DataBase($conf_mysql_host,$conf_mysql_user,$conf_mysql_password,$conf_mysql_db);
	
	/* --- RECUPERO PARAMETROS DE LA EMPRESA --- */
	$class_parametros = new parametros();
	
	$result_par = $class_parametros->consultar_parametros($db);
	
	if($result_par->num_rows > 0){
		/* --- CARGO PARAMETROS DE LA EMPRESA --- */
		$array_par = $result_par->fetch_array();
		$_SESSION["parametros"]["id"] = $array_par["id"];
		$_SESSION["parametros"]["razonsocial_fantasia"] = $array_par["razonsocial_fantasia"];	
		$_SESSION["parametros"]["deposito_id"] = $array_par["deposito_id"];	
		$_SESSION["parametros"]["decimales"] = $array_par["decimales"];	
		$_SESSION["parametros"]["moneda_id"] = $array_par["moneda_id"];	
		$_SESSION["parametros"]["rec_desc_tipo_de_pago_por_item"] = $array_par["rec_desc_tipo_de_pago_por_item"];	
				
		$_SESSION["parametros"]["logo"] = $array_par["logo"];
		$_SESSION["parametros"]["banner"] = $array_par["banner"];	
		$_SESSION["parametros"]["slogan"] = $array_par["slogan"];
		
		$_SESSION["parametros"]["domicilio_comercial"] = $array_par["domicilio_comercial"];	
		$_SESSION["parametros"]["domicilio_localidad_comercial"] = $array_par["domicilio_localidad_comercial"];
		$_SESSION["parametros"]["telefono_comercial"] = $array_par["telefono_comercial"];	
		$_SESSION["parametros"]["email_comercial"] = $array_par["email_comercial"];
		/* -------------------------------------- */
	}else{
		/* ERROR: PARAMETROS DE LA EMPRESA NO DEFINIDOS */
		$_SESSION["parametros"]["id"] = 0;
		$_SESSION["parametros"]["razonsocial_fantasia"] = "Empresa NN";	
		$_SESSION["parametros"]["deposito_id"] = 0;	
		$_SESSION["parametros"]["decimales"] = 2;	
		$_SESSION["parametros"]["moneda_id"] = 1;	
		$_SESSION["parametros"]["rec_desc_tipo_de_pago_por_item"] = 1;	
		
		$_SESSION["parametros"]["logo"] = "";	
		$_SESSION["parametros"]["banner"] = "";
		$_SESSION["parametros"]["slogan"] = "";
		
		$_SESSION["parametros"]["domicilio_comercial"] = "";	
		$_SESSION["parametros"]["domicilio_localidad_comercial"] = "";
		$_SESSION["parametros"]["telefono_comercial"] = "";	
		$_SESSION["parametros"]["email_comercial"] = "";
		
	}
	
	/* FUNCION PARA OBTENER EL MIME-TYPE DE LAS IMAGENES BLOB */
	function mimetype($data){
		//File signatures with their associated mime type
		$Types = array(
		"474946383761"=>"image/gif",                        //GIF87a type gif
		"474946383961"=>"image/gif",                        //GIF89a type gif
		"89504E470D0A1A0A"=>"image/png",
		"FFD8FFE0"=>"image/jpeg",                           //JFIF jpeg
		"FFD8FFE1"=>"image/jpeg",                           //EXIF jpeg
		"FFD8FFE8"=>"image/jpeg",                           //SPIFF jpeg
		"25504446"=>"application/pdf",
		"377ABCAF271C"=>"application/zip",                  //7-Zip zip file
		"504B0304"=>"application/zip",                      //PK Zip file ( could also match other file types like docx, jar, etc )
		);

		$Signature = substr($data,0,60); //get first 60 bytes shouldnt need more then that to determine signature
		$inter = unpack("H*",$Signature);
		$Signature = array_shift($inter); //String representation of the hex values

		foreach($Types as $MagicNumber => $Mime)
		{
			if( stripos($Signature,$MagicNumber) === 0 )
				return $Mime;  
		}

		//Return octet-stream (binary content type) if no signature is found
		return "application/octet-stream"; 
	}
?>