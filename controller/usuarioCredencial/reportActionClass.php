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
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class reportActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      
      //$this->mensaje = 'Hola a todos';
     
      
     $fields = array(
          usuarioCredencialTableClass::ID, 
          usuarioCredencialTableClass::USUARIO_ID,
          usuarioCredencialTableClass::CREDENCIAL_ID,
          usuarioCredencialTableClass::CREATED_AT
      );
      $orderBy = array(
      usuarioCredencialTableClass::ID   
      ); 
      
      $this->objUC = usuarioCredencialTableClass::getAll($fields, false, $orderBy, 'ASC');
$fields = array(
          usuarioTableClass::ID,
          usuarioTableClass::USUARIO
      );
      
      $this->objU = usuarioTableClass::getAll($fields, true);
$fields = array(
          credencialTableClass::ID,
          credencialTableClass::NOMBRE
      );
      
      $this->objC = credencialTableClass::getAll($fields, true);

    
      $this->defineView('index', 'usuarioCredencial', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo '<pre>';
      print_r($exc->getTrace());
      echo '</pre>';
    }
  }

}
