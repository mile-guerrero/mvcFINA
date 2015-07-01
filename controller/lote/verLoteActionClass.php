<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon 
 * @date: fecha de inicio del desarrollo.
 * @category: modulo de maquina.
 */
class verLoteActionClass extends controllerClass implements controllerActionInterface {

    /**
* @author: Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon .
* @date: fecha de inicio del desarrollo.
* @return   loteTableClass::ID (integer),
            loteTableClass::UBICACION (string),
            loteTableClass::TAMANO (integer),
            loteTableClass::UNIDAD_DISTANCIA_ID (integer),
            loteTableClass::DESCRIPCION (string),
            loteTableClass::FECHA_INICIO_SIEMBRA (timestamp),
            loteTableClass::NUMERO_PLANTULAS (integer),
            loteTableClass::PRESUPUESTO (integer),
            loteTableClass::PRODUCTO_INSUMO_ID (integer),
            loteTableClass::ID_CIUDAD (integer), 
            loteTableClass::CREATED_AT (timestamp),
            loteTableClass::UPDATED_AT (timestamp)
 * estos datos retornan en la variable $fields el $id retorna en la variable $WHERE
*/
  public function execute() {
    try {
      $fields = array(
          loteTableClass::ID,
          loteTableClass::UBICACION,
          loteTableClass::TAMANO,
          loteTableClass::UNIDAD_DISTANCIA_ID,
          loteTableClass::UNIDAD_MEDIDA_ID,
          loteTableClass::DESCRIPCION,
          loteTableClass::PRODUCCION,
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
    } //cierre del try
      catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
     }//cierre del catch
}//cierre de la funcion execute

}//cierre de la clase