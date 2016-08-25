<?php
  /* CODIFICA CARATERES ESPECIALES EN HTML */
  /*function html_chars($string){
      $chars = array("á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","Ñ",'"','“','”',"¡","¿","ü","º");
      $code_chars = array("&aacute;","&eacute;","&iacute;","&oacute;","&uacute;","&Aacute;","&Eacute;","&Iacute;","&Oacute;","&Uacute;","&ntilde;","&Ntilde;","&quot;","&ldquo;","&rdquo;","&iexcl;","&iquest;","&uuml;","&ordm;
");
      
      for ($i=0; $i < count($chars); $i++){
           $string = ereg_replace($chars[$i],$code_chars[$i],$string);      
      }
      return $string;
  }
  */
  
  function html_chars($string){
      $chars = array("á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","Ñ",'“','”',"¡","¿","ü","º","ª","-",'"',"'","@");
      $code_chars = array("&aacute;","&eacute;","&iacute;","&oacute;","&uacute;","&Aacute;","&Eacute;","&Iacute;","&Oacute;","&Uacute;","&ntilde;","&Ntilde;","&ldquo;","&rdquo;","&iexcl;","&iquest;","&uuml;","&ordm;
","&ordf;","\-","\"","\'","&#64;");

      
      for ($i=0; $i < count($chars); $i++){
           $string = ereg_replace($chars[$i],$code_chars[$i],$string);      
      }
      return $string;
  }
  
  /* CODIFICA LOS CARACTERES ESPECIALES PERO SIN LA COLOCACION DE \ ANTES DE UN SIMBOLO*/
  function html_chars2($string){
      $chars = array("á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","Ñ",'“','”',"¡","¿","ü","º","ª","@","•");
      $code_chars = array("&aacute;","&eacute;","&iacute;","&oacute;","&uacute;","&Aacute;","&Eacute;","&Iacute;","&Oacute;","&Uacute;","&ntilde;","&Ntilde;","&ldquo;","&rdquo;","&iexcl;","&iquest;","&uuml;","&ordm;
","&ordf;","&#64;","&#8226;");

      
      for ($i=0; $i < count($chars); $i++){
           $string = ereg_replace($chars[$i],$code_chars[$i],$string);      
      }
      return $string;
  }
  
  
  /* OBTIENE LA EXTENSION DE UN ARCHIVO */
  function findexts ($filename) { 
	 $filename = strtolower($filename) ; 
	 $exts = split("[/\\.]", $filename) ; 
	 $n = count($exts)-1; 
	 $exts = $exts[$n]; 
	 return $exts; 
 } 
 
	/* REEMPLAZA LA PRIMERA OCURRENCIA EN UNA CADENA */
	//str_pattern = patron de busqueda, o cadena a buscar.
	//str_replacement = cadena de reemplazo.
	//string = cadena en donde buscar lo pasado en str_pattern.
	function str_replace_once($str_pattern, $str_replacement, $string){ 
        
        if (strpos($string, $str_pattern) !== false){ 
            $occurrence = strpos($string, $str_pattern); 
            return substr_replace($string, $str_replacement, strpos($string, $str_pattern), strlen($str_pattern)); 
        } 
        
        return $string; 
    }
	
	function limpiaCadena($cadena) {
		//return (ereg_replace('[-]', '', $cadena));
		$posicion = strrpos($cadena, "-");
		if ($posicion === false) {
			return false;
		}
		else{ return str_replace ('-' , '' ,$cadena); }
	}
?>
