<?php
	
	/*--- LIBRERIAS Y CONEXIONES ---*/
	require_once("librerias-conexion.php");
	
	/*if(isset($_SESSION["logincl"])){header("location:index.php");}
	else{*/
    $titulo=$_POST['titulo'];
        
      $seccion = new seccion();
      $resultado = $seccion->nuevaSeccion($titulo);//fin del inset a la tabla seccion
           //comienzo a leer secciones para operar     
      $secciones = new seccion();
      $result= $secciones->traerSecciones();
      		
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>INGRESAR</title>
    <meta charset="utf-8">
    <!--<script language="JavaScript" type="text/javascript">
      alert("SELECCIONE UNA SECCION PARA AGREGAR UNA SUB-SECCION");
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
             <div style="text-align:center;"><?php  echo $resultado; ?></div>
             <h6>LAS SECCIONES EXISTENTES SON:</h6>
             <div id="tituloTabla">
      
                  <table>
                  <tr><td width="30%"style="padding-right: 50px; padding-top: 38px; padding-left: 20px;" class="footable-first-column">
                  <p><strong><h5>Nombre </h5></strong></td>
                  <td width="30%"style="padding-right: 50px; padding-top: 38px; padding-left: 20px;" class="footable-first-column">
                  <strong><h5>Nombres de sub-seccion</h5> </strong></p></td>
                  <td width="30%"style="padding-right: 50px; padding-top: 38px; padding-left: 20px;" class="footable-first-column">
                  <strong><h5>Agregar sub-seccion</h5> </strong></p>
                  </td></tr></table></div>
              <div id="contenedorTabla">
              <form action="html.nueva_subSeccion.php" method="post" class="mailform off2">
            <?php 
            while($row=mysql_fetch_array($result)){ 
                $id=$row['seccion_id'];
                $titulo=$row['seccion_nombre'];
                $subSeccion = new subSeccion();
                $resultNombres = $subSeccion->nombreSubsec($id);
              ?>
                    <form name="formulario" action="html.nueva_subSeccion.php" method="post">
                    <table>
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <tr><td width="30%"style="padding-right: 50px; padding-top: 38px; padding-left: 20px;" class="footable-first-column">
                    <p><?php echo $titulo;?></p></td>
                    <td width="30%"style="padding-right: 50px; padding-top: 38px; padding-left: 20px;" class="footable-first-column">
                    <p><?php while ($rowNombres =mysql_fetch_array($resultNombres)) {
                         $nombre=$rowNombres['subsec_nombre'];?>
                    <?php echo $nombre;?></p>
                    <?php } ?>
                    <td width="30%"style="padding-right: 50px; padding-top: 38px; padding-left: 20px;" class="footable-first-column">
                    <p><input type="submit" style="padding: 5px 3px;" name="nueva" value="Agregar" class="btn">
                    </p></td></tr></table></form>
                  <?php    }    ?>
                  </div>
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