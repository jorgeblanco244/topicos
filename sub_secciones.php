<?php
		/*--- LIBRERIAS Y CONEXIONES ---*/
		require_once("librerias-conexion.php");

		$id_seccion = $_POST['BusquedaSubsec'];
		$mensaje = "";
		if (isset($id_seccion)) {
			$subSecciones = new subSeccion();
            $resultSubSec= $subSecciones-> leerSubsecConSeccion($id_seccion);
			
			$filas= mysql_num_rows($resultSubSec);
			//Si no existe ninguna fila que sea igual a $id_seccion, entonces mostramos el siguiente mensaje
				if ($filas === 0) {
				$mensaje = "<p>No hay ninguna Sub-Seccion en esa Seccion</p>";
				} else {
				//Si existe alguna fila que sea igual a $id_seccion, entonces mostramos el siguiente mensaje
				?>
				<h3>SUB-SECCIONES </h3>
                <?php                   
                      while($row=mysql_fetch_array($resultSubSec)){ 
                      $id=$row['subsec_id'];
                      $idSeccion = $rowId['subsec_seccion_id'];
                      $titulo=$row['subsec_nombre'];
                      $orden=$row['subsec_orden'];
                        
                        $seccionNombre = new subSeccion();
                        $resultNombre = $seccionNombre->traerSeccionNombre($id);
                        $rowNombre = mysql_fetch_array($resultNombre);
                        $seccion = $rowNombre['seccion_nombre'];

                        ?>
            <form action="html.actualizo_subSeccion.php" method="post" class="mailform off2">
              <table><tr>
              <input type="hidden" name="id" value="<?php echo $id ?>">
              <td width="30%" style="padding-right: 50px; padding-top: 38px; padding-left: 20px;" class="footable-first-column">
              <p><strong>Nombre: </strong> <?php echo $titulo ?></p>
              <p><strong>Orden:</strong> <?php echo $orden?></p>
              <p><strong>Nombre de Seccion: </strong><?php echo $seccion?></p></td>
              <input type="hidden" name="idSeccion" value="<?php echo $idSeccion?>">
              <td width="50%" style="padding-top: 0px;"><input type="submit" style="padding: 5px 3px; margin-top:0xp;" name="modificar" value="Modificar" class="btn">
              <input type="submit" style="padding: 5px 3px;" name="eliminar" value="Eliminar" class="btn" onclick="return confirm('Al eliminar: <?php echo $titulo?> tambien se eliminaran las partes que contiene');">
              </tr>
              </table>          
            </form><?php }
        					  
	}; //Fin else $filas

};//Fin isset $id_seccion

//Devolvemos el mensaje que tomará jQuery
echo $mensaje;
?>