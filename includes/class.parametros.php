<?php
	/* PARAMETROS GENERALES DE LA EMPRESA */
	class parametros {
		var $id; //int(10): codigo del articulo UNICO
		var $empresa; //varchar(45): nombre de la empresa
		var $razonsocial_fiscal; //varchar(45): descripción larga
		var $razonsocial_fantasia;	//varchar(45)
		var $clientes_regimen_de_iva_id;	//int(10)
		var $deposito_id; //int(10) asociado a la tabla depositos
		var $moneda_id; //int(10): moneda por defecto
		var $tipo_de_pago_id; //int(10): tipo de pago por defecto
		var $decimales; //int(1)
		
		var $logo; //blob
		var $banner; //blob
		var $logo_marca_de_agua; //blob 
		
		var $parametros_perfil_empresa; //int(10) - Tipo de Empresa (Aplica o no Alfabeta)
		var $rec_desc_tipo_de_pago_por_item; //tinyint(1) 1 - Muestro desc/rec. por item // 0 - al pie impresión
		
		var $oculto; //tinyint(1): indica si se muestra el articulo (valores posibles: 0 - oculto / 1 - visible)
		
		
		/*---------------------------------------------------------------------------------------------------------*/
		
		var $xcarpetaErrs = "cms/includes/errors/class.parametros/"; //CARPETA DONDE SE ALMACENA EL ARCHIVO DE ERRORES
		
		function consultar_parametros($db){
			$query = "SELECT P.id, P.empresa, P.razonsocial_fiscal, P.razonsocial_fantasia, P.clientes_regimen_de_iva_id,
							P.deposito_id, P.moneda_id, P.tipo_de_pago_id, P.decimales, P.fecha_inicio_actividades,
							P.logo, P.banner, P.logo_marca_de_agua, P.parametros_perfil_empresa, P.rec_desc_tipo_de_pago_por_item,
							P.domicilio_comercial, P.domicilio_localidad_comercial, P.telefono_comercial, P.email_comercial,
							PAD.slogan
						FROM parametros P
							LEFT OUTER JOIN parametros_adicional AS PAD ON (P.id = PAD.id)
						WHERE P.oculto = 0 
						ORDER BY P.id DESC
						LIMIT 1 ";
			
			$resultpp = $this->LOGS_PARAM($db,$query);
			
			return $resultpp;
		}
		
		/* PROCESA REQUERIMIENTOS A LA BASE DE DATOS Y ALMACENA ERRORES */
		protected function LOGS_PARAM($xconn,$xtransaccion){
			
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
							
				$ruta = $this->xcarpetaErrs."errors_param_".date("Y-m-d").".txt";
				
				if(!$arch_error = fopen($ruta, "a+")){
					echo "No se puede abrir el archivo ".$this->xcarpetaErrs."errors_param_".date("Y-m-d").".txt";
					exit;
				}
				if (fwrite($arch_error, $xcadenota)=== FALSE) {
					echo "No se puede escribir en el archivo (".$this->xcarpetaErrs."errors_param_".date("Y-m-d").".txt)";
					exit;
				}
				
				fclose($arch_error);
			  
			} // ENDIF
			return $xresult_sql;
		} // END FUNCTION
		
	}
?>