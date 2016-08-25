<!--
========================================================
						HEADER
========================================================


-->
<header>
	<div class="container">
	  <div class="brand">
		<h1 class="brand_name">
		<?php $mime =  mimetype($_SESSION["parametros"]["logo"]); 
			echo "<a href='data:$mime;base64,".base64_encode( $_SESSION["parametros"]["logo"] )."' data-title='fotito'  rel='lightbox' >
						<img style='height:auto;width:auto;max-width:100px;max-height:100px;' src='data:image/jpg;base64,".base64_encode( $_SESSION["parametros"]["logo"] )."'/>
					</a>";
		?>
		<a href="./"><?php echo $_SESSION["parametros"]["razonsocial_fantasia"] ?></a></h1>
		</br><p class="brand_slogan" style="float:right;"><?php echo $_SESSION["parametros"]["slogan"] ?></p>
	  </div>
	  <a href="callto:#" class="fa-phone"><?php echo $_SESSION["parametros"]["telefono_comercial"] ?></a>
	  <p>Para contactarnos puede llamar a...</p>
	  <!--<p><?php //if(isset($_SESSION["logincl"])){ echo "<p>Bienvenido, ".$_SESSION["logincl"]["nombre"]."</p>"; } ?></p>
	  -->
	</div>
	<div id="stuck_container" class="stuck_container">
	  <div class="container">
		<nav class="nav">
		  <ul data-type="navbar" class="sf-menu">
			<?php 
            while($row=mysql_fetch_array($result)){ 
                $id=$row['seccion_id'];
                $titulo=$row['seccion_nombre'];
              ?>
                <li class="active"><?php echo"<a href='html.visionUsurioSeccion.php?id=".$id."'>"?><?php echo $titulo.'<br><br></a>'?></li>
           </ul>
      		<?php    }    ?>
		</nav>
	  </div>
	</div>
</header>