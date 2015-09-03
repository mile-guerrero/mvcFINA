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
 * @author 
 */
class verActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      $fields = array(
          pagoTrabajadorTableClass::ID,
          pagoTrabajadorTableClass::FECHA_INICIAL,
          pagoTrabajadorTableClass::FECHA_FINAL,
          pagoTrabajadorTableClass::EMPRESA_ID,
          pagoTrabajadorTableClass::TRABAJADOR_ID,
          pagoTrabajadorTableClass::VALOR_SALARIO,
          pagoTrabajadorTableClass::HORAS_PERDIDAS,
          pagoTrabajadorTableClass::TOTAL_PAGAR,
          pagoTrabajadorTableClass::CREATED_AT,
          pagoTrabajadorTableClass::UPDATED_AT
      );
      
       $where = array(
            pagoTrabajadorTableClass::ID => request::getInstance()->getRequest(pagoTrabajadorTableClass::ID)
        );
      $this->objPT = pagoTrabajadorTableClass::getAll($fields, false, null, null, null, null, $where);
//     $orderBy = array(
//         usuarioTableClass::ID
//      );
//      $this->objUsuarios = usuarioTableClass::getAll($fields, true, $orderBy);

      $this->defineView('ver', 'pagoTrabajador', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
}

}
