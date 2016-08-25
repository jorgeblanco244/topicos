<?php
  
  /*--- LIBRERIAS Y CONEXIONES ---*/
  require_once("librerias-conexion.php");
  
  /*if(isset($_SESSION["logincl"])){header("location:index.php");}
  else{*/
  $id = $_POST['id'];
  $titulo = $_POST['titulo'];
  $orden = $_POST['orden'];
  
  $seccion = new seccion();
  $resultado = $seccion -> darOrden($id,$orden); 
  $cantidades =mysql_num_rows($resultado);
  
   if ( $cantidades == 0) {
        $seccion1 = new seccion();
        $resultado1 = $seccion1 -> modificarSeccion($id,$titulo,$orden);
    }
    else {$msg = "¡ya existe seccion con ese orden intente nuevamente!<br>";}
  ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>INGRESAR</title>
    
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
            <div style="text-align:center;">
             <h5> <?php echo $resultado1; ?>
              <?php echo $msg; ?>
              <a href="html.modificar_seccion.php"><font color="red">Volver</font></h5>
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