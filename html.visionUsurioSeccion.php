<?php
	
	/*--- LIBRERIAS Y CONEXIONES ---*/
	require_once("librerias-conexion.php");
	
	/*if(isset($_SESSION["logincl"])){header("location:index.php");}
	else{*/
	$id = $_GET['id'];
    
  $subseccion = new subSeccion();
  $resulSubsec = $subseccion->leerSubsecConSeccion($id);
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
	  <?php require_once("cabecera1.php"); ?>
      <!-- /CABECERA -->
	  
	  <!--
      ========================================================
                                  CONTENT
      ========================================================
      -->
      <main>
		 
        
          <?php 
          $pagina = '';

          while ($row = mysql_fetch_array($resulSubsec)) {
            $idSubsec = $row['subsec_id'];
            $tituloSubsec = $row['subsec_nombre'];
           
           $pagina .= "<section>
                            <div class='container hr well1 ins2'>
                                <div class='row'>";  
          
                $parte = new parte();
                $resultParte = $parte->leerParteConSubsec($idSubsec);
                         
                   while ($rowParte =mysql_fetch_array($resultParte)) {
                      $tipo = $rowParte['partes_tipo_id'];
                      $img = $rowParte['partes_contenido'];
                                            
                        if ($tipo == 3 && $img!="") {
                        
                          $pagina .= "<div class = 'grid_6'>
                                          <img src='partes/".$img."'/>
                                       </div>";
                        }
                         elseif ($tipo == 4 && $img!=""){
                            
                            $pagina .= "<div class = 'grid_6'>
                                          <img src='partes/".$img."'/>
                                       </div>";
                        }
                        elseif ($tipo == 5 && $img!=""){
                            $pagina .="<div class = 'grid_2 wow fadeInRight animated' style='visibility: visible; animation-delay: 0.2s; animation-name:fadeInRight;'>                                 
                                            <img src='partes/".$img."'/>
                                         
                                       </div>";
                        }                       
                        else{
                          $pagina .= "<div class = 'grid_6'>
                                          <p>".$rowParte['partes_contenido']."</p>
                                        
                                      </div>";
                        
                         } 
                    } 
                    
             $pagina .= "</row>
                      </div>
                  </section>";
            }
            echo $pagina;
            ?>
           
      </main>
      
	  <!-- PIE -->
	  <?php require_once("pie.php"); ?>
	  <!-- /PIE -->
	  
    </div>
    <script src="js/script.js"></script>
  </body>
</html>
<!-- <?php //} //Cierre Login ?> -->