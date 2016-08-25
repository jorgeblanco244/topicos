<?php
	
	/*--- LIBRERIAS Y CONEXIONES ---*/
	require_once("librerias-conexion.php");
	
	/*if(isset($_SESSION["logincl"])){header("location:index.php");}
	else{*/
		$seccion = new seccion();
    $result= $seccion->traerSecciones();
      if (mysql_num_rows($result)>0) {
                $secciones = "";
                  while ($row=mysql_fetch_array($result)) {
                    $secciones .= "<option value='".$row['seccion_id']."'>".$row['seccion_nombre']."</option>";
                  }}
                  else {$secciones = "vacio";}
              
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>INGRESAR</title>
    <meta charset="utf-8">
     <script type="text/javascript">

      window.onload = function () {

      document.form.titulo.focus();
      //document.form.secciones.focus();
      document.form.addEventListener('submit', validarFormulario);

      }
        function validarFormulario(evObject) {

        evObject.preventDefault();

        var todoCorrecto = true;

        var formulario = document.form;

        for (var i=0; i<formulario.length; i++) {

                if(formulario[i].type =='text') {

                               if (formulario[i].value == null || formulario[i].value.length == 0 || /^\s*$/.test(formulario[i].value)){

                               alert (formulario[i].name+ ' no puede estar vacío o contener sólo espacios en blanco');

                               todoCorrecto=false;

                               }

                }

                }

if (todoCorrecto ==true) {formulario.submit();}

}
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
        <h4><u>INGRESO NUEVA SECCION</u></h4>
            <form name="form" method="post"  action="proc.html.guardo_seccion.php" class="mailform off2">
               <center><table>
                <tr><td>
                Secciones existentes <select name="secciones" id="secciones"><option value="">Seleccione</option>
                  <?php echo $secciones; ?>
                </select></td></tr>
                <tr>
                <td>Titulo<br><input type="text" name="titulo" id="titulo" size="50"  maxlength="200"></td>
                </tr>
                </table></center>
                <input type="submit" name="guardar" id="guardar" class="btn" value="Guardar" />
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