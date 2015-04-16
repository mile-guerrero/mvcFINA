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
class verLoteActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      $fields = array(
          loteTableClass::ID,
          loteTableClass::UBICACION,
          loteTableClass::TAMANO,
          loteTableClass::UNIDAD_DISTANCIA_ID,
          loteTableClass::DESCRIPCION,
          loteTableClass::FECHA_INICIO_SIEMBRA,
          loteTableClass::NUMERO_PLANTULAS,
          loteTableClass::PRESUPUESTO,
          loteTableClass::PRODUCTO_INSUMO_ID,
          loteTableClass::ID_CIUDAD, 
          loteTableClass::CREATED_AT,
          loteTableClass::UPDATED_AT
      );
      
       $where = array(
            loteTableClass::ID => request::getInstance()->getRequest(loteTableClass::ID)
        );
      $this->objLote = loteTableClass::getAll($fields, true, null, null, null, null, $where);

      
      $this->defineView('verLote', 'lote', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
}

}
