<?php
	
	/*--- LIBRERIAS Y CONEXIONES ---*/
	require_once("librerias-conexion.php");

	$id = $_POST['id'];
	$parte = new parte();
	$resultParte = $parte->parteId($id);
	$rowParte = mysql_fetch_array($resultParte);
	$file = 'partes/'.$rowParte['partes_contenido'];
	
	
		$eliminar = new parte();
		$result = $eliminar->eliminarFile($id);  

		//SI SE ELIMINO DE LA BASE DE DATOS LO ELIMINO FISICAMENTE.
		if($result){
			unlink($file);	
		}
		echo "SE ELIMINO EL ARCHIVO";
?>

