<?php
	class parte{
	var $parte_id;
	var $parte_subsec_id;
	var $parte_seccion_id;
	var $parte_titulo;
	var $parte_tipo;
	var $parte_contenido;
	var $parte_orden;
		
		function nuevaParte($parte_subsec_id,$parte_seccion_id,$parte_tipo,$parte_titulo,$parte_contenido){
			$query= "INSERT INTO partes
			(partes_subsec_id,partes_seccion_id,partes_tipo_id,partes_nombre,partes_contenido,fecha_creacion)
			VALUES ('$parte_subsec_id','$parte_seccion_id','$parte_tipo','$parte_titulo','$parte_contenido',now())";
		 
			if(!$Resultado=mysql_query($query)){
			return mysql_error()."Error al tratar de guardar";
				}
				else
				{return '"'.$parte_titulo.'"  SE GUARDO CON EXITO';}
		}//fin funcion
		
		function modificarParte($parte_id,$parte_subsec_id,$parte_seccion_id,$parte_orden,$parte_titulo,$parte_tipo,$parte_contenido){
			$query = "UPDATE partes
				      SET	partes_subsec_id='" . $parte_subsec_id ."',
				      		partes_seccion_id='" .$parte_seccion_id ."',
				      		partes_orden='" .$parte_orden ."',
				      		partes_nombre='" . $parte_titulo . "',
				      		partes_tipo_id='" . $parte_tipo . "',
				      		partes_contenido='". $parte_contenido."'
				      WHERE
					  partes_id = '$parte_id' ";
			if(!$Resultado=mysql_query($query)){
			return mysql_error()."Error al tratar de guardar";
				}
				else
				{return '"'.$parte_titulo.'" SE MODIFICO CON EXITO';}		  					  
		}//fin funcion

		function eliminarParte($parte_id){
			$query = "DELETE FROM partes where partes_id = '$parte_id' ";
			if(!$result=mysql_query($query)){
			return mysql_error()."Error al tratar de eliminar";
				}
				else
				{return 'SE ELIMINO CORRECTAMENTE';}
		}//fin funcion

		function traerParte(){
			$query = "SELECT * from partes";
    		$result = mysql_query($query);
			return $result;
			
		}//fin funcion

		function parteId($parte_id){
			$query = "SELECT * FROM partes WHERE partes_id = '$parte_id'";
  			$result = mysql_query($query);
  			return $result;
  		}
		function leerParteConSubsec($parte_subsec_id){
  			$query = "SELECT * FROM partes
  					  WHERE partes_subsec_id = '$parte_subsec_id'
  					  ORDER BY partes_orden";
  			
  			$result = mysql_query($query);
  			return $result;
  		}
  		function compararOrden($parte_orden){
  			$query= "SELECT partes_orden FROM partes
                     WHERE partes_orden = '$parte_orden'";
  			$resul=mysql_query($query);
  			$contador=mysql_num_rows($resul);
  			return $contador; 
  					
  		}
  		
  		function eliminarFile($parte_id){
  			$query = "UPDATE partes
				      SET	partes_contenido=''
				      WHERE
					  partes_id = '$parte_id' ";
			if(!$Resultado=mysql_query($query)){
			return mysql_error()."Error ";
				}
				else
				{return true;}		  					  
		}//fin funcion
  		
}