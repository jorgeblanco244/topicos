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
            <h4><strong>ELIJA LA SECCION A LA QUE PERTENECERA</strong></h4>
                <?php 
                    $secciones = new seccion();
                    $result= $secciones->traerSecciones();
                      while($row=mysql_fetch_array($result)){ 
                      $id=$row['seccion_id'];
                      $titulo=$row['seccion_nombre'];
                      ?>
                  <form action="html.nueva_subSeccion.php" method="GET" class="mailform off2">
                  <p><?php echo"<a href='html.nueva_subSeccion.php?id=".$id."'>"?><?php echo $titulo.'<br><br></a>'?></p>
                  </form>
                <?php    }    ?>
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