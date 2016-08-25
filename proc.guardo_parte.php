<?php
	
	/*--- LIBRERIAS Y CONEXIONES ---*/
	require_once("librerias-conexion.php");
	
	/*if(isset($_SESSION["logincl"])){header("location:index.php");}
	else{*/
    $subsec=$_POST['sub_secciones'];
    $seccionId =$_POST['seccion'];
                //$subseccion = new subSeccion();
                // OBTENGO ID DE LA SECCION A LA QUE PERTENECE LA SUB-SECCION.
                //$result = $subseccion->subSeccionId($subsec);
                  //while($row=mysql_fetch_array($result)){ 
                     //   $seccionId=$row['subsec_seccion_id'];}
                           
    $titulo=$_POST['titulo'];
    $tipo=$_POST['tipo'];
    
      if($tipo == 1 || $tipo == 2 || $tipo == 6){
          $contenido=$_POST['contenido'];
                // DOY DE ALTA UNA NUEVA PARTE.
                $parte = new parte();
                $resultado = $parte->nuevaParte($subsec,$seccionId,$tipo,$titulo,$contenido);
                }
      if($tipo == 3 || $tipo == 4 || $tipo == 5){
        $nombreDirectorio = './partes/';
        //$nombreFichero = ($titulo.'.jpg');
        $foto = $_FILES['foto']['tmp_name'];
        $img=$titulo.".".findexts($_FILES['foto']['name']);
        move_uploaded_file($foto,$nombreDirectorio.$img);
        $parte = new parte();
                $resultado = $parte->nuevaParte($subsec,$seccionId,$tipo,$titulo,$img);
     
         }       
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
           <div style="text-align:center;"><h5><?php echo $resultado;?></h5> 
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