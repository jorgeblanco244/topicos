<?php
	
	/*--- LIBRERIAS Y CONEXIONES ---*/
	require_once("librerias-conexion.php");
	
  $secciones = new seccion();
  $result= $secciones->traerSecciones();
	
  /*if(isset($_SESSION["logincl"])){header("location:index.php");}
	else{*/
		
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>INGRESAR</title>
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
           
              <?php 
          while($row=mysql_fetch_array($result)){ 
            $id=$row['seccion_id'];
            $titulo=$row['seccion_nombre'];
              $subSeccion = new subSeccion();
              $resultNombres = $subSeccion->nombreSubsec($id);?>
      <form action="html.actualizo_seccion.php" method="post" class="mailform off2">
        <table><tr>
            <input type="hidden" name="id" value="<?php echo $id ?>">
            <td width="30%"style="padding-right: 50px; padding-top: 38px; padding-left: 20px;" class="footable-first-column">
              <p><strong>Nombre: </strong> <?php echo $titulo ?></p>
              <p><strong>Nombres de Sub-Seccion: </strong></p>
              <?php while ($rowNombres =mysql_fetch_array($resultNombres)) {
                  $nombre=$rowNombres['subsec_nombre'];?>
                  <p><?php echo $nombre?></p>
              <?php } ?></td>
            <td width="50%"style="padding-top: 0px;"><input type="submit" style="padding: 5px 3px; margin-top:0xp;"<input type="submit" name="modificar" value="Modificar" class="btn">
            <input type="submit" style="padding: 5px 3px;" name="eliminar" value="Eliminar" class="btn" onclick="return confirm('Al eliminar <?php echo $titulo?> tambien se eliminan sus SUB-SECCIONES');">
            </tr></table>
      </form><?php }
            if ($id =="") {?>
             <div style="text-align:center"><h5><font color='red'><?php echo "No existen secciones";?></font></h5>
            <?php }
            ?>
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