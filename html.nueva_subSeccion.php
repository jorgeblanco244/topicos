<?php
	
	/*--- LIBRERIAS Y CONEXIONES ---*/
	require_once("librerias-conexion.php");
	
	/*if(isset($_SESSION["logincl"])){header("location:index.php");}
	else{*/
    
  $id_seccion = $_POST['id'];

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>INGRESAR</title>
   <script language="javascript" src="js/jquery-1.11.1.js"></script>
    <meta charset="utf-8">
    <script type="text/javascript">

      window.onload = function () {

      document.form.titulo.focus();
      document.form.seccion.focus();
      document.form.addEventListener('submit', validarFormulario);

      }
        function validarFormulario(evObject) {

        evObject.preventDefault();

        var todoCorrecto = true;

        var formulario = document.form;

        for (var i=0; i<formulario.length; i++) {

           if (formulario[i].value == null || formulario[i].value.length == 0 || /^\s*$/.test(formulario[i].value)){

            alert(formulario[i].name+ ' no puede estar vacío o contener sólo espacios en blanco');

                todoCorrecto=false;

                      }

                }

if (todoCorrecto ==true) {formulario.submit();}

}
</script>
    <meta name="format-detection" content="telephone=no">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <?php require_once("css-javascript.php"); ?>
    <script language="javascript">
    //Cuando el documento termine de cargar
      $(document).ready(function(){
      //evento onChange para el select marca
      $("#seccion").change(function () {
        $("#seccion option:selected").each(function () {
          //recupero el valor del select marca  
           seccion_elegida=$(this).val();
           //si id es distinto de 0, guardo en elegido el valor anterior de marca guardado en invi
           //if(id != 0){departamento_elegido = $("#invi").val();}
           //post a modelos donde envio marca,instrumento y modelo
           $.post("proc.leer_subSeccion.php", { seccion_elegida: seccion_elegida }, function(data){
           //seteo en el select modelo lo que devuelve modelos.php
           $("#sub_secciones").html(data);    
   });
             
       });
  });
});
</script>
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
            <h4><u>INGRESO NUEVA SUB-SECCION</u></h4>
            <form name="form" method="post"  action="proc.guardo_subSeccion.php" class="mailform off2">
              
              <?php
                if ($id_seccion != "") { ?>
                   <center><table>
                    <tr><td>Secciones:<br>
                    <select name="seccion" id="seccion">
                       <?php
                        $seccion = new seccion();
                        $seccionesList = $seccion->traerSecciones();
                          while ($secciones = mysql_fetch_array($seccionesList)) {
                            if ($secciones['seccion_id'] == $id_seccion)
                            {
                              $SELE = "SELECTED";
                            } ELSE {
                              $SELE = " ";
                            }
                        echo ("<option value=\"$secciones[seccion_id]\"$SELE>$secciones[seccion_nombre]</option>");
                                }?>
                    </select></td></tr>
                    <?php  
                       } 
                       else{
                        ?>
                        <center><table>
                        <tr><td>Secciones:<br>
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
                            echo ("<option value=\"$secciones[seccion_id]\"$SELE>$secciones[seccion_nombre]</option>");
                                  }
                            ?>
                          </select></td></tr>
                          <?php } ?>
                      
                    <tr><td>Sub-secciones:<br>
                    <select name="sub_secciones" id="sub_secciones" ><option value="0">Vacio</option>
                    </select>
                    </td></tr>
                    <!--<input type="hidden" name="id" id="id" size="5" value="<?php echo $seccionId?>">-->
                    <tr>
                    <td>Titulo<br><input type="text" name="titulo" id="titulo" size="50"  maxlength="200"></td>
                    </tr>
                    </table></center>
                   <td><input type="submit" value="Guardar" class="btn" onClick=" "></td>
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