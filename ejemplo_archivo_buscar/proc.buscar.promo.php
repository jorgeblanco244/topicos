<?php 
		//----------------------------------------------------------------------------------------
		$_pagi_conteo_alternativo = true; //OPCIONAL		Booleano. Define si se utiliza mysql_num_rows() (true) o COUNT(*) (false).
											//Por defecto está en false.
											
		$_pagi_cuantos = 5; //Establesco la cantidad de resultados que muestra el paginador.
		 
		 //Cadena que separa los enlaces numéricos en la barra de navegación entre páginas.
		$_pagi_separador = "&nbsp;&nbsp;&nbsp;";
		
		//Cadena. Contiene el nombre del estilo CSS para los enlaces de paginación.
		//$_pagi_nav_estilo = "titulosnovedades"; 
		
		//Cadena. Contiene lo que debe ir en el enlace a la página anterior. Puede ser un tag <img>.
		//Por defecto se utiliza la cadena "&laquo; Anterior".
		//$_pagi_nav_anterior = "<img src='imgs/btn_anterior1_2.png' name='boton_ant' width='31' height='31' border='0' id='boton_sig' />";
		
		//Cadena. Contiene lo que debe ir en el enlace a la página siguiente. Puede ser un tag <img>.
		//Por defecto se utiliza la cadena "Siguiente &raquo;"
		//$_pagi_nav_siguiente = "<img src='imgs/btn_siguiente1_2.png' name='boton sig' width='31' height='31' border='0' id='boton sig' />";
		
		//Cadena. Contiene lo que debe ir en el enlace a la primera página. Puede ser un tag <img>.
		//Por defecto se utiliza la cadena "&laquo;&laquo; Primera".
		//$_pagi_nav_primera = "<img src='imgs/btn_primera1_2.png' name='boton_primera' width='31' height='31' border='0' id='boton_primera' />";
		
		//Cadena. Contiene lo que debe ir en el enlace a la página siguiente. Puede ser un tag <img>.
		//Por defecto se utiliza la cadena "&Uacute;ltima &raquo;&raquo;"
		//$_pagi_nav_ultima = "<img src='imgs/btn_ultima1_2.png' name='boton_ultima' width='31' height='31' border='0' id='boton_ultima' />";
		
		//cargo la consulta en el paginador.
		$_pagi_sql = "SELECT * FROM promociones";

		if($titulo != "" OR $fecha_desde != "" OR $fecha_hasta != ""){$_pagi_sql .= " WHERE ";}
		
		if($titulo != ""){$_pagi_sql .= "(titulo LIKE '%" . mysql_real_escape_string($titulo) . "%' OR descripcion LIKE '%" . mysql_real_escape_string($titulo) . "%')";}
		
		if($titulo != "" AND $fecha_desde != ""){ $_pagi_sql .= " OR ";}
		
		if($fecha_desde != "" AND $fecha_hasta != ""){$_pagi_sql .= "(";}
		
		if($fecha_desde != ""){$_pagi_sql .= "fecha_desde >= '$fecha_desde'";}
		
		if($titulo != "" AND $fecha_desde == "" AND $fecha_hasta != ""){$_pagi_sql .= " OR ";}
		
		if($fecha_desde != "" AND $fecha_hasta != ""){$_pagi_sql .= " AND ";}
		
		if($fecha_hasta != ""){$_pagi_sql .= "fecha_hasta <= '$fecha_hasta'";}
		
		if($fecha_desde != "" AND $fecha_hasta != ""){$_pagi_sql .= ")";}
		
		$_pagi_sql .= " ORDER BY id DESC";
		
		
		//Incluyo el archivo que realiza la funcion de paginar.
		include("paginator.inc.php");
		
		//$users = new DBUsuarios($conf_mysql_db,$link);
		//$result = $users->Buscar($usuario);
		//----------------------------------------------------------------------------------------
		//RECORRO EL ARREGLO QUE CONTIENE LOS ARCHIVOS (EN CASO DE SER MAS DE UNO)
		if($_pagi_result->num_rows > 0){//if2
			
			while ($resultado = $_pagi_result->fetch_array()){
				$id = $resultado["id"];
				$titulo = $resultado["titulo"];
				$fd = $resultado["fecha_desde"];
				$fd = substr($fd, 8, 2) . "/" . substr($fd, 5, 2) . "/" . substr($fd, 0, 4);
				$fh = $resultado["fecha_hasta"];
				$fh = substr($fh, 8, 2) . "/" . substr($fh, 5, 2) . "/" . substr($fh, 0, 4);
				$descripcion = html_entity_decode($resultado["descripcion"]);
				
				//$msg .= "<div id='espacio'></div>";	
				
				$msg .= "<div class='noti_buscar_cont'>
							<div id='menu_cms_title'><div id='cms_titulo'>".$titulo."</div></div>
							<div id='menu_noticia_title'><b>Fecha Inicio:</b> ".$fd." <b>- Fecha Fin:</b> ".$fh."</div>
							<div id='menu_noticia_title'>".trim(strip_tags($descripcion))."<br />
							<a href='html.resultados.php?opcion=eliminar_promo&id=".$id."'>Eliminar</a> &nbsp;&nbsp; 
							<a href='html.modificar.promo.php?id=".$id."'>Modificar</a>
							</div>
						</div>	
						<div style='height:15px'>&nbsp;</div>"; // listo los archivos subidos.
								
			} //while
			
			$msg .= "<div id='paginador'>".$_pagi_navegacion."</div>";	
			
		}//if2
		else{//else2
			//mysql_free_result($result);//liberará toda la memoria asociada con el identificador del resultado result. 
			$msg .= "<div><center>No se encontraron resultados para su busqueda</center></div>";
		}//else2
		
		echo $msg;
		
                //} //if1
       // }else {echo "Algo salio mal";}
?>