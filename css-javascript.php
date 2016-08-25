<?php
	/*--- CSS Y JAVASCRIPT *---/
	/*
		Contiene todas las llamadas a hojas de estilo (CSS), y archivos y scripts Javascript (js),
		y cualquier otro script necesario dentro de las etiquetas <head>.
	*/
?>
<!-- ICONO DE PESTAÑA -->
<link rel="icon" href="images/favicon.ico" type="image/x-icon">

<?php /*--- CSS - HOJAS DE ESTILO ---*/ ?>
<link href="css/estilos.css" rel="stylesheet" type="text/css" />
<!--<link href="css/estilos_textos.css" rel="stylesheet" type="text/css" />-->

<!-- DE LA PLANTILLA -->
<link rel="stylesheet" href="css/grid.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/google-map.css">
<link rel="stylesheet" href="css/mailform.css">
<!-- DE LA PLANTILLA -->

<?php /*--- JAVASCRIPT ---*/ ?>
<!-- DE LA PLANTILLA -->
<script src="js/jquery.js"></script>
<script src="js/jquery-migrate-1.2.1.js"></script><!--[if lt IE 9]>
<html class="lt-ie9">
<div style="clear: both; text-align:center; position: relative;"><a href="http://windows.microsoft.com/en-US/internet-explorer/.."><img src="images/ie8-panel/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."></a></div>
</html>
<script src="js/html5shiv.js"></script><![endif]-->
<script src="js/device.min.js"></script>
<!-- DE LA PLANTILLA -->

<script src="lightbox/js/jquery-1.11.0.min.js"></script>
<script src="lightbox/js/lightbox.min.js"></script>
<link href="lightbox/css/lightbox.css" rel="stylesheet" />
<!-- lightbox 2 -->

<!-- Funciones para tabla responsive (FooTable) -->
<link href="css/footable_css/footable-0.1.css" rel="stylesheet" type="text/css" />
<link href="css/footable_css/footable.sortable-0.1.css" rel="stylesheet" type="text/css" />
<link href="css/footable_css/footable.paginate.css" rel="stylesheet" type="text/css" />

<script src="js/footable_js/footable.js" type="text/javascript"></script>
<script src="js/footable_js/footable.sortable.js" type="text/javascript"></script>
<script src="js/footable_js/footable.filter.js" type="text/javascript"></script>
<script src="js/footable_js/footable.paginate.js" type="text/javascript"></script>
<script type="text/javascript">
	$(function() {
	  $('table').footable();
	});
</script>
<!-- Funciones para tabla responsive -->

<!-- ENVIO CIFRADO DEL PASS DEL USUARIO / PAGINA DE REFERENCIA http://phpjs.org/functions/ -->
<script src="js/utf8_encode.js"></script>
<script src="js/sha1.js"></script>
<script src="js/md5.js"></script>
<!-- ENVIO CIFRADO DEL PASS DEL USUARIO -->

<script type="text/javascript">
//------------------------------------------------------------------------------------------------
//DEVUELVE EL ELEMENTO CORRECTO DE ACUERDO AL NAVEGADOR
function getXMLHttp()
{
  var xmlHttp;

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
        alert("Your browser does not support AJAX!");
        return false;
      }
    }
  }
  return xmlHttp;
}
/*---------------------------------------------------------------------*/
/* VALIDAMOS LOS DATOS INGRESADOS ANTES DE ENVIAR EL MAIL (EDITAR POR MARTIN)*/
function validar_envio(){
	//valido el nombre
	var nombre = document.form_contacto.nombre.value;
	var asunto = document.form_contacto.asunto.value
	var mail = document.form_contacto.email.value
	var mensajes = document.form_contacto.mensaje.value
	
    if (nombre.length==0){
       alert("Por favor, especifique su/s Nombre/s y Apellido/s.")
       document.form_contacto.nombre.focus();
    }
	else{
		//valido el asunto
		if (asunto.length==0){
			alert("Por favor, especifique el asunto del mensaje.")
			document.form_contacto.asunto.focus();
		}
		else{
			//valido el e-mail
			if (mail.length==0){
				alert("Por favor, especifique un E-mail.")
				document.form_contacto.email.focus();
			}
			else{
				if(!(/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/.test(mail))){
					alert("Por favor, especifique un E-mail valido.")
					document.form_contacto.email.focus();
				}
				else{
					
					//valido el mensaje
					if (mensajes.length==0){
						alert("Por favor, especifique su consulta/mensaje.")
						document.form_contacto.mensajes.focus();
					}
					else{
						document.forms['form_contacto'].submit();
					}
					
				}
			}
		}
	}
} //fin function validar_envio()

/*--------------------------------------------------------------------------*/
// FUNCION VERIFICAR SI EL NOMBRE DE USUARIO YA EXISTE
function HandleResponseVU(response)
{
	var r = response.search("true");
	if(r != "-1"){
		//document.getElementById('error_usuario').innerHTML = "Error: El nombre de usuario elegido ya existe en la Base de Datos.";	
		//document.getElementById('usuario').value = "";
		//document.getElementById('usuario').focus();
		
	}else{
		//document.getElementById('error_usuario').innerHTML = "OK: Nombre de usuario valido.";	
	}
}

function verificar_usuario(){
	/* DATOS OBLIGATORIOS */
	usuario = document.getElementById("usuario");
	
	if(usuario.value==""){//if
		alert("Por favor, especifique un nombre de Usuario.")
		document.getElementById('usuario').focus();
	}//if
	else{
		/* ENVIO EL FORMULARIO PARA SU PROCESO */
		var xmlHttp = getXMLHttp();
		xmlHttp.onreadystatechange = function()
									{
										if(xmlHttp.readyState == 4)
										{
											HandleResponseVU(xmlHttp.responseText);
										}
									}

		xmlHttp.open("GET", "proc.verificar.usuario.php?usuario="+usuario.value, true);
		xmlHttp.send(null);
	}
}

//FUNCION QUE VALIDA EL LOGUEO DEL USUARIO
function user_login(){
	/* DATOS OBLIGATORIOS */
	email = document.getElementById("email");
	password = document.getElementById("pass");

	//valido el e-mail
	if (email.value == ""){
		alert("Por favor, especifique un E-mail.")
		email.focus();
	}
	else if(!(/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/.test(email.value))){
		alert("Por favor, especifique un E-mail valido.")
		email.focus();
	}
	else if(password.value == "" || password.value.length < 6){
		alert("Por favor, especifique una contraseña valida.")
		password.focus();
	}
	
	// Creo un nuevo elemento input, este contendra nuestro password encriptado
    var p = document.createElement("input");
 
    // Agregamos el nuevo elemento al formulario
    document.forms['form_login'].appendChild(p);
    p.name = "p";
    p.type = "hidden";
    //p.value = sha1(md5(password.value.replace(/^\s+/g,'').replace(/\s+$/g,'')));
	p.value = md5(password.value.replace(/^\s+/g,'').replace(/\s+$/g,''));
 
    // Nos aseguramos de blanquear el password no encriptado para que no viaje por la red
    password.value = "";
	
	//alert("Pass Cifrado: " + p.value);
	
    // Finalmente enviamos el formulario
    document.forms['form_login'].submit();


}

/* DETECTA EL ENTER EN EL CAMPO PASSWORD */
function enter_pass(e) {
  tecla = (document.all) ? e.keyCode : e.which;
  if (tecla==13) user_login();
}

//Permite solo el ingreso de numeros para el campo num_calle
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
else if ((("0123456789,.").indexOf(keychar) > -1))
return true;
// decimal point jump
/*else if (dec && (keychar == "."))
{
myfield.form.elements[dec].focus();
return false;
}*/
else
return false;
}
</script>

<!-- FUNCIONES CARRITO -->
<script src="carrito/funciones_carrito.js"></script>
<!-- FUNCIONES CARRITO -->