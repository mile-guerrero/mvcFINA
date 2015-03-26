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
class reportLoteActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      
      //$this->mensaje = 'Hola a todos';
     
      
      $fields = array(
          loteTableClass::ID,
          loteTableClass::UBICACION,
          loteTableClass::TAMANO,
          loteTableClass::DESCRIPCION,
          loteTableClass::CREATED_AT,
          loteTableClass::UPDATED_AT
      );
      $orderBy = array(
         loteTableClass::ID
      );
      $this->objLote = loteTableClass::getAll($fields, true, $orderBy, 'ASC');

       
       

      
      
      $this->defineView('indexLote', 'lote', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo '<pre>';
      print_r($exc->getTrace());
      echo '</pre>';
    }
  }

}
