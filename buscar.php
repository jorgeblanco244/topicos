<?php
/*--- LIBRERIAS Y CONEXIONES ---*/
	require_once("librerias-conexion.php");

//Variable de búsqueda
$consultaBusqueda = $_POST['valorBusqueda'];

//Filtro anti-XSS
$caracteres_malos = array("<", ">", "\"", "'", "/", "<", ">", "'", "/");
$caracteres_buenos = array("& lt;", "& gt;", "& quot;", "& #x27;", "& #x2F;", "& #060;", "& #062;", "& #039;", "& #047;");
$consultaBusqueda = str_replace($caracteres_malos, $caracteres_buenos, $consultaBusqueda);

//Variable vacía (para evitar los E_NOTICE)
$mensaje = "";

//Comprueba si $consultaBusqueda está seteado
if (isset($consultaBusqueda)) {

	//Selecciona todo de la tabla mmv001 
	//donde el nombre sea igual a $consultaBusqueda, 
	//o el apellido sea igual a $consultaBusqueda, 
	//o $consultaBusqueda sea igual a nombre + (espacio) + apellido
	$consulta = mysql_query( "SELECT * FROM partes
	WHERE partes_nombre COLLATE UTF8_SPANISH_CI LIKE '%$consultaBusqueda%' 
	OR partes_contenido COLLATE UTF8_SPANISH_CI LIKE '%$consultaBusqueda%'
	OR CONCAT(partes_nombre,' ',partes_contenido) COLLATE UTF8_SPANISH_CI LIKE '%$consultaBusqueda%'
	");
	//Obtiene la cantidad de filas que hay en la consulta
	
	$filas = mysql_num_rows($consulta);

	//Si no existe ninguna fila que sea igual a $consultaBusqueda, entonces mostramos el siguiente mensaje
	if ($filas === 0) {
		$mensaje = "<p>No hay ninguna parte con ese nombre o contenido</p>";
	} else {
		//Si existe alguna fila que sea igual a $consultaBusqueda, entonces mostramos el siguiente mensaje
		echo 'Resultados para <strong>'.$consultaBusqueda.'</strong>';

		//La variable $resultado contiene el array que se genera en la consulta, así que obtenemos los datos y los mostramos en un bucle
		while($resultados = mysql_fetch_array($consulta)) {
			$id = $resultados['partes_id'];
			$nombre = $resultados['partes_nombre'];
			$contenido = $resultados['partes_contenido'];
			

			//Output
			?><form action="html.actualizo_partes.php" method="post">
              <table><tr>
              <input type="hidden" name="id" value="<?php echo $id ?>">
              <td width="50%"><?php echo $nombre ?></td>
              <td width="30%" style="padding-top: 0px;"><input type="submit" style="padding: 5px 3px; margin-top:0xp;" name="modificar" value="Modificar" class="btn">
              <input type="submit" style="padding: 5px 3px;" name="eliminar" value="Eliminar" class="btn" onclick="return confirm('Desea eliminar: <?php echo $nombre?>');"></td>
              </tr></table>
            </form><?php
		};//Fin while $resultados

	}; //Fin else $filas

};//Fin isset $consultaBusqueda

//Devolvemos el mensaje que tomará jQuery
echo $mensaje;
?>