<?php
	
	/*--- LIBRERIAS Y CONEXIONES ---*/
	require_once("librerias-conexion.php");
			
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Quienes Somos</title>
    <meta charset="utf-8">
    <meta name="format-detection" content="telephone=no">
    
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
      <main class="mobile-center">
        <section>
          <div class="container hr well1 ins2">
            <div class="row">
              <div class="grid_6">
                <div> <!--class="video"-->
                  <!--<iframe src="//player.vimeo.com/video/37582125?wmode=transparent" allowfullscreen></iframe>-->
				  <img alt="" src="images/id-panther-01.jpg">
                </div>
              </div>
              <div class="grid_6">
                <h2>Datos B&aacute;sicos</h2>
                <div class="row">
                  <div class="grid_3">
                    <dl class="info">
                      <dt>Nombre</dt>
                      <dd><?php echo $_SESSION["parametros"]["razonsocial_fantasia"]; ?></dd>
                      <dt>Inicio de Actividades</dt>
                      <dd><?php echo $_SESSION["parametros"]["fecha_inicio_actividades"]; ?></dd>
                      <dt>Ubicaci&oacute;n</dt>
                      <dd><?php echo $_SESSION["parametros"]["domicilio_localidad_comercial"]; ?></dd>
                    </dl>
                  </div>
                  <div class="grid_3">
                    <dl class="info">
                      <dt>Historia</dt>
                      <dd>
                        <ul>
                          <li>Lorem ipsum dolor sit 1997-1999 adipis</li>
                          <li>Pellentesque sed dolor  1995-1999</li>
                          <li>Aliquam congue nisl 2001-2005</li>
                          <li>Mauris accumsa vel diam 2006-2008</li>
                          <li>Sed in lacus ut 2008-2010 enim adipiscing </li>
                        </ul>
                      </dd>
                    </dl>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <section class="well1 ins3">
          <div class="container">
            <h2>Quienes Somos</h2>
            <div class="row off1">
              <div class="grid_6">
                <h3>Acerca de Nosotros</h3>
                <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatu. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna. Suspendisse commodo tempor sagittis!<br/><br/>In justo est, sollicitudin eu scelerisque pretium, placerat eget elit. Praesent faucibus rutrum odio at rhoncus. Pellentesque vitae tortor id neque fermentum pretium.</p>
                <hr>
                <h3>Que ofrecemos</h3>
                <div class="row">
                  <div data-wow-delay="0.2s" class="grid_3 wow fadeInLeft"><img src="images/page-2_img01.jpg" alt=""></div>
                  <div class="grid_3 wow fadeInLeft"><img src="images/page-2_img02.jpg" alt=""></div>
                </div>
                <p>Nam justo elit, dictum id tempus a, ultricies tempus lacus. Nunc purus nibh; eleifend eget facilisis ac, sagittis non tortor. Vivamus eu enim a orci accumsan tincidunt ut ut elit. Vestibulum nisi orci, rutrum ac auctor non, viverra et magna?</p>
              </div>
              <div class="grid_6">
                <h3>Nuestro Equipo</h3>
                <div class="row">
                  <div class="grid_2 wow fadeInRight"><img src="images/page-2_img03.jpg" alt=""><img src="images/page-2_img06.jpg" alt=""></div>
                  <div data-wow-delay="0.2s" class="grid_2 wow fadeInRight"><img src="images/page-2_img04.jpg" alt=""><img src="images/page-2_img07.jpg" alt=""></div>
                  <div data-wow-delay="0.4s" class="grid_2 wow fadeInRight"><img src="images/page-2_img05.jpg" alt=""><img src="images/page-2_img08.jpg" alt=""></div>
                </div>
                <p>Curabitur facilisis pellentesque pharetra. Donec justo urna, malesuada a viverra ac, pellentesque vitae nunc. Aenean ac leo eget nunc fringilla a non nulla! Nunc orci mi, venenatis quis ultrices vitae, congue non nibh. Nulla bibendum, justo eget ultrices.</p>
                <hr>
                <h3>Nuestras Ventajas</h3>
                <p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna. Suspendisse commodo tempor sagittis! In justo est, sollicitudin eu scelerisque pretium, placerat eget elit. Praesent faucibus rutrum odio at rhoncus. Pellentesque vitae tortor id neque fermentum pretium.</p>
              </div>
            </div>
          </div>
        </section>
        <section class="well1 ins3 bg-primary">
          <div class="container">
            <h2>Nuestros Premios</h2>
            <ul class="product-list row off1">
              <li class="grid_6">
                <div class="box">
                  <div class="box_aside">
                    <div class="icon fa-asterisk"></div>
                  </div>
                  <div class="box_cnt__no-flow">
                    <h3>Vestibulum elementum tempus eleifend</h3>
                    <p>Sed do eiusmod tempor incididunt ut labore et dolore magna. Suspendisse commodo tempor sagittis! In justo est sollicitudin.</p>
                  </div>
                </div>
                <hr>
                <div class="box">
                  <div class="box_aside">
                    <div class="icon fa-asterisk"></div>
                  </div>
                  <div class="box_cnt__no-flow">
                    <h3>Congue dui ut porta aenean laoreet</h3>
                    <p>Pellentesque vitae tortor id neque fermentum pretium. Maecenas ac lacus ut neque rhoncus laoreet sed id tellus.</p>
                  </div>
                </div>
                <hr>
                <div class="box">
                  <div class="box_aside">
                    <div class="icon fa-asterisk"></div>
                  </div>
                  <div class="box_cnt__no-flow">
                    <h3>Aenean laoreet viverra turpis a com</h3>
                    <p>Maecenas ac lacus ut neque rhoncus laoreet sed id tellus. Donec justo tellus, tincidunt vitae pellentesque nec, pharetra a orci. Praesent</p>
                  </div>
                </div>
              </li>
              <li class="grid_6">
                <div class="box">
                  <div class="box_aside">
                    <div class="icon fa-asterisk"></div>
                  </div>
                  <div class="box_cnt__no-flow">
                    <h3>Tempus eleifend cum sociis natoque</h3>
                    <p>Labore et dolore magna. Suspendisse commodo tempor sagittis! In justo est sollicitudin eu scelerisque pretium, placerat eget elit.</p>
                  </div>
                </div>
                <hr>
                <div class="box">
                  <div class="box_aside">
                    <div class="icon fa-trophy"></div>
                  </div>
                  <div class="box_cnt__no-flow">
                    <h3>Sociis natoque penatibus vestibulum</h3>
                    <p>Suspendisse commodo tempor sagittis! In justo est sollicitudin eu scelerisque pretium, placerat eget elit. Praesent faucibus rutrum.</p>
                  </div>
                </div>
                <hr>
                <div class="box">
                  <div class="box_aside">
                    <div class="icon fa-trophy"></div>
                  </div>
                  <div class="box_cnt__no-flow">
                    <h3>Penatibus vestibulum congue dui ut</h3>
                    <p>In justo est sollicitudin eu scelerisque pretium, placerat eget elit. Praesent faucibus rutrum odio at rhoncus.</p>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </section>
        <section class="well1">
          <div class="container">
            <div class="row">
              <div class="grid_4">
                <h2>Deberes</h2>
                <p>Aenean ac leo eget nunc fringilla a non nulla! Nunc orci mi, venenatis quis ultrices vitae, congue non nibh. Nulla bibendum, justo eget ultrices vestibulum, erat tortor venenatis risus, sit amet cursus dui augue a arcu.</p>
              </div>
              <div class="grid_4">
                <h2>Habilidades</h2>
                <p>Nunc orci mi, venenatis quis ultrices vitae, congue non nibh. Nulla bibendum, justo eget ultrices vestibulum, erat tortor venenatis risus, sit amet cursus dui augue a arcu. Quisque mauris risus, gravida a molestie eu, dictum.</p>
              </div>
              <div class="grid_4">
                <h2>Oportunidades</h2>
                <p>Quisque mauris risus, gravida a molestie eu, dictum ac augue. Integer sodales tempor lectus; sit amet dictum metus pharetra nec. Fusce bibendum dapibus pretium. Nunc eu sem vitae lacus laoreet elementum.</p>
              </div>
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