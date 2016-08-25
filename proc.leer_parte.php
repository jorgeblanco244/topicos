<?php
		/*--- LIBRERIAS Y CONEXIONES ---*/
		require_once("librerias-conexion.php");
		
		$subsecSelec = $_POST['subsec_elegida'];
		$partes = "SELECT * from partes
		 			   WHERE partes_subsec_id=$subsecSelec";

		$result= mysql_query($partes);
		
		while ($row = mysql_fetch_array($result)) {
			if ($row['partes_id'] == $lala['partes_id'])
			{
				$SELE = "SELECTED";
				} ELSE {
				$SELE = " ";
			}
		echo ("<option value=\" $row[partes_id]\"$SELE>$row[partes_nombre]</option>");
	}
mysql_close($conn);