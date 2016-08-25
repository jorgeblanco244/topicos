<?php
	/* LIBRERIAS */   
	require_once("includes/class.promociones.php");
	require_once("includes/common.lib.php");
	
	if(!empty($_POST['titulo']) && !empty($_POST['descripcion'])  && !empty($_POST['fecha_desde'])   && !empty($_POST['fecha_hasta']) ){
 
		$datos['titulo'] = html_chars(urldecode($_POST['titulo']));//CONVIERTO CARACTERES ESPECIALES EN ETIQUETAS HTML
		$datos['titulo'] = trim(strip_tags($datos['titulo'],"<p><br><br /><strong><a><i><u>")); //ELIMINO ESPACIOS EN BLANCO Y ETIQUETAS HTML EXCEPTO LAS ESPECIFICADAS

		$datos['descripcion'] = htmlentities(addslashes(trim(strip_tags($_POST['descripcion'],"<p><br><br /><strong><a><i><u>"))));

		/* SETEO LAS FECHAS AL FORMATO SQL */
		/* VIGENCIA DE LA PROMO */
		$datos['fecha_desde'] = $_POST['fecha_desde'];
		$datos['fecha_desde'] = substr($datos['fecha_desde'], 6, 4) . "-" . substr($datos['fecha_desde'], 3, 2) . "-" . substr($datos['fecha_desde'], 0, 2);

		$datos['fecha_hasta'] = $_POST['fecha_hasta'];
		$datos['fecha_hasta'] = substr($datos['fecha_hasta'], 6, 4) . "-" . substr($datos['fecha_hasta'], 3, 2) . "-" . substr($datos['fecha_hasta'], 0, 2);

		/* VIGENCIA PARA MOSTRAR GANADORES */
		$datos['fchdes_ganador'] = $_POST['fchdes_ganador'];
		$datos['fchdes_ganador'] = substr($_POST['fchdes_ganador'], 6, 4) . "-" . substr($_POST['fchdes_ganador'], 3, 2) . "-" . substr($_POST['fchdes_ganador'], 0, 2);

		$datos['fchhas_ganador'] = $_POST['fchhas_ganador'];
		$datos['fchhas_ganador'] = substr($_POST['fchhas_ganador'], 6, 4) . "-" . substr($_POST['fchhas_ganador'], 3, 2) . "-" . substr($_POST['fchhas_ganador'], 0, 2);

		/* ID DEL GANADOR */
		$datos['id_ganador'] = $_POST['id_ganador'];
		
		$datos['login'] = $_SESSION['login'];
			
		$promo = new promociones();
		$promo->actualizar_promo($datos,$_POST['id'],$db);

		echo "<div>La promoci&oacute;n fue actualizada con exito.</div>";	
	//$db->Close();
	}else{
		echo "<div>Error en el envio de datos.</div>";
	}
?>
