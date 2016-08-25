<?php
	/* PROCESA REQUERIMIENTOS A LA BASE DE DATOS Y ALMACENA ERRORES */
	function LOGS($xconn,$xtransaccion){
		// Aquí debes especificar la ruta en donde se van a grabar los archivos de texto.
		$xcarpetaLogs = 'cms/logs/';
		$xcarpetaErrs = 'cms/errors/';
		$resultado = strpos(strtolower($_SERVER['REQUEST_URI']), "cms");

		if($resultado !== FALSE){
			$xcarpetaErrs = 'errors/';
		}
		$resultado = strpos(strtolower($_SERVER['REQUEST_URI']), "carrito");
		if($resultado !== FALSE){
			$xcarpetaErrs = '../cms/errors/';
		}
		
		$resultado = strpos(strtolower($_SERVER['REQUEST_URI']), "articulos");
		if($resultado !== FALSE){
			$xcarpetaErrs = './cms/includes/errors/';
		}
		
		//Ejecutar transaccion
		$xtransaccion_old = $xtransaccion;
		$xresult_sql = $xconn->query($xtransaccion);
		$xlast_error = $xconn->errno;
		$xfecha = date("Y-m-d");
		$xhora = date("H:i:s");
		
		if ($xlast_error){
			// Generación de la ficha
			$xcadenota = "FECHA: ".date("Y-m-d").", ".date("H:i:s");
			
			$xcadenota.= " |HOST: ".$_SERVER['HTTP_HOST'];
			
			$xcadenota.= " |LLAMADA: ".$_SERVER['HTTP_REFERER']; // Coloca el nombre del programa que hizo la llamada al programa que se ejecutó
			$xcadenota.= " |PROGRAMA: ".$_SERVER['REQUEST_URI']; // Coloca el nombre del programa que se ejecutó más sus variables trasferidas por la URL
			
			$xcadenota.= " |".$xlast_error.": ".$xconn->error; // En caso de haber error, coloca el mensaje de error del manejador de la BD
			$xcadenota.= " |QUERY: ".$xtransaccion_old.chr(13).chr(10); // Coloca la transacci?n o la consulta tal cual sucedi? en la BD
						
			$ruta = $xcarpetaErrs."errors_".date("Y-m-d").".txt";
			
			if(!$arch_error = fopen($ruta, "a+")){
				echo "No se puede abrir el archivo ".$xcarpetaErrs."errors_".date("Y-m-d").".txt";
				exit;
			}
			if (fwrite($arch_error, $xcadenota)=== FALSE) {
				echo "No se puede escribir en el archivo ($nombre_archivo)";
				exit;
			}
			
			fclose($arch_error);
		  
		} // ENDIF
		return $xresult_sql;
	} // END FUNCTION
?>