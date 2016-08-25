<?php
	
	/*--- LIBRERIAS Y CONEXIONES ---*/
	require_once("librerias-conexion.php");
	
  
  /*if(isset($_SESSION["logincl"])){header("location:index.php");}
	else{*/
		
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>INGRESAR</title>
     <script lenguage="javascript">
      
      function comprobar(){
        var nuevoOrden = document.form.orden;
        for ( var i = 0; i<nuevoOrden.length; i++) {
                 valor_i = nuevoOrden[i].value;
              if (valor_i==""){
                alert("Orden debe tener un numero entero")
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
  
    <meta charset="utf-8">
    <meta name="format-detection" content="telephone=no">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    
    <?php require_once("css-javascript.php"); ?>

  </head>
  <body>
    <div class="page">
      
	  <!-- CABECERA -->
	  <?php require_once("cabecera.php"); ?>
      <!-- /CABECERA -->
	  
	  <!--
      ========================================================
                                  CONTENT
      ========================================================
      -->
      <main>

		<section class="well1">
          <div class="container">

            <h2>SECCIONES</h2>
            <form name="form" method="get" action="proc.actualizoOrden_seccion.php" class="mailform off2" onsubmit="javascript:return comprobar()">     
              <div id="tituloTabla">
      
                  <table>
                  <tr><td width="30%"style="padding-right: 50px; padding-top: 38px; padding-left: 20px;" class="footable-first-column">
                  <p><strong>Nombre </strong></td>
                  <td width="30%"style="padding-right: 50px; padding-top: 38px; padding-left: 20px;" class="footable-first-column">
                  <strong>Orden </strong></p></td></tr>
                  </tr></table></div>
              <?php 
              $i=0;
              $secciones1 = new seccion();
              $result1= $secciones1->traerSecciones();
          while($row1=mysql_fetch_array($result1)){ 
            $id=$row1['seccion_id'];
            $titulo=$row1['seccion_nombre'];
            $orden1=$row1['seccion_orden'];
            $i++;
              //$subSeccion = new subSeccion();
              //$resultNombres = $subSeccion->nombreSubsec($id);?>
       
        <table>
            <input type="hidden" name="id[<?php echo $i;?>]" value="<?php echo $id; ?>">
            <tr><td width="30%"style="padding-right: 50px; padding-top: 38px; padding-left: 20px;" class="footable-first-column">
            <input type="hidden" name="titulo[<?php echo $i;?>]" value="<?php echo $titulo; ?>">
            <p><?php echo $titulo; ?></td>
            <td width="30%"style="padding-right: 50px; padding-top: 38px; padding-left: 20px;" class="footable-first-column">
            <input type="text" name="orden[<?php echo $i;?>]" id="orden" value="<?php echo $orden1;?>" size="3"></p></td></tr>
            
            </table><?php }?><br>
          <center><input type="submit" style="padding: 5px 3px;" name="actualizar" value="Dar orden" class="btn"></center>
          
        </form>
      </div>
        </section>

      </main>
      
	  <!-- PIE -->
	  <?php require_once("pie.php"); ?>
	  <!-- /PIE -->
	  
    </div>
    <script src="js/script.js"></script>
  </body>
</html>
<?php //} //Cierre Login ?>