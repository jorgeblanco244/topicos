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
          <?php
		if ( !empty($_GET["id"]) && is_array($_GET["id"]) ){
				$id=$_GET['id'];
			
			if ( !empty($_GET["titulo"]) && is_array($_GET["titulo"]) ){
				$titulo=$_GET['titulo'];
				
				if ( !empty($_GET["orden"]) && is_array($_GET["orden"]) ){
		
		    				foreach ( $_GET['orden'] as $key=>$ordenArray ) { 
					           
					  			    $subSeccion = new subSeccion();
									$seccion = $subSeccion->traerSeccionId($id[$key]);
									$row = mysql_fetch_array($seccion);
									$id_seccion = $row['subsec_seccion_id'];
									$resultado = $subSeccion -> modificarSubSeccion($id[$key],$id_seccion,$titulo[$key],$ordenArray);
					    			$resultado;
					    					
					    					}//cierre foreach
										}//cierre tercer if
									}//cierre segundo if
								}//cierre primer if
	      ?>						
			</div>
			<center><h5><?php 
			if (!empty($resultado)) {
				echo ("LAS MODIFICACIONES SE REALIZARON CON EXITO");
			}
			?></h5></center>
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