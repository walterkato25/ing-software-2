
<?php
require_once("sesion.php");
sesion();
if(!(isset($_SESSION["categoria"])) || ($_SESSION["categoria"]!="administrador")){
    header("location:../index.php");
}
if( !isset($_FILES['archivo']) ){
  echo '<script language="javascript"> alert("Ha habido un error, tienes que elegir un archivo"); self.history.back();</script>';
}else{
 
  $nombre = $_FILES['archivo']['name'];
  $nombre_tmp = $_FILES['archivo']['tmp_name'];
  $tipo = $_FILES['archivo']['type'];
  $tamano = $_FILES['archivo']['size'];
 
  $ext_permitidas = array('jpg','jpeg','gif','png', 'JPG', 'JPEG', 'GIF', 'PNG');
  $partes_nombre = explode('.', $nombre);
  $extension = end( $partes_nombre );
  $ext_correcta = in_array($extension, $ext_permitidas);
 
  $tipo_correcto = preg_match('/^image\/(pjpeg|jpeg|gif|png)$/', $tipo);
 
 
  if( $ext_correcta && $tipo_correcto ){
    if( $_FILES['archivo']['error'] > 0 ){
      $error= $_FILES['archivo']['error'];
      echo "<script language='javascript'>
              alert('Error: $error');
              self.history.back();
            </script>";
      
    }else{
      echo "<script language='javascript'>
              alert('Nombre: $nombre \\n Tipo: $tipo \\n Tamaño: ".number_format(($tamano / 1024),2)." Kb');
              </script>";
       
      if( file_exists( '../portadas/'.$nombre) ){
        echo "<script language='javascript'>
              alert('El archivo ya existe: $nombre');
              self.history.back();
              </script>";
      }else{
        move_uploaded_file($nombre_tmp, "../portadas/" . $nombre);
         
        echo "<script language='javascript'> 
              alert('Guardado en: portadas/$nombre');        
              self.history.go(-2);
              </script>";
      }
    }
  }else{
    echo "<script language='javascript'>
              alert('Archivo inválido: $nombre');
              self.history.back();
              </script>";
  }
}
?>