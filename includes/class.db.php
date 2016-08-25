<?php
	
//Esta clase maneja la conexion/cierre conexion sobre la base de datos.
	
/*
 * **** Ejemplo ****
 * 
 * require ("dbclass.php");
 * $db = new DataBase();
 * $db->Connect();
 * $db->Close();
 * 
 * 
*/
	class DataBase extends mysqli {
		var $host; // host donde se encuentra Mysql.
		var $usuario; // Usuario para contectar a MySql.
		var $contrasena;// Contraseña.
		var $basededatos;// nombre de la base de datos.
		var $id_connection; // Puntero a la conexion a Mysql.
		var $resultados; // puntero a resultados de una consulta.
		var $result_array; //Array que contiene los resutaldos de una consulsta asignado por GetResult()
    
    
		/* Constructor de la Clase, parametros pasados por defecto en el caso de que no se pase ninguno */
		public function __construct($host,$usuario,$contrasena,$basededatos){
			/*$this->host = $host;
			$this->usuario = $usuario;
			$this->contrasena = $contrasena;
			$this->basededatos = $basededatos;*/
			parent::__construct($host, $usuario, $contrasena, $basededatos);

			if (mysqli_connect_error()) {
				die('Error de Conexión (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
			}
		}//function __construct
    
		/* Realiza la conexion a MySql */
		/*function Connect(){
			$this->id_connection = mysql_connect($this->host,$this->usuario,$this->contrasena);
			if (!$this->id_connection){
				die ("No se puede conectar a MySQL.");
			}else{
				mysql_select_db ($this->basededatos,$this->id_connection) or die ("No se puede abrir la Base " . $this->basededatos);
			} //else
		}//function Connect
		*/
		/* Cierra la conexion a la base de datos */
		/*function Close(){
			mysql_close($this->id_connection);
		}//function Close */
	} //class

?>