<?php
		/*--- LIBRERIAS Y CONEXIONES ---*/
		require_once("librerias-conexion.php");
?>		
	<script lenguage="javascript">
      
      function comprobar(){
        var nuevoOrden = document.form.orden;
        for ( var i = 0; i<nuevoOrden.length; i++) {
                 valor_i = nuevoOrden[i].value;
              if (valor_i==""){
                alert("Orden debe tener un numero entero");
              return false;
             }
           }
                                 
          for ( var i =0; i<nuevoOrden.length ; i++){
             valor_i = nuevoOrden[i].value;
             
            
            for ( var j = 0; j<nuevoOrden.length; j++) {
                 valor_j = nuevoOrden[j].value;           
                  
                if(i!=j){            
                  
                  if (valor_i==valor_j) {
                   aux = 'si';
                    break;
                 }
                 else{
                  aux = 'no';
                 }//cierre else
            
               }//cierre primer if
            
             }//cierra for j
              if (aux == 'si'){
                  break;
                }
            }//cierra for i
                if (aux == 'si'){
                  alert("¡Los numeros de orden no deben repetirse!");
                  return false;
               }// cierre if
               else{
                  
                  return true;// envia ok el formulario
               }//cierre else
          }
  </script>
  <?php
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
				<form name="form" method="get" action="proc.actualizoOrden_subSeccion.php" class="mailform off2" onsubmit="javascript:return comprobar()">     
              	<div id="tituloTabla">
      
                  <table>
                  <tr><td width="30%"style="padding-right: 50px; padding-top: 38px; padding-left: 20px;" class="footable-first-column">
                  <p><strong>Nombre </strong></td>
                  <td width="30%"style="padding-right: 50px; padding-top: 38px; padding-left: 20px;" class="footable-first-column">
                  <strong>Orden </strong></p></td></tr>
                  </tr></table></div>
                 <?php

				//La variable $resultado contiene el array que se genera en la consulta, así que obtenemos los datos y los mostramos en un bucle
				$i=0;
                while($row=mysql_fetch_array($resultSubSec)){ 
                  $id=$row['subsec_id'];
                  $titulo=$row['subsec_nombre'];
                  $orden=$row['subsec_orden'];
                  $i++;?>
		            <table>
		            <input type="hidden" name="id[<?php echo $i;?>]" value="<?php echo $id; ?>">
		            <tr><td width="30%"style="padding-right: 50px; padding-top: 38px; padding-left: 20px;" class="footable-first-column">
		            <p><input type="hidden" name="titulo[<?php echo $i;?>]" value="<?php echo $titulo; ?>"> <?php echo $titulo ?></td>
		            <td width="30%"style="padding-right: 50px; padding-top: 38px; padding-left: 20px;" class="footable-first-column">
		            <input type="text" name="orden[<?php echo $i;?>]" id="orden" value="<?php echo $orden;?>" size="3"></p></td></tr>
		            </table><?php }?><br>
		            <center><input type="submit" style="padding: 5px 3px;" name="actualizar" value="Dar orden" class="btn"></center>
		          
        		</form>
        		<?php			  
	}; //Fin else $filas

};//Fin isset $id_seccion

//Devolvemos el mensaje que tomará jQuery
echo $mensaje;
?>