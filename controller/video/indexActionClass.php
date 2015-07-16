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

        $file = request::getInstance()->getFile(videoTableClass::getNameField(videoTableClass::NOMBRE, true));   
//        echo '<pre>';
//        print_r($file);
//        echo '</pre>';
//        exit();   
        $long = -3;
        
        
        $ext = substr($file['name'], $long);
       
        $sizeKB = $file['size'] / 1024;
       
        $nameFile = md5($file['name'] . strtotime(date(config::getFormatTimestamp()))) . '.' . $ext;
        
  
       if ($ext == "mp4") {
            if (move_uploaded_file($file['tmp_name'], config::getPathAbsolute() . 'web/uploadVideo/' . $nameFile)&& ($sizeKB < 4096)) {
            session::getInstance()->setSuccess('El archivo subio correctamente');
             $extencion = substr($file['name'], $long);
        $hash = $file['type'];
      
      $data = array(
            videoTableClass::NOMBRE => $file['name'],
            videoTableClass::EXTENCION => $ext,
            videoTableClass::HASH => $nameFile
        );
        videoTableClass::insert($data);
          } else {
            session::getInstance()->setError('Hubo un error al grabar el archivo');
          }

        }else {
          session::getInstance()->setError('No es un tipo de archivo válido');
        }
      
      }
     
      
      $this->defineView('index', 'video', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
}

}
