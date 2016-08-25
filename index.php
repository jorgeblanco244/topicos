<?php
	
	/*--- LIBRERIAS Y CONEXIONES ---*/
	require_once("librerias-conexion.php");
	
	/*if(isset($_SESSION["logincl"])){header("location:index.php");}
	else{*/
		
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
            <h2>INGRESAR</h2>
            <form method="post" action="proc.login.php" name="form_login" class="mailform off2">
              <input type="hidden" name="form-type" value="validationForm" >
              <fieldset class="row">
				<label class="grid_4">
                  <input type="email" id="email" name="email" required placeholder="Usuario" autofocus /> <!-- data-constraints="@Email @NotEmpty" -->
                </label>
				<label class="grid_4">
                  <input type="password" id="pass" name="pass" required placeholder="Contraseña" onkeypress="enter_pass(event)" /><!-- data-constraints="@Pass @NotEmpty" -->
                </label>
				<div class="mfControls grid_12">
                  <!--<button type="buttom" onclick="user_login()" class="btn">Acceder</button>-->
				  <a onclick="user_login()" href="#" class="btn">Acceder</a>
                </div>
              </fieldset>
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