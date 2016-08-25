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
					       	
					  			    $parte = new parte();
									$resultado = $parte->parteId($id[$key]);
  									$row = mysql_fetch_array($resultado);
  									$parte_subsec_id = $row['partes_subsec_id'];
  									$parte_seccion_id = $row['partes_seccion_id'];
  									$parte_tipo = $row['partes_tipo_id'];
  									$parte_contenido = $row['partes_contenido'];	
									$resultado2 = $parte -> modificarParte($id[$key],$parte_subsec_id,$parte_seccion_id,$ordenArray,$titulo[$key],$parte_tipo,$parte_contenido);
					    			 $resultado2;
					    				
										}//cierre foreach
									}//cierre tercer if 
								}//cierre segundo if
							}//cierre primer if
	    ?>
	    </div>
			<center><h5><?php 
			if (!empty($resultado2)){
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