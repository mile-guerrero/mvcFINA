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
      $ext = substr($file['name'], -3,3);
      $nameFile = md5($file['name'] . strtotime(date(config::getFormatTimestamp()))) . '.' . $ext;
     echo $tamano_archivo = substr($file['size'], -6, 6);
     print_r ($file);
       move_uploaded_file($file['tmp_name'], config::getPathAbsolute() . 'web/updateVideo/' . $nameFile);//para insertar en la carpeta
      // unlink(config::getPathAbsolute() . 'web/updateVideo/9b56b8f83c0a37908320d3445429edf8.jpg'); //aqui es para eliminar un archivo
//    if ($ext == "mp3") {
//            if (move_uploaded_file($file['tmp_name'], config::getPathAbsolute() . 'web/updateVideo/' . $nameFile)&& ($tamano_archivo < 1000000)) {
//
//            session::getInstance()->setSuccess('El archivo subio correctamente');
//          } else {
//            session::getInstance()->setError('Hubo un error al grabar el archivo');
//          }
//
//        }else {
//          session::getInstance()->setError('No es un tipo de archivo válido');
//        }
//       
      }
      
      $this->defineView('index', 'video', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
}

}
