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

  /* CONEXION DB */
  //Creo un objeto de base de datos;   
  $db = new DataBase($conf_mysql_host,$conf_mysql_user,$conf_mysql_password,$conf_mysql_db); 
  $db->Connect();//Conecto a la base de datos;
  
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?php echo $conf_empresa ?></title>
<link href="css/menu.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>

<link rel="stylesheet" type="text/css" href="css/jquery-ui-1.7.2.custom.css" />
<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>-->
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/jquery-ui.min.js"></script>

<!--<script src="ckeditor/_samples/sample.js" type="text/javascript"></script>
<script language="JavaScript" type="text/javascript" src="js/ajax.common.js"></script>-->
<!--<script language="JavaScript" type="text/javascript" src="js/correctpng.js"></script>-->
<script type="text/javascript">
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
var id_ganador;

//valido los campos de la noticia
function agregar_promo(){
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
			document.forms['nueva_promo'].submit();
		}//else7
						
		
}

// FUNCIONES PARA EL UPLOAD DE IMAGENES
// Funciones comunes


/* DOCUMENTOS - AGREGAR DOCUMENTOS */
var numero = 0; //ASIGNA UN NUMERO AL ELEMENTO QUE SE CREO
var conta = 0; //CUENTA LOS ELEMENTOS EXISTENTES
var max = 3; //NUMERO MAXIMO DE ELEMENTOS PERMITIDOS

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
        idele.innerHTML = "<input name=" + elemento.name + " type=file id=" + elemento.id + " /><input name='epigrafe[]'  id='epigrafe" + num + "' type='text' size=60 /><input name='opcFd[]' type='hidden' id='opcFd"+ num +"' value='no'/>&nbsp;<a href='#ancla' name='"+ idele.id +"' onclick='removeField()'>Quitar</a>";
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
    // inicializamos datapicker para cada input con el formato de fecha dd/mm/yy   - FORMATO SQL: yy-mm-dd          
    $("#fecha_desde").datepicker({dateFormat: 'dd/mm/yy', changeMonth: true});
    $("#fecha_hasta").datepicker({dateFormat: 'dd/mm/yy', changeMonth: true});
	$("#fchdes_ganador").datepicker({dateFormat: 'dd/mm/yy', changeMonth: true});
    $("#fchhas_ganador").datepicker({dateFormat: 'dd/mm/yy', changeMonth: true});
 });

//FUNCION PARA DETECTAR QUE FECHA DE FIN NO SEA ANTERIOR A FECHA INICIO
function mayor(){
	var fecha = document.nueva_promo.fecha_desde.value;
	var fecha2 = document.nueva_promo.fecha_hasta.value;
	if((fecha != "") && (fecha2 != "")){
		var fechaIni=fecha.split("-");
		var fechaFin=fecha2.split("-");
		var fechainicial=fechaIni[0]+fechaIni[1]+fechaIni[2];
		var fechafinal=fechaFin[0]+fechaFin[1]+fechaFin[2];

		if(parseInt(fechainicial)>parseInt(fechafinal)){
			//return true;
			alert("La fecha de fin del evento no puede ser anterior a la de inicio.");
			document.nueva_promo.fecha_hasta.value = "";
			//document.nueva_promo.fecha_hasta.focus();
		}else{
			return false;
		}
	}
}

//LLAMADO A LA FUNCION QUE OBTIENE EL GANADOR DEL SORTEO DE FORMA ALEATORIA
function HandleResponseSortear(response)
{
	//DIVIDIR EL RESULTADO Y MOSTRAR ID Y APELLIDO+NOMBRE DEL GANADOR
	//VER PARA MOSTRAR TAMBIEN SI ES CLIENTE Y EL NUMERO DEL MISMO
	document.getElementById('id_ganador').value = response;	
}

function generar_password(){
	/* ENVIO EL FORMULARIO PARA SU PROCESO */
	var xmlHttp = getXMLHttp();
	xmlHttp.onreadystatechange = function()
								{
									if(xmlHttp.readyState == 4)
									{
										HandleResponseSortear(xmlHttp.responseText);
									}
								}

	xmlHttp.open("GET", "proc.generar.ganador.php?id=", true);
	xmlHttp.send(null);
}
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
<?php include ("html.menu.include.php"); ?>

<div id="menu_spacer_column">&nbsp;&nbsp;&nbsp;&nbsp;</div>
<div id="menu_HTML_container">
	<div id="msg_container"></div><!-- Aca van los errores que se puedan presentar -->
	<div id="menu_cms_title"><div id="cms_titulo">Agregar Nueva Promoci&oacute;n<br></div></div>
	<div id="tit_container2" style="padding-bottom:10px"><label id="obligatorio" style="font-size:10px;color:#FF0000;">(*) Datos obligatorios</label></div>
	<form action="html.resultados.php" method="post" name="nueva_promo"  enctype="multipart/form-data">
	
	<div id="menu_noticia_title">Titulo:&nbsp;<label id="eti_titulo" style="font-size:10px;color:#FF0000;">(*)</label></div>
   <div id="menu_noticia_title" style="padding-bottom:10px">
		<div id="tit">
			<input name="titulo" type="text" id="titulo" size="60"  class="menu_txtbox"/>
		
			<!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" name="slider" id="slider" value="si" />
				Slider	-->
		</div>
	</div>
	
	<div id="menu_noticia_title">Vigencia:&nbsp;<label style="font-size:10px;color:#FF0000;">(*)&nbsp;</label></div>
	<div id="menu_noticia_title" style="padding-bottom:10px">
		<div id="tit">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			Fecha Inicio:
			<input type="text" name="fecha_desde" id="fecha_desde" size="12" readonly="readonly" onchange="mayor()" class="menu_txtbox" />
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;			
			<br/><br/>		
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			Fecha Fin:&nbsp;&nbsp;&nbsp;
			<input type="text" name="fecha_hasta" id="fecha_hasta" size="12" readonly="readonly" onchange="mayor()" class="menu_txtbox" />
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		</div>
	</div>
	
	<div id="cop"><div id="menu_noticia_title" style="display:">Descripci&oacute;n: <label id="eti_copete" style="font-size:10px;color:#FF0000;">(*)</label></div></div>
	<div id="contentscopete">
		<textarea cols="80" id="descripcion" name="descripcion" rows="10"></textarea>
	</div>
	<script type="text/javascript">
		var editor = CKEDITOR.replace( 'descripcion',
			{
				// Defines a simpler toolbar to be used in this sample.
				// Note that we have added out "MyButton" button here.
				toolbar : [ [ 'Source', '-', 'Bold', 'Italic', 'Underline', 'Strike','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','Link', '-', 'MyButton' ] ]
			});
	</script>
	<!--
	<br/>
	<div id="menu_noticia_title">Ganador:&nbsp;</div>
   <div id="menu_noticia_title" style="padding-bottom:10px">
		<div id="tit">
			<input name="id_ganador" type="text" id="id_ganador" size="11"  class="menu_txtbox"/>
			<input name="btn_sorter" type="button" onclick="sortear()" id="btn_sortear" value="Sortear" />
		</div>
	</div>-->
	<br/>
	<div id="menu_noticia_title">Vigencia para mostrar resultados de la promo&nbsp;<label style="font-size:10px;color:#FF0000;">(*)&nbsp;</label></div>
	<div id="menu_noticia_title" style="padding-bottom:10px">
		<div id="tit">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			Fecha Inicio:
			<input type="text" name="fchdes_ganador" id="fchdes_ganador" size="12" readonly="readonly" onchange="mayor()" class="menu_txtbox" />
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<br/><br/>		
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			Fecha Fin:&nbsp;&nbsp;&nbsp;
			<input type="text" name="fchhas_ganador" id="fchhas_ganador" size="12" readonly="readonly" onchange="mayor()" class="menu_txtbox" />
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		</div>
	</div>
	
	<div id="img_cms" style="padding-top:10px">
		<div id="menu_cms_title">Agregar Archivos<a name="ancla"></a></div>
		<div id="menu_noticia_title">
			<div id='cad_documento' class='titulosnovedades' >
				<a href="#ancla" onclick="addField()" accesskey="5">A&ntilde;adir Archivo</a>
			</div>
			<div id="files" class='titulosnovedades' ></div>
		</div>
	</div>
	
	<input name="opcion" type="hidden" id="opcion" value="nueva_promo"/><br/>
	
	<div id="btn_agregar">
	  <input name="button" type="button" id="boton" onClick="javascript:agregar_promo()" value="Crear Promoci&oacute;n"/>
	</div>
	
	</form>
</div>
<div id="footer" style="height:60; position:relative"></div>
</body>
</html>
<?php 
 $db->Close();
 }//fin else login
?>
