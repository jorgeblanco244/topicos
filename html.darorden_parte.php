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
    <script language="javascript" src="js/jquery-1.11.1.js"></script>
    <script language="javascript">
    //Cuando el documento termine de cargar
      $(document).ready(function(){
      //evento onChange para el select 
      $("#seccion").change(function () {
        $("#seccion option:selected").each(function () {
          //recupero el valor del select 
           seccion_elegida=$(this).val();
           
           $.post("proc.leer_subSeccion.php", { seccion_elegida: seccion_elegida }, function(data){
         
           $("#sub_secciones").html(data);    
   });
             
       });
  });
});
</script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
      <script language="javascript">
         $(document).ready(function() {
          $("#resultadoBusqueda").html('');
          $("#sub_secciones").change(function () {
          $("#sub_secciones option:selected").each(function () {
          //recupero el valor del select 
            BusquedaParte=$(this).val();
          
          if (BusquedaParte != "") {
          $.post("darorden_porParte.php", {BusquedaParte: BusquedaParte}, function(mensaje) {
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

            <h3>Elegir seccion y sub-seccion que contiene partes a ordenar</h3>
            <select name="seccion" id="seccion"><option value="0">Seleccione</option>
                        <?php
                          $seccion = new seccion();
                          $seccionesList = $seccion->traerSecciones();
                            while ($secciones = mysql_fetch_array($seccionesList)) {
                              if ($secciones['seccion_id'] == $secciones)
                                {
                                  $SELE = "SELECTED";
                                } ELSE {
                                  $SELE = " ";
                                }
                            echo ("<option value=\"$secciones[seccion_id]\"$SELE>$secciones[seccion_nombre]</option>");
                                    }
              
              ?>
             </select><br> 
              Sub-secciones:<br>
              <select name="sub_secciones" id="sub_secciones" ><option value="">Seleccione</option>
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