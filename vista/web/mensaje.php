<?php
  $mail="yon_keynes95@gmail.com";
  $nombre = $_POST["nombre"];
  $telefono = $_POST["telefono"];
  $email = $_POST["email"];
  $mensaje = $_POST["mensaje"];
  $thank="";
  $message = "
  nombre:".$nombre."
  pais:".$pais."
  email:".$email."
  mensaje:".$mensaje."";
  if (mail ($mail,"contactenos",$message)) Header ("location: $thank" );
 ?>

