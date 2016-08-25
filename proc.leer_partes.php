<?php
		/*--- LIBRERIAS Y CONEXIONES ---*/
		require_once("librerias-conexion.php");
		
		$subsecSelec = $_POST['subsec_elegida'];
		$partes = "SELECT * from partes
		 			   WHERE partes_subsec_id=$subsecSelec";

		$result= mysql_query($partes);
		$totalFilas = mysql_num_rows($result);
			if ($totalFilas == 0) { echo "<option>Vacío</option>";}
		while ($row = mysql_fetch_array($result)) {
			if ($row['partes_id'] > 0)
			{
				$SELE = "SELECTED";
				} ELSE {
				$SELE = "vacio ";
			}
		echo ("<option value=\" $row[partes_id]\"$SELE>$row[partes_nombre]</option>");
	}
mysql_close($conn);