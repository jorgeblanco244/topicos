<?php

	/* LIBRERIAS */   
	require_once("includes/class.archivos.php");
	require_once("includes/class.db.php");
	require_once("conf/conf.php");
	
	/* CONEXION DB */
	//CREO UN OBJETO DE BASE DE DATOS;  
	$db = new DataBase($conf_mysql_host,$conf_mysql_user,$conf_mysql_password,$conf_mysql_db);  
    
	//UTILIZO PARA TODAS LAS CONSULTAS A LA BASE DE DATOS EL ID DE LA NOTICIA!
  
	//BUSCO EL DETALLE DEL ARCHIVO PARA PODER ELIMINARLO FISICAMENTE.
	$arch = new archivo();
	$result = $arch->buscar_detalle_archivonot($_REQUEST['idarch'],$db);  
	
	//OBTENGO EL NOMBRE DEL ARCHIVO.
	$resultado = $result->fetch_array();
	$uniq_name = $resultado['file'];
	$classid = $resultado['clasificacionid'];
	
	if($classid == 1){
		//GENERO EL PATH ABSOLUTO AL DIRECTORIO DE UPLOAD
		$uploaddir = "..". $conf_up_img_promo_dir; 
	}
	
	$ruta = $uploaddir."/".$uniq_name;
	
	//LIBERO LA MEMORIA DE LOS RESULTADOS ANTERIOS.
	$result->free_result();

	//ELIMINO EL ARCHIVO DE LA BASE DE DATOS.
	$result = $arch->eliminar_archivo_noticia($_REQUEST['idarch'],$db);  

	//SI SE ELIMINO DE LA BASE DE DATOS LO ELIMINO FISICAMENTE.
	if($result){//if2
		unlink($ruta);	
	}//if2
	
	//BUSCO SI QUEDA ALGUNA IMAGEN PARA LA RECOMENDACION IMPLICADA
	$result_arch = $arch->buscar_detalle_archivo($_REQUEST['id'],$_REQUEST['sec'],$db);  
	//CUENTO CUANTOS REGISTROS SE OBTUVIERON
	$total = $result_arch->num_rows;
	//SI NO QUEDAN MAS IMAGENES PARA LA RECOMENDACION CAMBIO EL ESTADO DE imagen A 'no'.
	if($total == 0){
		$arch->actualizar_archivo_noticia($_REQUEST['sec'],$_REQUEST['id'],"no",$db);
	}
	
	//CIERRO LA CONEXION A LA BASE
	//$db->Close();  
	
	//REDIRECCIONO AL REPOSITORIO NUEVAMENTE.A FALTA DE AJAX!	
	echo "<meta http-equiv='refresh' content='0; URL=html.modificar.promo.php?id=".$_REQUEST['id']."'>";
	

?>  
