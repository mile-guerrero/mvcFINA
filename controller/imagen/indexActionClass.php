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
        
        //llamar la funcion validateInsert()
       // validator::validateInsert();

//        echo "<pre>";
//        print_r($file);
//        echo "</pre>";
        
      $ext = substr($file['name'], -3,3);
      $nameFile = md5($file['name'] . strtotime(date(config::getFormatTimestamp()))) . '.' . $ext;
       move_uploaded_file($file['tmp_name'], config::getPathAbsolute() . 'web/uploadImagen/' . $nameFile);//para insertar en la carpeta
       
      // unlink(config::getPathAbsolute() . 'web/uploadImagen/9b56b8f83c0a37908320d3445429edf8.jpg'); //aqui es para eliminar un archivo

//        exit();
     
       //echo '<img src="' . routing::getInstance()->getUrlImg('../uploadArchivo/' . $nameFile) . '"/>';
       $this->nameFile = md5($file['name'] . strtotime(date(config::getFormatTimestamp()))) . '.' . $ext;
      }
      
      $this->defineView('index', 'imagen', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
}

}
