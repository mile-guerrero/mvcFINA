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
class insertActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      $fields = array(
      trabajadorTableClass::ID,
      trabajadorTableClass::NOMBRET
      );
      $orderBy = array(
      trabajadorTableClass::NOMBRET   
      );      
      $this->objOST = trabajadorTableClass::getAll($fields, true, $orderBy, 'ASC');
    
           
      $fields = array(
          loteTableClass::ID,
          loteTableClass::UBICACION
      );
      $orderBy = array(
      loteTableClass::UBICACION   
      );      
      $this->objLote = loteTableClass::getAll($fields, true, $orderBy, 'ASC');
    
      $fields = array(
      maquinaTableClass::ID,
      maquinaTableClass::NOMBRE
      );
      $orderBy = array(
      maquinaTableClass::NOMBRE   
      );      
      $this->objOSM = maquinaTableClass::getAll($fields, true, $orderBy, 'ASC');
      
      $fields = array(
          unidadDistanciaTableClass::ID,
          unidadDistanciaTableClass::DESCRIPCION
      );
      $orderBy = array(
          unidadDistanciaTableClass::DESCRIPCION   
      );      
      $this->objUnidadDistancia = unidadDistanciaTableClass::getAll($fields, false, $orderBy, 'ASC');
    
      $this->defineView('insert', 'ordenServicio', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
}

}
