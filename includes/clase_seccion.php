<?php
	class seccion{
	var $seccion_id;
	var $seccion_titulo;
	var $seccion_orden;
		
		function nuevaSeccion($seccion_titulo){ //DAR DE ALTA UNA SECCION 
			$query= "INSERT INTO secciones
					 (seccion_nombre,fecha_creacion,usuario_id_creacion,usuario_id_actualizacion)
					VALUES ('$seccion_titulo',now(),'1','1')";
		 
			if(!$Resultado=mysql_query($query)){
			return mysql_error()."Error al tratar de guardar";
				}
				else
				{return '"'.$seccion_titulo.'"  SE GUARDO CON EXITO';}
		}//fin funcion
		
		function modificarSeccion($seccion_id,$seccion_titulo,$seccion_orden){ //MODIFICAR UNA SECCION
			$query = "UPDATE secciones
				      SET	seccion_nombre='" . $seccion_titulo . "',
				      		seccion_orden='" . $seccion_orden . "'
				      WHERE
					  seccion_id = '$seccion_id' ";
			if(!$Resultado=mysql_query($query)){
			return mysql_error()."Error al tratar de guardar";
				}
				else
				{return 'SE GUARDARON LOS CAMBIOS';}	  					  
		}//fin funcion

		function eliminarSeccion($seccion_id){ // ELIMINA PRIMERO SUB-SECCION Y PARTE DE LA SECCION ELEGIDA Y LUEGO ELIMINA SECCION
			$queryParte = "DELETE FROM partes WHERE partes_seccion_id = '$seccion_id'";
			$resultParte = mysql_query($queryParte);

			$querySubSec = "DELETE FROM sub_secciones where subsec_seccion_id = '$seccion_id' ";
			$resultSubSec = mysql_query($querySubSec);

			$query = "DELETE FROM secciones where seccion_id = '$seccion_id' ";
			if(!$result=mysql_query($query)){
			return mysql_error()."Error al tratar de eliminar";
				}
				else
				{return 'SE ELIMINO CORRECTAMENTE';}
		}//fin funcion

		function traerSeccionesPorOrden(){ //LEER TODAS LAS SECCIONES
			$query = "SELECT * from secciones
					  ORDER BY seccion_orden";
    		$result = mysql_query($query);
			return $result;
			
			
		}//fin funcion

		function traerSecciones(){ //LEER TODAS LAS SECCIONES
			$query = "SELECT * from secciones
					  ORDER BY fecha_creacion DESC";
    		$result = mysql_query($query);
			return $result;
			
		}//fin funcion

		function seccionId($seccion_id){ //LEER LA SECCION QUE COINCIDA CON EL NUMERO ID
			$query = "SELECT * FROM secciones WHERE seccion_id = '$seccion_id'";
  			$result = mysql_query($query);
  			return $result;
  		}
  		function compararOrden($seccion_orden){ //VERIFICA CUANTOS NUMEROS DE ORDEN IGUALES EXISTEN
  			$query= "SELECT seccion_orden FROM secciones
                     WHERE  seccion_orden = '$seccion_orden'";
  			$resul=mysql_query($query);
  			$existe=mysql_num_rows($resul);
  			return $existe; 
  					
  		}
  		function darOrden($seccion_id,$seccion_orden){ //ASIGNA UN NUMERO DE ORDEN A LA SECCION
  			$query= "SELECT * FROM secciones
                     WHERE seccion_id != $seccion_id and seccion_orden = '$seccion_orden'";
  			$resul=mysql_query($query);
  			return $resul;
  		}	
  		
		
}
	
