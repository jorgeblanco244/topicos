<?php
	class subSeccion{
	var $subSec_id;
	var $subSec_seccion_id;
	var $subSec_titulo;
	var $subSec_orden;
	
		 
		function nuevaSubSeccion($subSec_seccion_id,$subSec_titulo){ //DAR DE ALTA UNA SUB-SECCION
			$query= "INSERT INTO sub_secciones
					 (subsec_seccion_id,subsec_nombre,fecha_creacion,usuario_id_creacion,usuario_id_actualizacion)
					VALUES ('$subSec_seccion_id','$subSec_titulo',now(),'1','1')";
		 
			if(!$Resultado=mysql_query($query)){
			return mysql_error()."Error al tratar de guardar";
				}
				else
				{return '"'.$subSec_titulo.'"  SE GUARDO CON EXITO';}
		}//fin funcion
		
		function modificarSubSeccion($subSec_id,$subSec_seccion_id,$subSec_titulo,$subSec_orden){ //MODIFICA UNA SUB-SECCION
			$query = "UPDATE sub_secciones
				      SET	subsec_nombre = '" . $subSec_titulo . "',
							subsec_orden = '" . $subSec_orden  . "',
							subsec_seccion_id = '". $subSec_seccion_id. "'
					  WHERE
					  subsec_id = '$subSec_id' ";
							if(!$Resultado=mysql_query($query)){
								return mysql_error()."Error al tratar de guardar";
								}
							else
						    {return '"'.$subSec_titulo.'" SE MODIFICO CON EXITO';}
		}//fin funcion

		function eliminarSubSeccion($subSec_id){ 
			//ELIMINO PRIMERAMENTE LAS PARTES QUE CONTIENE.
			$queryParte = "DELETE FROM partes where partes_subsec_id = '$subSec_id' ";
			$resultParte = mysql_query($queryParte);
			//ELIMINO LA SUB-SECCION.
			$query = "DELETE FROM sub_secciones where subsec_id = '$subSec_id' ";
			if(!$result=mysql_query($query)){
			return mysql_error()."Error al tratar de eliminar";
				}
				else
				{return 'SE ELIMINO CON EXITO';}
		}//fin funcion

		function traerSubSecciones(){ // LEER SUB-SECCIONES
			$query = "SELECT * from sub_secciones
					  ORDER BY fecha_creacion DESC";
    		$result = mysql_query($query);
			return $result;
			
		}//fin funcion

		function subSeccionId($subSec_id){ //LEER LA SUB-SECCION CORRESPONDIENTE AL NUMERO ID ELEGIDO
			$query = "SELECT * FROM sub_secciones WHERE subsec_id = '$subSec_id'";
  			$result = mysql_query($query);
  			return $result;
  		}	

  		function traerSeccionId($subSec_id){ //LEE ID DE SECCION PADRE DE UNA DETERMINADA SUB-SECCION
  			$query = "SELECT subsec_seccion_id FROM sub_secciones
  				      WHERE subsec_id = '$subSec_id'";
  			$result = mysql_query($query);
  			return $result;
  		}		
  		function leerSubsecConSeccion($subSec_seccion_id){ //LEER SUB-SECCIONES QUE PERTENEZCAN A UNA DETERMINADA SECCION
  			$query = "SELECT * FROM sub_secciones
  					  WHERE subsec_seccion_id = '$subSec_seccion_id'
  					  ORDER BY subsec_orden";
  			
  			$result = mysql_query($query);
  			return $result;
  		}

  		function darOrden($subSec_orden){ //ASIGNA UN NUMERO DE ORDEN A CADA SUB-SECCION
  			$query= "SELECT * FROM sub_secciones
                     WHERE subsec_orden = '$subSec_orden'";
  			$resul=mysql_query($query);
  			return $resul;
  		}	 

  		function traerSeccionNombre($subSec_id){ //LEE EL NOMBRE DE SECCION PADRE DE LA SUB-SECCION
  			$query = "SELECT subsec_id, subsec_nombre, seccion_nombre
						FROM sub_secciones
						INNER JOIN secciones ON subsec_seccion_id = seccion_id
						WHERE subsec_id = '$subSec_id'";
			$result = mysql_query($query);
			return $result;
  		}     
  		function nombreSubsec($subSec_seccion_id){ //LEER NOMBRE DE LA SUB-SECCION
  			$query = "SELECT subsec_nombre FROM sub_secciones
  						WHERE subsec_seccion_id = '$subSec_seccion_id'";
  			$result = mysql_query($query);
  			return $result;
  		}
  		function compararOrden($subSec_id,$subSec_orden){ //VERIFICA CUANTOS NUMEROS DE ORDEN IGUALES EXISTEN
  			$query= "SELECT subsec_orden FROM sub_secciones
                     WHERE subsec_id != $subSec_id and subsec_orden = '$subSec_orden'";
  			$resul=mysql_query($query);
  			$contador=mysql_num_rows($resul);
  			return $contador; 
  					
  		}
}
?>
