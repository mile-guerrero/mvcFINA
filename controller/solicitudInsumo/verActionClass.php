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
          solicitudInsumoTableClass::ID,
          solicitudInsumoTableClass::FECHA_HORA,
          solicitudInsumoTableClass::TRABAJADOR_ID,
          solicitudInsumoTableClass::CANTIDAD,
          solicitudInsumoTableClass::PRODUCTO_INSUMO_ID,
          solicitudInsumoTableClass::LOTE_ID,
          solicitudInsumoTableClass::UNIDAD_MEDIDA_ID,
          solicitudInsumoTableClass::CREATED_AT,
          solicitudInsumoTableClass::UPDATED_AT,
          solicitudInsumoTableClass::DELETED_AT
      );

      $where = array(
          solicitudInsumoTableClass::ID => request::getInstance()->getRequest(solicitudInsumoTableClass::ID)
      );
      $this->objS = solicitudInsumoTableClass::getAll($fields, true, null, null, null, null, $where);

      $this->defineView('ver', 'solicitudInsumo', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}
