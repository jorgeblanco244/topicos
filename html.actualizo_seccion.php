<?php
	
	/*--- LIBRERIAS Y CONEXIONES ---*/
	require_once("librerias-conexion.php");
	
	/*if(isset($_SESSION["logincl"])){header("location:index.php");}
	else{*/
	$id = $_POST['id'];
  
  $seccion = new seccion();
  $result = $seccion->seccionId($id);
  $row = mysql_fetch_array($result);
  
  $result2 = $seccion->traerSecciones();
    if (mysql_num_rows($result2)>0) {
                $secciones = "";
                  while ($row2=mysql_fetch_array($result2)) {

                    $secciones .= "<option value='".$row2['seccion_id']."'>".$row2['seccion_nombre']."</option>";
                  }
              }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>INGRESAR</title>
    <script type="text/javascript">
    function valida_envia(){
      
        titulo = document.getElementById('titulo'); 
        orden = document.getElementById('orden');
        // valido select seccion 
        if (orden.value==""){
           alert("Orden debe tener un numero entero")
           orden.focus();
        }
        //valido titulo
        else if 
           (titulo.value==""){
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
          <!-- DEPENDE DE QUE BOTON ELIJO SE MUESTRA HTML MODIFICAR O HMTL ELIMINAR-->
            <?php if ($_POST['modificar']) {?>  
              <h3>SECCION A MODIFICAR</h3>
                <form name="form" id="form" action="proc.modificar_seccion.php" method="post" class="mailform off2">
                  <center><table>
                      <tr><td>
                        Secciones existentes <select name="secciones">
                            <?php echo $secciones; ?>
                          </select>
                        <input type="hidden" name="id" id="id" size="5" value="<?php echo $id?>">
                        </td></tr>
                        <tr><td>Titulo: 
                        <input type="text" name="titulo" id="titulo" size="50"  maxlength="200" value="<?php echo $row['seccion_nombre']?>">
                        </td></tr>
                        <tr><td>Orden en el que va:
                        <input type="text" name="orden" id="orden" size="5" value="<?php echo $row['seccion_orden']?>">
                        </td></tr>          
                       
                      </table></center>
                      <input type="butoon" value="Actualizar" class="btn" onclick ="javascript:valida_envia()">
                  </form> 
         <!-- HTML ELIMINAR-->
              <?php } 
          if ($_POST['eliminar']) {
             $seccion = new seccion();
             $result = $seccion->eliminarSeccion($id);
             ?><div style="text-align:center;"><h5><?php  echo $result;?><br>
               <a href='html.modificar_seccion.php'><font color='red'>Volver</font></a>
            <?php } ?></h5>
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