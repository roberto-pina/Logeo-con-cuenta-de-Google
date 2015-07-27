<?php

class Usuario_api {

  //Funcion que verifica si el usuario ya esta registrado en la BD, de no ser asi, inserta sus datos. 
  //Se crea la sesion del usuario.
  public function login (){

    $dao = DAOFactory::getUsuarioDAO();    
    $GoogleID = $_POST['GoogleID'];    
    $GoogleName = $_POST['GoogleName'];    
    $GoogleImageURL = $_POST['GoogleImageURL'];    
    $GoogleEmail = $_POST['GoogleEmail'];
    $usuario = $dao->queryByGoogle($GoogleID);    
    if ($usuario == null){
      $usuario = new Usuario();
      $usuario->google = $GoogleID;
      $usuario->nombre = $GoogleName;
      $usuario->avatar = $GoogleImageURL;
      $usuario->correo = $GoogleEmail;
      print $dao->insert($usuario);
      $_SESSION[USUARIO] = serialize($usuario);
      //$usuario = unserialize($_SESSION[USUARIO]);
    } else {
        $_SESSION[USUARIO] = serialize($usuario);
    }
  }

}