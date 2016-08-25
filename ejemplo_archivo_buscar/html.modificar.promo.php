<?php
  session_start();
  if(!isset($_SESSION["login"])){header("location:index.php");}
  else{
	require_once("includes/class.session.php");//utilizo la funcion de expiracion de tiempo.
	/* VERIFICO SESSION */
	$ses = new session();
	$ses->session_timeout();
  
  /* LIBRERIAS */
  require_once("includes/class.db.php");
  require_once("conf/conf.php");
  require_once("includes/admin_logs.php");
  require_once("includes/class.promociones.php");
  require_once("includes/class.suscriptores.php");
  require_once("includes/class.clientes.php");

  /* CONEXION DB */
  //Creo un objeto de base de datos;   
  $db = new DataBase($conf_mysql_host,$conf_mysql_user,$conf_mysql_password,$conf_mysql_db); 

  if(isset($_REQUEST['id'])){
		$id = htmlspecialchars(trim($_REQUEST['id']));
		
		$promos = new promociones();
		
		
		$result = $promos->consultar_promo($db->real_escape_string($id),$db);
		if($result->num_rows == 0){
			echo "Error!";
		}
		else{
			$row = $result->fetch_array();
			$id = $row['id'];
			$titulo = $row['titulo'];
			$descripcion = $row['descripcion'];
			$archivo = $row['archivo'];
			$fecha_desde = $row['fecha_desde']; //se utiliza para saber si la nota va en novedades.
			$fecha_desde = substr($fecha_desde, 8, 2) . "/" . substr($fecha_desde, 5, 2) . "/" . substr($fecha_desde, 0, 4);
			$fecha_hasta = $row['fecha_hasta']; //se utiliza para saber si la nota va en la columna de destacado1.
			$fecha_hasta = substr($fecha_hasta, 8, 2) . "/" . substr($fecha_hasta, 5, 2) . "/" . substr($fecha_hasta, 0, 4);
			
			$fchdes_ganador = $row['fchdes_ganador']; //se utiliza para saber si la nota va en la columna de destacado1.
			$fchdes_ganador = substr($fchdes_ganador, 8, 2) . "/" . substr($fchdes_ganador, 5, 2) . "/" . substr($fchdes_ganador, 0, 4);
			$fchhas_ganador = $row['fchhas_ganador']; //se utiliza para saber si la nota va en la columna de destacado1.
			$fchhas_ganador = substr($fchhas_ganador, 8, 2) . "/" . substr($fchhas_ganador, 5, 2) . "/" . substr($fchhas_ganador, 0, 4);
			
			$id_ganador = $row['id_ganador'];
			
			/* SI EL ID_GANADOR YA TIENE UN VALOR BUSCO EL NOMBRE DEL MISMO */
			if($id_ganador > 0){
				$result_ganador = $promos->consultar_ganador($id, $id_ganador, $db);
				if($result_ganador->num_rows > 0){
					$row_ganador = $result_ganador->fetch_array();
					
					if($row_ganador["cliente"] > 0){ $es_cliente = "- (CLIENTE)"; }
					else{ $es_cliente = "- (NO CLIENTE)"; }
					
					$nombre_ganador = "<b>" . $row_ganador["nombre_ganador"] . "</b>";
					$email_ganador = "- <b>Email:</b> " . $row_ganador["email_ganador"];
					$cod_cupon = "- C&oacute;digo de Cupon: ".$row_ganador["cod_cupon"];
					
				}else{
					$nombre_ganador = "";
					$es_cliente = "";
					$email_ganador = "";
					$cod_cupon = "";
				}
			}else{
				$id_ganador = "";
				$nombre_ganador = "";
				$es_cliente = "";
				$email_ganador = "";
				$cod_cupon = "";
			}
				
				
			
			
			if($archivo == "si"){
				$query = "SELECT * FROM archivos WHERE id_nota = " . $id;
				$result2 = $db->query($query);
				$cant_arch = $result2->num_rows;
				if($cant_arch > 0){
					while($row2 = $result2->fetch_array()){
						$arch[$row2['id']]['file'] = $row2['file'];
						$arch[$row2['id']]['ext'] = $row2['ext'];
						$arch[$row2['id']]['classid'] = $row2['clasificacionid'];
						$arch[$row2['id']]['epi'] = $row2['epigrafe'];
					}
				}
				
			}
		}
	}

  
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?php echo $conf_empresa ?> - CMS</title>
<link href="css/menu.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<!--<script src="ckeditor/_samples/sample.js" type="text/javascript"></script>
<script language="JavaScript" type="text/javascript" src="js/ajax.common.js"></script>
<script language="JavaScript" type="text/javascript" src="js/correctpng.js"></script>-->


<link rel="stylesheet" type="text/css" href="css/jquery-ui-1.7.2.custom.css" />
<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>-->
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/jquery-ui.min.js"></script>

<script type="text/javascript">
//--------------------------------------------------------------------------------------------------------
//FUNCIONES AJAX

//DEVUELVE EL ELEMENTO CORRECTO DE ACUERDO AL NAVEGADOR
function getXMLHttp()
{
  var xmlHttp

  try
  {
    //Firefox, Opera 8.0+, Safari
    xmlHttp = new XMLHttpRequest();
  }
  catch(e)
  {
    //Internet Explorer
    try
    {
      xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
    }
    catch(e)
    {
      try
      {
        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
      }
      catch(e)
      {
        alert("Your browser does not support AJAX!")
        return false;
      }
    }
  }
  return xmlHttp;
}
//------------------------------------------------------------------------------
//LLAMADO A LA FUNCION QUE GENERA EL GANADOR ALEATORIO
function HandleResponseGG(response)
{
	var r = response.search("Error");
	/* SI OCURRIO UN ERROR */
	if(r != "-1"){
		alert(response);
	}else{ /* SINO ASIGNO LOS VALORES HALLADOS */
		var subcadenas = response.split('-');
		document.getElementById('id_ganador').value = subcadenas[0];	
		document.getElementById('nombre_ganador').innerHTML = "<b>" + subcadenas[1] + "</b>";	
		document.getElementById('email_ganador').innerHTML = "- <b>Email:</b> " + subcadenas[2];	
		document.getElementById('cod_cupon').innerHTML = "- C&oacute;digo de Cupon: " + subcadenas[3];	
		document.getElementById('es_cliente').innerHTML = "- " + subcadenas[4];	
	}
	
}
var id_ganador
function sortear_promo(id_ganador){
	var xmlHttp = getXMLHttp();
	xmlHttp.onreadystatechange = function()
								{
									if(xmlHttp.readyState == 4)
									{
										HandleResponseGG(xmlHttp.responseText);
									}
								}

	xmlHttp.open("GET", "proc.generar.ganador.php?id="+id_ganador, true);
	xmlHttp.send(null);
}

//EVITA QUE SE INGRESEN CARACTERES QUE NO SEAN NUMERICOS
function numbersonly(myfield, e, dec){

	var key;
	var keychar;

	if (window.event)
	key = window.event.keyCode;

	else if (e)
	key = e.which;
	else
	return true;
	keychar = String.fromCharCode(key);

	// control keys
	if ((key==null) || (key==0) || (key==8) ||
	(key==9) || (key==13) || (key==27) )
	return true;
	// numbers
	else if ((("0123456789:").indexOf(keychar) > -1))
	return true;
	// decimal point jump
	else if (dec && (keychar == "."))
	{
	myfield.form.elements[dec].focus();
	return false;
	}
	else
	return false;
}

var titulo;
var descripcion;
var fecha_desde;
var fecha_hasta;
var fchdes_ganador;
var fchhas_ganador;
var id_ganador;

//valido los campos de la noticia
function actualizar_promo(){
		titulo = document.getElementById('titulo');
		descripcion = CKEDITOR.instances['descripcion'].getData();
		fecha_desde = document.getElementById('fecha_desde');
		fecha_hasta = document.getElementById('fecha_hasta');
		fchdes_ganador = document.getElementById('fchdes_ganador');
		fchhas_ganador = document.getElementById('fchhas_ganador');
		
		if(titulo.value==""){//if1
			alert("Por favor, especifique un Titulo para la Promo.")
			titulo.focus();
		}//if1
		else if(descripcion.length==0){//if2
			alert("Por favor, especifique una descripcion para la Promo.")
			CKEDITOR.instances['descripcion'].focus();
		}//if2
		else if(fecha_desde.value==""){//if3
			alert("Por favor, especifique la fecha de inicio de la Promo.")
			fecha_desde.focus();
		}//if3
		else if(fecha_hasta.value==""){//if4
			alert("Por favor, especifique la fecha de fin de la Promo.")
			fecha_hasta.focus();
		}//if4
		else if(fchdes_ganador.value==""){//if5
			alert("Por favor, especifique la fecha de inicio para mostrar resultados.")
			fchdes_ganador.focus();
		}//if5
		else if(fchhas_ganador.value==""){//if6
			alert("Por favor, especifique la fecha de fin para mostrar resultados.")
			fchhas_ganador.focus();
		}//if6
		else{//else7
			document.forms['actu_promo'].submit();
		}//else7
						
		
}


var num;
function submits(num){
	//REEMPLAZAR POR FORMATOS DE AUDIO REPRODUCIBLES EN LA WEB.
	//var re_text = /\.wav|\.WAV|\.wma|\.WMA|\.mp3|\.MP3|\.acc|\.ACC|\.rm|\.RM/i;
	var re_text = /\.jpg|\.JPG|\.gif|\.png|\.PNG/i;
    var filename = document.getElementById('Filedata'+num).value;
	var opcion1 = document.getElementById('opcFd'+num);
	
	/* Checking file type */
   if (filename.search(re_text) == -1)
    {
        //alert("Error! en el archivo. Compatible solo con archivos WAV, WMA, MP3, RM o ACC.");
		alert("Error! en el archivo. Compatible solo con archivos JPG, GIF o PNG."+num);
        document.getElementById("form_img_cont"+num).innerHTML = "<input name=Filedata type=file id=Filedata" + num + " onchange=submits(" + num +") size=30/>";
        opcion1.value = "no"
		return false;
    }
	else{opcion1.value = "si"}
}


function submit_actu_arch(){
	document.forms['actu_archivo'].submit();
}

/* DOCUMENTOS - AGREGAR DOCUMENTOS */
var numero = 0;
var conta = 0;
var max = <?php echo (3 - $cant_arch); ?>;

c= function (tag) { // Crea un elemento
   return document.createElement(tag);
}
d = function (id) { // Retorna un elemento en base al id
   return document.getElementById(id);
}
e = function (evt) { // Retorna el evento
   return (!evt) ? event : evt;
}
f = function (evt) { // Retorna el objeto que genera el evento
   return evt.srcElement ?  evt.srcElement : evt.target;
}

addField = function () {
   if(conta < max){
   conta = conta + 1;
   container = d('files');
   
   span = c('DIV');
   span.className = 'file_fila';
   span.id = 'file' + (++numero);
	
   field = c('INPUT');   
   field.name = 'archivos[]';
   field.id = 'archivos' + numero;
   field.type = 'file';
   
   field2 = c('INPUT');   
   field2.name = 'epigrafe[]';
   field2.id = 'epigrafe' + numero;
   field2.type = 'text';
   field2.size = 60;
   
   field3 = c('INPUT');   
   field3.name = 'opcFd[]';
   field3.id = 'opcFd' + numero;
   field3.type = 'hidden';
   field3.value = 'no';
   
   a = c('A');
   a.name = span.id;
   a.href = '#ancla';
   a.onclick = removeField;
   a.innerHTML = 'Quitar';
   
   span.appendChild(field);
   span.appendChild(field2);
   span.appendChild(field3);
   span.appendChild(a);
   container.appendChild(span);
   }
   
}
removeField = function (evt) {
   lnk = f(e(evt));
   span = d(lnk.name);
   span.parentNode.removeChild(span);
   conta = conta - 1;
}
//Esta funcion reemplaza al submits de los anteriores paneles
window.onchange = function(elEvento) {
	var evento = elEvento || window.event;
	var elemento = evento.srcElement ?  evento.srcElement : evento.target;
	var num = elemento.id.substring(8);
	var idele = document.getElementById('file'+num); //div que contiene a una fila
	var re_text = /\.jpg|\.JPG|\.gif|\.GIF|\.png|\.PNG/i;
	
	
	if(elemento.type == 'file')
    {
		if (elemento.value.search(re_text) == -1){
			alert("Error! en el archivo. Compatible solo con archivos JPG, GIF o PNG.");
        idele.innerHTML = "<input name=" + elemento.name + " type=file id=" + elemento.id + " /><input name='epigrafe[]'  id='epigrafe" + num + "' type='text' size=60 /><input name='opcFd[]' type='hidden' id='opcFd"+ num +"' value='no'/>&nbsp;&nbsp;<a href='#ancla' name='"+ idele.id +"' onclick='removeField()'>Quitar</a>";
        return false;
		}
		else{
			var opcion = document.getElementById('opcFd' + num);
			opcion.value = "si";
		}
	}
}

//-------------------------------------------------------------------------------
//--------------- FUNCION CALENDAR JQUERY ---------------------------------------

jQuery(function($){
	$.datepicker.regional['es'] = {
		closeText: 'Close',
		prevText: '&#x3c;Ant',
		nextText: 'Sig&#x3e;',
		currentText: 'Hoy',
		monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
		'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
		monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun',
		'Jul','Ago','Sep','Oct','Nov','Dic'],
		dayNames: ['Domingo','Lunes','Martes','Mi&eacute;rcoles','Jueves','Viernes','S&aacute;bado'],
		dayNamesShort: ['Dom','Lun','Mar','Mi&eacute;','Juv','Vie','S&aacute;b'],
		dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','S&aacute;'],
		weekHeader: 'Sm',
		dateFormat: 'dd/mm/yy',
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: false,
		yearSuffix: ''};
	$.datepicker.setDefaults($.datepicker.regional['es']);
});    

$(document).ready(function() {
    // obtenemos la fecha actual
    var date = new Date();
    var m = date.getMonth(), d = date.getDate(), y = date.getFullYear();
    // inicializamos datapicker para cada input con el formato de fecha dd/mm/yy                
    $("#fecha_desde").datepicker({dateFormat: 'dd/mm/yy', changeMonth: true});
    $("#fecha_hasta").datepicker({dateFormat: 'dd/mm/yy', changeMonth: true});
	$("#fchdes_ganador").datepicker({dateFormat: 'dd/mm/yy', changeMonth: true});
    $("#fchhas_ganador").datepicker({dateFormat: 'dd/mm/yy', changeMonth: true});
 });

</script>
<style type="text/css">
<!--
#Layer1 {
	position:absolute;
	left:2px;
	top:367px;
	width:213px;
	height:312px;
	z-index:1;
}
-->
</style>
</head>
<body>
<?php include ("html.header.php"); ?>

<br>
<?php 
	include ("html.menu.include.php"); 
?>

<div id="menu_spacer_column">&nbsp;&nbsp;&nbsp;&nbsp;</div>
<div id="menu_HTML_container">
	<div id="msg_container"></div><!-- Aca van los errores que se puedan presentar -->
	<div id="menu_cms_title"><div id="cms_titulo">Actualizar Promoci&oacute;n<br></div></div>
	<form action="html.resultados.php" method="post" name="actu_promo" >
	<div id="menu_noticia_title">Titulo&nbsp;<label id="eti_titulo" style="font-size:10px;color:#FF0000;">(*)</label>  </div>
    <div id="tit_container" style="padding-bottom:10px">
		<div id="tit">
			<input name="titulo" type="text" id="titulo" size="60"  class="menu_txtbox" value="<?php echo $titulo;?>">
		</div>
	</div>
	
	<div id="menu_noticia_title">Vigencia&nbsp;<label style="font-size:10px;color:#FF0000;">(*)&nbsp;</label></div>
	<div id="menu_noticia_title" style="padding-bottom:10px">
		<div id="tit">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			Fecha Inicio:
			<input type="text" name="fecha_desde" id="fecha_desde" size="12" readonly="readonly" onchange="mayor()" class="menu_txtbox" value="<?php echo $fecha_desde; ?>"/>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<br/><br/>		
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			Fecha Fin:
			<input type="text" name="fecha_hasta" id="fecha_hasta" size="12" readonly="readonly" onchange="mayor()" class="menu_txtbox" value="<?php echo $fecha_hasta; ?>"/>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		</div>
	</div>
	
	<div id="cop"><div id="menu_noticia_title" style="display:">Descripci&oacute;n: <label id="eti_copete" style="font-size:10px;color:#FF0000;">(*)</label></div></div>
	<div id="contentscopete">
		<textarea cols="80" id="descripcion" name="descripcion" rows="10"><?php echo $descripcion; ?></textarea>
	</div>
	<script type="text/javascript">
		var editor = CKEDITOR.replace( 'descripcion',
			{
				// Defines a simpler toolbar to be used in this sample.
				// Note that we have added out "MyButton" button here.
				toolbar : [ [ 'Source', '-', 'Bold', 'Italic', 'Underline', 'Strike','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','Link', '-', 'MyButton' ] ]
			});
	</script>
	<br/>
	<div id="menu_noticia_title">Ganador:&nbsp;</div>
    <div id="tit_container" style="padding-bottom:10px">
		<div id="tit">
			<input name="id_ganador" type="hidden" id="id_ganador" size="11"  class="menu_txtbox" value="<?php echo $id_ganador;?>" >
			&nbsp;<span class="textos_varios" id="nombre_ganador" ><?php echo $nombre_ganador; ?></span>
			&nbsp;<span class="textos_varios" id="email_ganador" ><?php echo $email_ganador; ?></span>
			&nbsp;<span class="textos_varios" id="cod_cupon" ><?php echo $cod_cupon; ?></span>
			&nbsp;<span class="textos_varios" id="es_cliente" ><?php echo $es_cliente; ?></span>
			<?php if($id_ganador == 0){ ?>
			&nbsp;<input name="button" type="button" id="boton" onClick="javascript:sortear_promo(<?php echo $_REQUEST['id']; ?>)" value="Sortear"/>
			<?php } ?>
		</div>
	</div>
	
	<div id="menu_noticia_title">Vigencia para mostrar resultados de la promo&nbsp;<label style="font-size:10px;color:#FF0000;">(*)&nbsp;</label></div>
	<div id="menu_noticia_title" style="padding-bottom:10px">
		<div id="tit">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			Fecha Inicio:
			<input type="text" name="fchdes_ganador" id="fchdes_ganador" size="12" readonly="readonly" onchange="mayor()" class="menu_txtbox" value="<?php echo $fchdes_ganador; ?>"/>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<br/><br/>		
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			Fecha Fin:
			<input type="text" name="fchhas_ganador" id="fchhas_ganador" size="12" readonly="readonly" onchange="mayor()" class="menu_txtbox" value="<?php echo $fchhas_ganador; ?>"/>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		</div>
	</div>
	
	<input name="opcion" type="hidden" id="opcion" value="actualizar_promo" />
	<input name="id" type="hidden" id="id" value="<?php echo $_REQUEST['id']; ?>"/><br/>
	
	<div id="btn_agregar">
	  <input name="button" type="button" id="boton" onClick="javascript:actualizar_promo()" value="Actualizar Promo"/>
	</div>
	
	</form>
	<div id="img_cms" style="padding-top:10px">
	<?php if($archivo == "si"){ ?>
		<div id="menu_cms_title" style="background-color:#000000;padding-bottom:1px;"></div>
		<div id="menu_cms_title">Archivos de la Promo</div>
		<div id="menu_noticia_title">
			<div id="form_img_cont" style="display:block">
				<table>
				<?php if(isset($arch)){ //if1 
						$count = 0;
						foreach($arch as $id_img => $archivos){ //foreach
						$count++;	
				?>
					<tr>
					<td>
					<div id="form_img_cont<?php echo $count; ?>" >
					<?php if($arch[$id_img]['classid'] == 1){ ?>
						<img src="../img_promos/<?php echo $arch[$id_img]['file']; ?>" alt="<?php echo $arch[$id_img]['file']; ?>" style="max-width:150px;max-height:150px;height:auto;width:auto;"  />&nbsp;&nbsp;&nbsp;
					<?php   }
							elseif($arch[$id_img]['classid'] == 2){ ?>	
						<label><a href='descargar.php?opcion=DESCARGAR&ID=<?php echo $id_img; ?>'><?php echo $arch[$id_img]['file'];?></a></label>&nbsp;&nbsp;&nbsp;
					<?php 	}//elseif ?>
					</div><br/>
					</td>
					<td>
					<form name="actu_archivo<?php echo $id_img; ?>" action="proc.actualizar.archivo.php" method="post">
					<input name="epigrafe" id="epigrafe" type="text" size="50" value="<?php echo $arch[$id_img]['epi']; ?>" />
					<input name="id" id="id_arch" type="hidden" value="<?php echo $id_img; ?>" />
					<input name="sec" id="sec" type="hidden" value="p" />
					<input name="idnota" id="idnota" type="hidden" value="<?php echo $_REQUEST['id']; ?>" />&nbsp;&nbsp;
					<a href="#" onclick="javascript:document.forms['actu_archivo<?php echo $id_img; ?>'].submit();" >Actualizar Comentario</a>&nbsp;&nbsp;
					</form>	
					</td>
					<td>
					<a href="proc.eliminar.archivo.php?idarch=<?php echo $id_img; ?>&id=<?php echo $_REQUEST['id']; ?>&sec=p">Eliminar</a>			
					</td>
					</tr>
				<?php 	} //foreach 
					} //if1 ?>
				</table>	
			</div>
		</div>
	<?php } ?>	
		<?php if((3 - $cant_arch) > 0){ ?>
		<div id="menu_cms_title" style="background-color:#000000;padding-bottom:1px;"></div>
		<div id="menu_cms_title">Agregar Archivo</div>
		<div id="menu_noticia_title">
			<div id="form_img_cont" style="display:block">		
						<div id="img_cms" style="padding-top:10px">
							<div id="menu_noticia_title">
								<div id='cad_documento' class='titulosnovedades' >
									<a href="#ancla" onclick="addField()" accesskey="5">A&ntilde;adir Archivo</a>
								</div><br/>
							<form action="proc.nuevo.archivo.php" method="post" name="nuevo_archivo" enctype="multipart/form-data">	
								<div id="files" class='titulosnovedades' ></div>
								<input name="id" type="hidden" id="id" value="<?php echo $_REQUEST['id']; ?>"/>
								<input name="sec" id="sec" type="hidden" value="p" />
								<input name="enviar_archivo" type="submit" id="enviar_archivo" value="Agregar" />
							</form>	
							</div>
						</div>
			</div>
		</div>
		<?php } ?>
	</div>
	
	<!--<div id="aud_cms" style="padding-top:10px">
		<div id="menu_cms_title">Agregar Audio</div>
		<div id="menu_noticia_title">
			<div id="form_aud_cont" style="display:block">
				<?php /*if(isset($aud)){ ?>
				<label><?php echo $aud; ?></label>&nbsp;&nbsp;&nbsp;
				<a href="proc.eliminar.audio.php?id=<?php echo $id; ?>">Eliminar</a>
				<?php }else{ ?>
				<form action="proc.nuevo.audio.php" method="post" name="nuevo_audio" enctype="multipart/form-data">
				<table><tr>
				<td>
					<div id="form_aud_cont2">
						<input name="Filedata2" type="file" id="Filedata2" onchange="submits2()" size="30"/>
					</div>	
				</td>
				<td><input name="opcFd2" type="hidden" id="opcFd2" value="no"/>
					<input name="id" type="hidden" id="id" value="<?php echo $_REQUEST['id']; ?>"/>
					<input name="enviar_audio" type="submit" style="float:left" id="enviar_audio" value="Agregar" />
				</td>
				</tr></table>	
				</form>
				<?php }*/ ?>	  
			</div>
		</div>
	</div>-->
	
</div>
<div id="footer" style="height:60; position:relative"></div>
</body>
</html>
<?php 
 $db->Close();
 }//fin else login
?>
