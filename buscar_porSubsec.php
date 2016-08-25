<?php
		/*--- LIBRERIAS Y CONEXIONES ---*/
		require_once("librerias-conexion.php");
		
		$id_subsec = $_POST['BusquedaSubsec'];
		$mensaje = "";
		if (isset($id_subsec)) {
			$partes = "SELECT * from partes
		 			   WHERE partes_subsec_id=$id_subsec";

			$result= mysql_query($partes);
			$filas= mysql_num_rows($result);
			//Si no existe ninguna fila que sea igual a $id_seccion, entonces mostramos el siguiente mensaje
				if ($filas === 0) {
				$mensaje = "<p>No hay ninguna parte en esa sub-seccion</p>";
				} else {
				//Si existe alguna fila que sea igual a $id_seccion, entonces mostramos el siguiente mensaje
				echo '<strong>Resultados</strong>';

				//La variable $resultado contiene el array que se genera en la consulta, así que obtenemos los datos y los mostramos en un bucle
				while($row = mysql_fetch_array($result)) {
					$id = $row['partes_id'];
					$nombre = $row['partes_nombre'];
					$contenido = $row['partes_contenido'];

					$seccionNombre = new subSeccion();
                    $resultNombre = $seccionNombre->traerSeccionNombre($id_subsec);
                    ?>
			  <form action="html.actualizo_partes.php" method="post" class="mailform off2">
              <table><tr>
              <input type="hidden" name="id" value="<?php echo $id ?>">
              <td width="50%"><p><strong>Nombre de Parte: </strong><?php echo $nombre ?></p>
              <p><strong>Nombres de Seccion: </strong></p>
              <?php while ($rowNombres =mysql_fetch_array($resultNombre)) {
                    $seccion = $rowNombres['seccion_nombre'];?>
              <p><?php echo $seccion; } ?></p></td>
              <td width="30%" style="padding-top: 0px;"><input type="submit" style="padding: 5px 3px; margin-top:0xp;" name="modificar" value="Modificar" class="btn">
              <input type="submit" style="padding: 5px 3px;" name="eliminar" value="Eliminar" class="btn" onclick="return confirm('Desea eliminar: <?php echo $nombre?>');"></td>
              </tr></table>
            </form><?php
					//Output
					//$mensaje .= '
					//<p>
					//<strong>Nombre:</strong> ' . $nombre . '<br>
					//<strong>Contenido:</strong> ' . $contenido.'</p>';
			};//Fin while $resultados

	}; //Fin else $filas

};//Fin isset $id_seccion

//Devolvemos el mensaje que tomará jQuery
echo $mensaje;
?>