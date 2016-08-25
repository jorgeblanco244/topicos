<?php
	
	/*--- LIBRERIAS Y CONEXIONES ---*/
	require_once("librerias-conexion.php");
	
	/*if(isset($_SESSION["logincl"])){header("location:index.php");}
	else{*/
	$id = $_POST['id'];
  $idSubsec = $_POST['sub_secciones'];
  $idSeccion = $_POST['seccion'];
  $orden = $_POST['orden'];
  $titulo = $_POST['titulo'];
  $tipo = $_POST['tipo'];
  $nombreDirectorio = './partes/';
  $img = $_FILES['foto']['tmp_name'];
  $img1 = $_FILES['foto1']['tmp_name'];
  $contenido = $_POST['contenido'];
  $contenido2 = $_POST['contenido2'];
  
    if ($contenido != "") {
      $parte = new parte();
      $resultado = $parte-> modificarParte($id,$idSubsec,$idSeccion,$orden,$titulo,$tipo,$contenido);
    }
    elseif ($img1 !=""){
      $imagen=$titulo.".".findexts($_FILES['foto1']['name']);
      move_uploaded_file($img1,$nombreDirectorio.$imagen);
      $parte = new parte();
      $resultado = $parte-> modificarParte($id,$idSubsec,$idSeccion,$orden,$titulo,$tipo,$imagen);
    }
    elseif ($img !=""){
      $imagen=$titulo.".".findexts($_FILES['foto']['name']);
      move_uploaded_file($img,$nombreDirectorio.$imagen);
      $parte = new parte();
      $resultado = $parte-> modificarParte($id,$idSubsec,$idSeccion,$orden,$titulo,$tipo,$imagen);
    }
    elseif ($contenido2 != ""){
      $parte = new parte();
      $resultado = $parte-> modificarParte($id,$idSubsec,$idSeccion,$orden,$titulo,$tipo,$contenido2);
    }
    else{
      $resultado="SE GUARDARON LAS MODIFICACIONES";
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
           <div style="text-align:center"><h5> <?php echo $resultado; ?></h5></div>
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