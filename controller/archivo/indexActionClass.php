<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of ejemploClass
 *
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon
 */
class indexActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {

      if (request::getInstance()->isMethod('POST')) {

        $file = request::getInstance()->getFile(usuarioTableClass::getNameField(usuarioTableClass::USUARIO, true));
//        print_r($file);
        $ext = substr($file['name'], -3);
       
        $tamano_archivo = substr($file['size'], -6, 6);
        $nameFile = md5($file['name'] . strtotime(date(config::getFormatTimestamp()))) . '.' . $ext;
        // move_uploaded_file($file['tmp_name'], config::getPathAbsolute() . 'web/uploadArchivo/' . $nameFile);//para insertar en la carpeta
        // unlink(config::getPathAbsolute() . 'web/uploadArchivo/9b56b8f83c0a37908320d3445429edf8.jpg'); //aqui es para eliminar un archivo
        if ($ext == "txt" || $ext == "pdf" || $ext == "zip" || $ext == "doc") {
          if (move_uploaded_file($file['tmp_name'], config::getPathAbsolute() . 'web/uploadArchivo/' . $nameFile)&& ($tamano_archivo <= 1000000)) {
//            $nameFile = md5($file['name'] . strtotime(date(config::getFormatTimestamp()))) . '.' . $ext;
            session::getInstance()->setSuccess('El archivo subio correctamente');
          } else {
            session::getInstance()->setError('Hubo un error al grabar el archivo');
          }

          //echo '<img src="' . routing::getInstance()->getUrlImg('../uploadArchivo/' . $nameFile) . '"/>';
//        $this->nameFile = md5($file['name'] . strtotime(date(config::getFormatTimestamp()))) . '.' . $ext;
        } else if ($ext == "ocx") {   //solo para word            
          if (move_uploaded_file($file['tmp_name'], config::getPathAbsolute() . 'web/uploadArchivo/' . $nameFile)&& ($tamano_archivo < 1000000)) {
            $newExt = 'docx';
            $newNameFile = md5($file['name'] . strtotime(date(config::getFormatTimestamp()))) . '.' . $newExt;
            $newname = config::getPathAbsolute() . 'web/uploadArchivo/' . $newNameFile;
            rename(config::getPathAbsolute() . 'web/uploadArchivo/' . $nameFile, $newname); //solo para word
            session::getInstance()->setSuccess('El archivo subio correctamente');
          } else {
            session::getInstance()->setError('Hubo un error al grabar el archivo');
          }
        } else if ($ext == "lsx") {   //solo para exel            
          if (move_uploaded_file($file['tmp_name'], config::getPathAbsolute() . 'web/uploadArchivo/' . $nameFile)&& ($tamano_archivo < 1000000)) {
            $newExt = 'xlsx';
            $newNameFile = md5($file['name'] . strtotime(date(config::getFormatTimestamp()))) . '.' . $newExt;
            $newname = config::getPathAbsolute() . 'web/uploadArchivo/' . $newNameFile;
            rename(config::getPathAbsolute() . 'web/uploadArchivo/' . $nameFile, $newname); //solo para exel
            session::getInstance()->setSuccess('El archivo subio correctamente');
          } else {
            session::getInstance()->setError('Hubo un error al grabar el archivo');
          }
        } else {
          session::getInstance()->setError('No es un tipo de archivo válido');
        }
      }//fin if principal -------------------------------------------------------
//hacer una condicion de asimilar la extencion con una imagen 
//      if($ext == 'pdf'){
//      echo '<img src="' . routing::getInstance()->getUrlImg('../img/reporte.gif') . '"/>' ;         
//      }
 
      
   //---------------------------------------------------------------------------   
//  if ($directorio = opendir("./uploadArchivo")){ //ruta actual
//while ($archivo = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
//{
//    if ($archivo != '.' && $archivo != '..')//verificamos si es o no un directorio
//    {
//     echo "Archivo: <strong>  $archivo </strong><br />" ; 
//       }
//
//     }
//  
//    }
      
      //------------------------------------------------------------------------
      $this->defineView('index', 'archivo', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}
