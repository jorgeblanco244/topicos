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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
      <script language="javascript">
         $(document).ready(function() {
          $("#resultadoBusqueda").html('');
          $("#seccion").change(function () {
          $("#seccion option:selected").each(function () {
          //recupero el valor del select 
            BusquedaSubsec=$(this).val();
          
          if (BusquedaSubsec != "") {
          $.post("sub_secciones.php", {BusquedaSubsec: BusquedaSubsec}, function(mensaje) {
            $("#resultadoBusqueda").html(mensaje);
           }); 
          };
        });
        });
        });
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
              <h3>Elegir la seccion que contiene sub-secciones a buscar</h3>
               <select name="seccion" id="seccion"><option value="0">Seleccione</option>
                        <?php
                          $seccion = new seccion();
                          $seccionesList = $seccion->traerSecciones();
                            while ($secciones = mysql_fetch_array($seccionesList)) {
                              if ($secciones['seccion_id'] == $seccion_id)
                                {
                                  $SELE = "SELECTED";
                                } ELSE {
                                  $SELE = " ";
                                }
                            echo ("<option value=\"$secciones[seccion_id]\"$SELE>$secciones[seccion_nombre]</option>");
                                    }
              
  ?>
             </select> 
              <div id="resultadoBusqueda"></div>          
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