
<?php
	
	/*--- LIBRERIAS Y CONEXIONES ---*/
	require_once("librerias-conexion.php");
	
	/*if(isset($_SESSION["logincl"])){header("location:index.php");}
	else{*/

 $id_subsec = $_POST['id'];

 $subsec = new subSeccion();
 $resultSubsec = $subsec->subSeccionId($id_subsec);
 $subseccion = mysql_fetch_array($resultSubsec);
 $nombresubsec = $subseccion['subsec_nombre'];
 $id_seccion = $subseccion['subsec_seccion_id'];


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>INGRESAR</title>
    <meta charset="utf-8">
    <meta name="format-detection" content="telephone=no">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">

    <script type="text/javascript" src="ckeditor/ckeditor.js"></script>
    <script language="javascript" src="js/jquery-1.11.1.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
    <script language="javascript" type="text/javascript">
            $(document).ready(function(){
                $(".caja").hide();
                $("#tipo").change(function(){
                  var id_tipo=$(this).val();
                   if(id_tipo == 1 || id_tipo == 2 || id_tipo == 6){
                      $(".caja").hide();
                      $("#div_1").show();
                    }
                    else{
                      $(".caja").hide();
                      $("#div_2").show();
                    
                    }
                });
            });
        </script>
    
   <?php require_once("css-javascript.php"); ?>
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
    <?php require_once("css-javascript.php"); ?>
    <script language="javascript">
    //Cuando el documento termine de cargar
      $(document).ready(function(){
      
      $("#sub_secciones").change(function () {
        $("#sub_secciones option:selected").each(function () {
          //recupero el valor del select 
           subsec_elegida=$(this).val();
           
           $.post("proc.leer_partes.php", { subsec_elegida: subsec_elegida }, function(data){
           
           $("#partes").html(data);    
   });
             
       });
  });
});
</script>  
<script type="text/javascript">
    function valida_envia(){
      
        titulo = document.getElementById('titulo'); 
        contenido = CKEDITOR.instances['contenido'].getData();
        // valido select seccion 
        if (document.form.seccion.value=="" || document.form.seccion.value==0){
           alert("Debe seleccionar la seccion a la que quiere que pertenezca")
           document.form.seccion.focus();
        }
        //valido select sub-seccion
        else if (document.form.sub_secciones.value=="" ||document.form.sub_secciones.value==0){
           alert("Debe seleccionar la sub-seccion a la que quiere que pertenezca")
           document.form.sub_secciones.focus();
        }
        //valido el titulo
        else if (titulo.value==""){
           alert("titulo no puede contener estapacios en blanco o estar vacio")
           titulo.focus();
        }
        //valido select tipo
        else if (document.form.tipo.value==""||document.form.tipo.value==0){
           alert("Debe seleccionar el tipo de parte")
           document.form.tipo.focus();
        }
        //validar dependiendo de lo que selecciona en el combo de tipo
        else if (contenido.value ==""){
            alert('El contenido no puede tener espacios en blanco o estar vacío');
            contenido.focus();
          }
        else{
           // envia ok el formulario
            document.forms['form'].submit();
            }//cierre else
          }
  </script>
        <script type="text/javascript">
     window.onchange = function(elEvento) {
        var evento = elEvento || window.event;
        var elemento = evento.srcElement ?  evento.srcElement : evento.target;
        var idele = document.getElementById('file'); //div que contiene a una fila
        var re_text = /\.jpg|\.JPG|\.gif|\.GIF|\.png|\.PNG/i;
  
  
        if(elemento.type == 'file')
          {
          if (elemento.value.search(re_text) == -1){
            alert("Error! en el archivo. Compatible solo con archivos JPG, GIF o PNG.");
              idele.innerHTML = "<input name=" + elemento.name + " type=file id=" + elemento.id + " /><input name='epigrafe[]'  id='epigrafe' type='text' size=60 /><input name='opcFd[]' type='hidden' id='opcFd' value='no'/>&nbsp;<a href='#ancla' name='"+ idele.id +"'";
              return false;
          }
          else{
            var opcion = document.getElementById('opcFd');
            opcion.value = "si";
          }
        }
      }

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
            <h4><u>INGRESO NUEVA PARTE</u></h4>
            <form name="form" method="post"  action="proc.guardo_parte.php" class="mailform off2" ENCTYPE="multipart/form-data" >
              
              <?php
                if ($id_subsec != "") { ?>
                   
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
                    <tr><td>Sub-secciones:<br>
                      <select name="sub_secciones" id="sub_secciones" ><option value="<?php echo $id_subsec?>"><?php echo $nombresubsec;?></option>
                      </select>
                    </td></tr> 
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
                                  }?>
                      </select></td></tr>
                      <tr><td>Sub-secciones:<br>
                      <select name="sub_secciones" id="sub_secciones" ><option value="">Vacio</option>
                      </select>
                      </td></tr>
                      <?php 
                          }
                      ?>
                  <tr><td>Partes:<br>
                  <select name="partes" id="partes" ><option value="">Vacio</option>
                  </select></td></tr>
                  <!-- <input type="hidden" name="id" id="id" size="5" value="<?php echo $subSecId?>"> -->
                  <tr><td>
                  Titulo<br><input type="text" name="titulo" id="titulo" size="50"  maxlength="200">
                  </td></tr>
                  <tr><td>
                  Tipo:<br><select name="tipo" id="tipo" ><option value="">Vacio</option>
                    <?php 
                    $resultTipo = mysql_query("SELECT * FROM partes_tipo ");
                    WHILE ($tipos =mysql_fetch_array ($resultTipo)){
                    if ($tipos['partes_tipo_id'] == $parte['partes_tipo_id'])
                      {
                          $SELE = "SELECTED";
                          } ELSE {
                            $SELE = " ";
                          }
                          echo ("<option value=\"$tipos[partes_tipo_id]\"$SELE>$tipos[partes_tipo_descripcion]</option>");
                      }?>
                  </select></td></tr>
                  <tr><td>
                  <div id="div_1" class="caja">
                  <textarea name="contenido" id="contenido" ></textarea>
                      <script type="text/javascript">
                      var editor = CKEDITOR.replace( 'contenido',
                      {
                      // Defines a simpler toolbar to be used in this sample.
                      // Note that we have added out "MyButton" button here.
                      toolbar : [ [ 'Source', '-', 'Bold', 'Italic', 'Underline', 'Strike','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','Link', '-', 'MyButton' ] ]
                     });
                      </script>
                      </div>             
                         
                      <div id="div_2" class="caja">
                      <input type="file" name="foto" value="" >
                      </div>
                      
                  </td></tr>
               
            </table></center>
                          
           <td><input type="button" value="Guardar" id="boton" onclick ="javascript:valida_envia()"></td>
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