<?php
	
	/*--- LIBRERIAS Y CONEXIONES ---*/
	require_once("librerias-conexion.php");
	
	/*if(isset($_SESSION["logincl"])){header("location:index.php");}
	else{*/
		            $seccion=$_POST['seccion'];
                $titulo=$_POST['titulo'];
                
            
                $subSeccion = new subSeccion();
                $resultado = $subSeccion->nuevaSubSeccion($seccion,$titulo);

                $result = $subSeccion->traerSubSecciones();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>INGRESAR</title>
    <meta charset="utf-8">
    <!--<script language="JavaScript" type="text/javascript">
      alert("SELECCIONE UNA SUB-SECCION PARA AGREGAR UNA PARTE");
    </script>-->
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
            <div style="text-align:center;"><?php echo $resultado ?><br></div>
            <h6>LAS SUB-SECCIONES EXISTENTES SON:</h6><br>
             <div id="tituloTabla">
      
                  <table>
                  <tr><td width="30%"style="padding-right: 50px; padding-top: 38px; padding-left: 20px;" class="footable-first-column">
                  <strong><h5>Nombre</h5> </strong></td>
                  <td width="30%"style="padding-right: 50px; padding-top: 38px; padding-left: 20px;" class="footable-first-column">
                  <strong><h5>Nombre seccion </h5></strong></td>
                  <td width="30%"style="padding-right: 50px; padding-top: 38px; padding-left: 20px;" class="footable-first-column">
                  <strong><h5>Agregar nueva parte </h5></strong>
                  </td></tr>
                  </table>
              </div>
              <div id="contenedorTabla">
              <?php 
            while($row=mysql_fetch_array($result)){ 
                $id=$row['subsec_id'];
                $titulo=$row['subsec_nombre'];
                $seccionNombre = new subSeccion();
                        $resultNombre = $seccionNombre->traerSeccionNombre($id);
                        $rowNombre = mysql_fetch_array($resultNombre);
                        $seccion = $rowNombre['seccion_nombre'];
                      
              ?>
                
                  <form action="html.nueva_parte.php" method="POST" >
                   <table>
                   <input type="hidden" name="id" value="<?php echo $id; ?>">
                   <tr><td width="30%"style="padding-right: 55px; padding-top: 38px; padding-left: 20px;" class="footable-first-column">
                   <p><?php echo $titulo;?></p></td>
                   <td width="30%"style="padding-right: 55px; padding-top: 38px; padding-left: 20px;" class="footable-first-column">
                   <p><?php echo $seccion;?></p></td>
                   <td width="30%"style="padding-right: 55px; padding-top: 38px; padding-left: 20px;" class="footable-first-column">
                   <p><input type="submit" style="padding: 5px 3px;" name="nueva" value="Agregar" class="btn"></p></td></tr>
                   </table></form>
                  <?php    }    ?>
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