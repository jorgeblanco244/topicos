<?php
	
	/*--- LIBRERIAS Y CONEXIONES ---*/
	require_once("librerias-conexion.php");
	
  $id = $_POST['id'];

  $parte = new parte();
  $result = $parte->parteId($id);
  $row = mysql_fetch_array($result);
  //trae el nombre de la seccion a la cual pertenece esa parte
  $seccion_id = $row['partes_seccion_id'];
  $resulseccion = mysql_query("SELECT seccion_nombre FROM secciones WHERE seccion_id = '$seccion_id'");
  $seccion=mysql_fetch_assoc($resulseccion);
  //trae el nombre de la sub seccion a la que pertenece esa parte
  $subsec_id =$row['partes_subsec_id'];
  $resulsubsec=mysql_query("SELECT subsec_nombre FROM sub_secciones WHERE subsec_id='$subsec_id'");
  $subsec=mysql_fetch_assoc($resulsubsec);
  //trae el nombre del tipo que tiene
  $tipo_id =$row['partes_tipo_id'];
  $resultipo=mysql_query("SELECT partes_tipo_descripcion FROM partes_tipo WHERE partes_tipo_id='$tipo_id'");
  $tipo=mysql_fetch_assoc($resultipo);
  //muestro las partes de la bd para mostrar en el combobox
  $result2 = $parte->traerParte();
    if (mysql_num_rows($result2)>0) {
                $parte = "";
                  while ($row2=mysql_fetch_array($result2)) {

                    $parte .= "<option value='".$row2['partes_id']."'>".$row2['partes_nombre']."</option>";
                  }
              }
	/*if(isset($_SESSION["logincl"])){header("location:index.php");}
	else{*/
		
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>INGRESAR</title>
    <script type="text/javascript" src="ckeditor/ckeditor.js"></script>
    <script language="javascript" src="js/jquery-1.11.1.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript">
    function valida_envia(){
      
        titulo = document.getElementById('titulo');
        orden = document.getElementById('orden'); 
        
        //contenido = CKEDITOR.instances['contenido'].getData();
        // valido select seccion 
        if (document.form.seccion.value=="" || document.form.seccion.value==0){
           alert("Debe seleccionar la seccion a la que quiere que pertenezca")
           document.form.seccion.focus();
        }
        //valido select sub-seccion
        else if (document.form.sub_secciones.value=="" || document.form.sub_secciones.value==0){
           alert("Debe seleccionar la sub-seccion a la que quiere que pertenezca")
           document.form.sub_secciones.focus();
        }
        //valido el orden
        else if (orden.value==""){
          alert("orden debe contener un numero entero")
          
          orden.focus();
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
        //else if (contenido.value ==""){
          //  alert('El contenido no puede tener espacios en blanco o estar vacío');
            //contenido.focus();
          //}
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

  <!--JQUERY ELEGIR TIPO DE PARTE-->
    <script language="javascript" type="text/javascript">
            $(document).ready(function(){
               $(".caja").hide();
                $("#tipo").change(function(){
                  var id_tipo=$(this).val();
                   if(id_tipo == 1 || id_tipo == 2 || id_tipo == 6){
                      $(".caja").hide();
                      $(".caja2").hide();
                      $("#div_1").show();
                    }
                    else{
                      $(".caja").hide();
                      $(".caja2").hide();
                      $("#div_2").show();
                    
                    }
                });
            });
        </script>
<!-- JS. COMBOBOX DINAMICOS-->
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
<!-- jQuery ELIMINA ARCHIVO-->
<script src="http://code.jquery.com/jquery-1.11.0.min.js"> </script>
<script language="javascript">
    function eliminarImg(id){
      var parametros = {"id": id                        
                       };
          $.ajax({
              data: parametros,
              url: 'proc.eliminarImg.php',
              type: 'post',
              beforeSend: function () {
                        $("#resultado").html("Procesando, espere por favor...");
                },
                success:  function (response) {
                        $("#resultado").html(response);
                }
        });
}
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
            <!-- DEPENDIENDO DE QUE BOTON SELECCIONO VOY A MOSTRAR HTML MODIFICAR O HTML ELIMINAR-->
            
            <?php if ($_POST['modificar']){?>
              <h2>PARTE A MODIFICAR</h2>
                <form name="form" id="form" action="proc.modificar_parte.php" method="post" class="mailform off2" ENCTYPE="multipart/form-data">
                  <center><table>
                    <tr><td>Secciones:
                      <select name="seccion" id="seccion">
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
                                    }?>
                      </select></td></tr><br>
                    <tr><td>Sub-secciones:<br>
                      <select name="sub_secciones" id="sub_secciones" ><option value="<?php echo $subsec_id?>"><?php echo $subsec['subsec_nombre']?></option>
                        </select></td></tr>
                    <tr><td>Partes existentes 
                      <select name="partes">
                        <?php echo $parte; ?>
                      </select>
                      <input type="hidden" name="id" id="id" size="5" value="<?php echo $id;?>">
                    </td></tr>
                    <tr><td>
                      Orden:
                      <input type="text" name="orden" id="orden" size="3" value="<?php echo $row['partes_orden'];?>">
                    </td></tr>
                    <tr><td>Titulo: 
                      <input type="text" name="titulo" id="titulo" size="50"  maxlength="200" value="<?php echo $row['partes_nombre'];?>">
                    </td></tr>
                    <tr><td>
                      Tipo:<br><select name="tipo" id="tipo" >
                       <?php 
                            $resultTipo = mysql_query("SELECT * FROM partes_tipo ");
                              WHILE ($tipos =mysql_fetch_array ($resultTipo)){
                                  if ($tipos['partes_tipo_id'] == $row['partes_tipo_id'])
                                  {
                                    $SELE = "SELECTED";
                                    } ELSE {
                                      $SELE = " ";
                                    }
                              echo ("<option value=\"$tipos[partes_tipo_id]\"$SELE>$tipos[partes_tipo_descripcion]</option>");
                              }?>
                      </select></td></tr>
                    <tr><td>
                    <div id="div_3" class="caja2">
                        <?php if ($tipo_id== 1 || $tipo_id == 2 || $tipo_id == 6){?>
                            <textarea name="contenido" id="contenido"><?php echo $row['partes_contenido'];?></textarea>
                                <script type="text/javascript">
                                    var editor = CKEDITOR.replace( 'contenido',
                                    {
                                    // Defines a simpler toolbar to be used in this sample.
                                    // Note that we have added out "MyButton" button here.
                                    toolbar : [ [ 'Source', '-', 'Bold', 'Italic', 'Underline', 'Strike','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','Link', '-', 'MyButton' ] ]
                                   });
                                </script>
                        <?php }
                        else{
                            ?><div id="contenedorImg">
                            	<div id="resultado"><?php
                            $id = $row['partes_id'];
                            $imagen = $row['partes_contenido'];
                            if (empty($imagen)) {
                            	echo "Vacio";?><br>
                            		<input type="file" name="foto1" value="" >
                            <?php }
                            else{
                            	echo "<img src='partes/".$imagen."'/>";
                            
                          ?>
                          <input type="hidden" name="id" value="<?php echo $id;?>">
                                
                              <input type="button" href="javascript:;" onclick="eliminarImg($('#id').val());return false;" value="Eliminar"/>
                              <br/>
                             <?php }}?>
                          	</div>
                          </div>
                                            
                    </td></tr><br>
                    <tr><td>
                        <div id="div_1" class="caja">
                        <textarea name="contenido2" id="contenido2"></textarea>
                            <script type="text/javascript">
                                    var editor = CKEDITOR.replace( 'contenido2',
                                    {
                                    // Defines a simpler toolbar to be used in this sample.
                                    // Note that we have added out "MyButton" button here.
                                    toolbar : [ [ 'Source', '-', 'Bold', 'Italic', 'Underline', 'Strike','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','Link', '-', 'MyButton' ] ]
                                   });
                                </script>
                        </div>             
                        
                      <div id="div_2" class="caja">
                      <input type="file" name="foto" value="" >
                      </div></td></tr>
                  
                  </table></center>
                  <td><input type="button" value="Actualizar" id="boton" onclick ="javascript:valida_envia()"></td>
          </form>
                <!-- HTML ELIMINAR-->
                <?php } 
                  if ($_POST['eliminar']) {
                    $parte = new parte();
                    $result = $parte->eliminarParte($id);
                    ?><div style="text-align:center"><h5><?php echo $result;?><br>
                    <a href='html.buscar_parte.php'><font color='red'>Volver</font></a>
                  <?php } ?></h5>
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