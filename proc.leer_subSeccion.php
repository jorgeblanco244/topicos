<?php
		/*--- LIBRERIAS Y CONEXIONES ---*/
		require_once("librerias-conexion.php");
		
		$seccionSelec = $_POST['seccion_elegida'];
		$subseccion = "SELECT * from sub_secciones
		 			   WHERE subsec_seccion_id=$seccionSelec";

		$result= mysql_query($subseccion);
		$totalFilas = mysql_num_rows($result);
			if ($totalFilas == 0) { echo "<option>Vacío</option>";}
			else
				 { echo "<option>Seleccione</option>";}
		while ($row = mysql_fetch_array($result)) {
			if ($row['subsec_id'] == $row)
			{
				$SELE = "SELECTED";
				} ELSE {
				$SELE = " ";
			}
		echo ("<option value=\"$row[subsec_id]\"$SELE>$row[subsec_nombre]</option>");
		
	}
	                      
mysql_close($conn);
?>