<?php
	/* LIBRERIAS */   
	require_once("includes/class.db.php");
	require_once("conf/conf.php");
	require_once("includes/class.promociones.php");
	require_once("includes/common.lib.php");
	require_once("includes/class.archivos.php");
  
	if(!empty($_POST['titulo']) && !empty($_POST['descripcion']) && !empty($_POST['fecha_desde'])   && !empty($_POST['fecha_hasta'])){
     
		$db = new DataBase($conf_mysql_host,$conf_mysql_user,$conf_mysql_password,$conf_mysql_db); //Creo un objeto de base de datos;   
		//$db->Connect();//Conecto a la base de datos; 

		/* CODIFICA CARATERES ESPECIALES EN HTML */
		$titulo = html_chars(urldecode($_POST['titulo']));
	 
		/*trim: Elimina espacio en blanco (u otro tipo de caracteres) del inicio y el final de la cadena
		strip_tags: intenta devolver un string con todos los bytes NUL y las etiquetas HTML y PHP retirados de un str dado. */
		$titulo = trim(strip_tags($titulo,"<p><br><br /><strong><a><i><u>"));
		$descripcion = htmlentities(addslashes(trim(strip_tags($_POST['descripcion'],"<p><br><br /><strong><a><i><u>"))));		
		 
		 /* SETEO LAS FECHAS AL FORMATO SQL */
		 /* VIGENCIA DE LA PROMO */
		 $fecha_desde = substr($_POST['fecha_desde'], 6, 4) . "-" . substr($_POST['fecha_desde'], 3, 2) . "-" . substr($_POST['fecha_desde'], 0, 2);
		 $fecha_hasta = substr($_POST['fecha_hasta'], 6, 4) . "-" . substr($_POST['fecha_hasta'], 3, 2) . "-" . substr($_POST['fecha_hasta'], 0, 2);
		 
		 /* VIGENCIA PARA MOSTRAR GANADORES */
		 $fchdes_ganador = substr($_POST['fchdes_ganador'], 6, 4) . "-" . substr($_POST['fchdes_ganador'], 3, 2) . "-" . substr($_POST['fchdes_ganador'], 0, 2);
		 $fchhas_ganador = substr($_POST['fchhas_ganador'], 6, 4) . "-" . substr($_POST['fchhas_ganador'], 3, 2) . "-" . substr($_POST['fchhas_ganador'], 0, 2);
		 		 
		//VERIFICO SI SE ADJUNTARON ARCHIVO O IMAGENES
		if (isset($_POST["opcFd"])) {
			//RECORRO EL ARREGLO QUE CONTIENE LOS ARCHIVOS (EN CASO DE SER MAS DE UNO)
			$opc = $_POST["opcFd"];
			foreach ($_FILES["archivos"]["error"] as $key => $error) {
				if($opc[$key] == "si"){ $opcFd = "si"; }
				else{ $opcFd = "no"; }	
			}
		}else{ $opcFd = "no"; }	

		$promo = new promociones(); //CREO UNA INSTANCIA DE LA CLASE PROMOCIONES
		
		//LLAMO AL METODO QUE AGREGA LA PROMO EN LA TABLA PROMOCIONES
		$promo->agregar_promo($_SESSION["login"], $titulo, $descripcion, $opcFd, $fecha_desde, $fecha_hasta, $fchdes_ganador, $fchhas_ganador, $db);

		//ALMACENO EL ID DEL EVENTO CREADO PARA ASOCIARLO CON LA IMAGEN O ARCHIVO CARGADO
		$_SESSION['last_news_id'] = $db->insert_id;
		 
		//LLAMO A LA FUNCIÓN QUE SE ENCARGA DE CARGAR LA IMAGEN DE LA NOTICIA
		if($opcFd == "si"){
			nuevo_archivo($conf_up_img_promo_dir,
						$conf_upload_img_with,
						$conf_upload_img_height,
						$conf_upload_img_thumb_with,
						$conf_upload_img_thumb_height,
						$db); 
		}
	 
	 
		echo "<div>La promoci&oacute;n fue creada con exito.</div>";	
		//$db->Close();
		
	}else{
		echo "<div>Error en el envio de datos.</div>";
	}

  
  
	function nuevo_archivo($conf_up_img_promo_dir,$conf_upload_img_with,$conf_upload_img_height,$conf_upload_img_thumb_with,$conf_upload_img_thumb_height,$db){
		
		$epigrafe = $_POST['epigrafe'];
		
		if (isset($_FILES["archivos"])) {
			
			//RECORRO EL ARREGLO QUE CONTIENE LOS ARCHIVOS (EN CASO DE SER MAS DE UNO)
			foreach ($_FILES["archivos"]["error"] as $key => $error) {
				if ($error == UPLOAD_ERR_OK) { //ESTA VARIABLE ESPECIAL ME INDICA QUE NO HUBO ERROR DE SUBIDA
					
					$ext = findexts($_FILES['archivos']['name'][$key]);
					//$epi = htmlspecialchars(trim($epigrafe[$key]));
					$epi = html_chars(urldecode($epigrafe[$key]));
					$epi = trim(strip_tags($epi,"<p><br><br /><strong><a><i><u>"));
					
					
					/* SI ES UNA IMAGEN GENERO LOS THUMBS Y LAS SUBO A LA CARPETA DE IMAGENES */
					if(	($ext == "jpg") || ($ext == "JPG") || ($ext == "gif") || ($ext == "GIF") || ($ext == "png") || ($ext == "PNG")){
					
					// genero el path absoluto al directorio de upload
					//$uploaddir = $_SERVER['DOCUMENT_ROOT'] ."/complot/dossier". $conf_up_img_promo_dir; 
					$uploaddir = ".." . $conf_up_img_promo_dir;   
					
					/* CHEQUEO LA EXISTENCIA DE UN ARHIVO CON EL MISMO NOMBRE */
					  $name_ok = true;
					  while($name_ok == true){
						$img_new_name = date("Ymd") . rand(1000,9999) . "."  . findexts($_FILES['archivos']['name'][$key]);
						$uploadfile = $uploaddir . "/" . $img_new_name;
						$img_new_name_check = file_exists($uploadfile);
						if(!$img_new_name_check){
						  $name_ok = false;
						}
					  }
					 
					  /* COPIO EL ARCHIVO ORIGINAL A LA CAPERTA DE UPLOAD's */
					  move_uploaded_file($_FILES['archivos']['tmp_name'][$key], $uploadfile);
					  
					  /* AGREGO LA IMAGEN A LA TABLA DE ARCHIVOS DE CMS */
					  $archivo = new archivo();
					  $archivo->agregar_archivo($_SESSION['last_news_id'],$_SESSION['login'],1,$img_new_name,$ext,$epi,"p",$db);
					}
				} //if error
			} //for each	
		} //if isset	
	}//function nueva_archivo()

?>
