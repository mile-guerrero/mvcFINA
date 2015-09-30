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
class verActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      $fields = array(
          viveroTableClass::ID,
          viveroTableClass::FECHA_INICIAL,
          viveroTableClass::FECHA_FINAL,
          viveroTableClass::CANTIDAD,
          viveroTableClass::PRODUCTO_INSUMO_ID,
          viveroTableClass::CREATED_AT,
          viveroTableClass::UPDATED_AT,
          viveroTableClass::DELETED_AT
      );

      $where = array(
          viveroTableClass::ID => request::getInstance()->getRequest(viveroTableClass::ID)
      );
      $this->objVivero = viveroTableClass::getAll($fields, true, null, null, null, null, $where);

      $this->defineView('ver', 'vivero', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}
