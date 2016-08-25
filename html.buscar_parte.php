<?php
	
	/*--- LIBRERIAS Y CONEXIONES ---*/
	require_once("librerias-conexion.php");
	
  $parte = new parte();
  $result = $parte->traerParte();
	/*if(isset($_SESSION["logincl"])){header("location:index.php");}
	else{*/
		
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>INGRESAR</title>
    <meta charset="utf-8">
    <script language="javascript" src="js/jquery-1.11.1.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
      <script>
        $(document).ready(function() {
            $("#resultadoBusqueda").html('');
        });

        function buscar() {
        var textoBusqueda = $("input#busqueda").val();
          
          if (textoBusqueda != "") {
          $.post("buscar.php", {valorBusqueda: textoBusqueda}, function(mensaje) {
            $("#resultadoBusqueda").html(mensaje);
           }); 
            } else { 
                $("#resultadoBusqueda").html('');
            };
          };
      </script>

    <script language="javascript">
    //Cuando el documento termine de cargar
      $(document).ready(function(){
      //evento onChange para el select 
      $("#seccion").change(function () {
        $("#seccion option:selected").each(function () {
          //recupero el valor del select  
           seccion_elegida=$(this).val();
           
           $.post("proc.leer_subSeccion.php", { seccion_elegida: seccion_elegida }, function(data){
          
           $("#subseccion").html(data);    
   });
             
       });
  });
});
</script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
      <script language="javascript">
         $(document).ready(function() {
          $("#resultadoBusqueda").html('');
          $("#subseccion").change(function () {
          $("#subseccion option:selected").each(function () {
          //recupero el valor del select 
            BusquedaSubsec=$(this).val();
          
          if (BusquedaSubsec != "") {
          $.post("buscar_porSubsec.php", {BusquedaSubsec: BusquedaSubsec}, function(mensaje) {
            $("#resultadoBusqueda").html(mensaje);
           }); 
          };
        });
        });
        });
       </script>  
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
          <h2>PARTES</h2>
          
            <form accept-charset="utf-8" method="POST">
              <p>Buscar</p>
              <input type="text" name="busqueda" id="busqueda" value="" placeholder="" maxlength="30" autocomplete="off" onKeyUp="buscar();" />
              </form>
              <p>Buscar por Seccion:<br>
              <select name="seccion" id="seccion"><option value="">Seleccione</option>
                <?php
                  $seccion = new seccion();
                  $seccionesList = $seccion->traerSecciones();
                    while ($secciones = mysql_fetch_array($seccionesList)) {
                      if ($secciones['seccion_id'] == $titulo['seccion_id'])
                        {
                          $SELE = "SELECTED";
                        } ELSE {
                          $SELE = " ";
                        }
                    echo ("<option value=\" $secciones[seccion_id]\"$SELE>$secciones[seccion_nombre]</option>");
                            }?>
              </select></td></tr>
              <form accept-charset="utf-8" method="post">
              <p>Buscar por Sub-seccion:<br>
                <select name="subseccion" id="subseccion" ><option value="">Seleccione</option>
                </select>
              </p></form>
            <div id="resultadoBusqueda"></div>                
              <!-- 
                <?php 
                      while($row=mysql_fetch_array($result)){ 
                      $id=$row['partes_id'];
                      $titulo=$row['partes_nombre'];
                      ?> 
            <form action="html.actualizo_partes.php" method="post" class="mailform off2">
              <table><tr>
              <input type="hidden" name="id" value="<?php echo $id ?>">
              <td style="padding-right: 0px; padding-top: 38px; padding-left: 20px;" class="footable-first-column"><?php echo $titulo ?></td>
              <td style="padding-top: 0px;"><input type="submit" style="padding: 5px 3px; margin-top:0xp;" name="modificar" value="Modificar" class="btn">
              <input type="submit" style="padding: 5px 3px;" name="eliminar" value="Eliminar" class="btn" onclick="return confirm('Desea eliminar: <?php echo $titulo?>');"></td>
              </tr></table>
            </form><?php }?> -->
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