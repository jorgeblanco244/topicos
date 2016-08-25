<?php
	/* LIBRERIAS */   
	require_once("includes/class.ofertas.php");
	
	/* OFERTA */
	/* ELIMINO LA OFERTA PARA EL ARTICULO SEGUN EL ID ENVIADO */
	$class_of = new ofertas();
	$result = $class_of->eliminar_oferta($_REQUEST['id'],$db); 
  
	if($result){
		echo "<div>La oferta para el Art&iacute;culo fue borrada con exito.</div>";	
	}else{
		echo "<div>Error al borrar la oferta para el Art&iacute;culo.</div>";	
	}	

	//CIERRO LA CONEXION A LA BASE
	$db->Close();   
?>