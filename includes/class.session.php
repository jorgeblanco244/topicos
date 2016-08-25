<?php
  class session{
        
      var $nombre; //nombre de la session;
      var $times; // hora en la que se inicio la session;
      
      //Constructor de la clase.
      function session($nombre=''){
          $this->nombre = $nombre; 
      }
      
      //Metodo que inicia la session y almacena la hora de inicio;
      function start(){
          if(empty($this->nombre)){
               session_start();
          }else{
             $this->times = time();
             session_name($this->nombre);
             session_start();
             $_SESSION['time'] = $this->times; 
          } 
                 
      }
      
      //Almacena datos en la session;
      function save_data($datos){
        $_SESSION[md5(session_id())] = $datos;
      }
      
      //destruye la session,
      function destroy(){
          unset($_SESSION);
          session_destroy();
      }
      
         
      function session_timeout(){
          if(isset($_SESSION)){
              $times = $_SESSION['time'] + 1200;
              if($times < time()){
                  $this->destroy();
                  header("Location: index.php");
              }else{
                  $_SESSION['time'] = time();                
              }
          }      
      }
  }
?>
