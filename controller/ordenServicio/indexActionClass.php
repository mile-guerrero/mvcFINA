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
class indexActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      $fields = array(
          ordenServicioTableClass::ID,
          ordenServicioTableClass::FECHA_MANTENIMIENTO,
          ordenServicioTableClass::TRABAJADOR_ID,
          ordenServicioTableClass::PRODUCTO_INSUMO_ID,
          ordenServicioTableClass::CANTIDAD,
          ordenServicioTableClass::VALOR,
          ordenServicioTableClass::MAQUINA_ID,
          ordenServicioTableClass::CREATED_AT,
          ordenServicioTableClass::UPDATED_AT
      );
      $orderBy = array(
         ordenServicioTableClass::ID
      );
      $this->objOS = ordenServicioTableClass::getAll($fields,false, $orderBy,'ASC');
      
       
      $this->defineView('index', 'ordenServicio', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
}

}
