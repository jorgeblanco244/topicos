<?php
	
	/*--- LIBRERIAS Y CONEXIONES ---*/
	require_once("librerias-conexion.php");
	
  $id = $_POST['id'];

  $subSeccion = new subSeccion();
  $result = $subSeccion->subSeccionId($id);
  $row = mysql_fetch_array($result);

  $seccion_id = $row['subsec_seccion_id'];
  $resulseccion = mysql_query("SELECT seccion_nombre FROM secciones WHERE seccion_id = '$seccion_id'");
  $sec=mysql_fetch_assoc($resulseccion);

  $result2 = $subSeccion->traerSubSecciones();
    if (mysql_num_rows($result2)>0) {
                $subsec = "";
                  while ($row2=mysql_fetch_array($result2)) {

                    $subsec .= "<option value='".$row2['subsec_id']."'>".$row2['subsec_nombre']."</option>";
                  }
              }
	/*if(isset($_SESSION["logincl"])){header("location:index.php");}
	else{*/
		
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>INGRESAR</title>
    
    <script type="text/javascript">
    function valida_envia(){
      
        titulo = document.getElementById('titulo');
        orden = document.getElementById('orden'); 
        
        if (document.form.seccion.value=="" || document.form.seccion.value==0){
           alert("Debe seleccionar la seccion a la que quiere que pertenezca")
           document.form.seccion.focus();
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
        
        else{
           // envia ok el formulario
            document.forms['form'].submit();
            }//cierre else
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
            <?php if ($_POST['modificar']){?>
              <h2>SUB-SECCION A MODIFICAR</h2>
                <form name="form" id="form" action="proc.modificar_subSeccion.php" method="post" class="mailform off2">
                <center><table>
                <fieldset>
                  <tr><td>
                    Sub-secciones existentes <select name="subSecciones">
                      <?php echo $subsec; ?>
                    </select>
                    <tr><td>Seccion a la que pertenece
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
                            echo ("<option value=\" $secciones[seccion_id]\"$SELE>$secciones[seccion_nombre]</option>");
                                    }?>
                     </td></tr>
                    <input type="hidden" name="id" id="id" size="5" value="<?php echo $id?>">
                    </td></tr>
                    <tr><td>Titulo: 
                    <input type="text" name="titulo" id="titulo" size="50"  maxlength="200" value="<?php echo $row['subsec_nombre']?>">
                    </td></tr>
                    <tr><td>Orden en el que va:
                    <input type="text" name="orden" id="orden" size="5" value="<?php echo $row['subsec_orden']?>">
                    </td></tr>          
                    </fieldset>
                  </table></center>
                  <input type="button" value="Actualizar" id="boton" onclick ="javascript:valida_envia()">
                  </form><?php } 
              if ($_POST['eliminar']) {
                $subsec = new subSeccion();
                $result = $subsec->eliminarSubSeccion($id);
                ?><div style="text-align:center"><h5><?php echo $result;?><br>
                <a href='html.modificar_subSeccion.php'><font color='red'>Volver</font></a></h5>
              <?php } ?>
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