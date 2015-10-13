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
class verActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      $fields = array(
          ordenServicioTableClass::ID,
          ordenServicioTableClass::FECHA_MANTENIMIENTO,
          ordenServicioTableClass::CANTIDAD,
          ordenServicioTableClass::VALOR,
          ordenServicioTableClass::LOTE_ID,
          ordenServicioTableClass::MAQUINA_ID,
          ordenServicioTableClass::TRABAJADOR_ID,
          ordenServicioTableClass::UNIDAD_DISTANCIA_ID,
          ordenServicioTableClass::CREATED_AT,
          ordenServicioTableClass::UPDATED_AT
      );

      $where = array(
          ordenServicioTableClass::ID => request::getInstance()->getRequest(ordenServicioTableClass::ID)
      );
      $this->objOS = ordenServicioTableClass::getAll($fields, false, null, null, null, null, $where);
      $this->defineView('ver', 'ordenServicio', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}
