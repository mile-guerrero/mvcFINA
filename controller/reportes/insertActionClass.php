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
 * @category: modulo de defautl.
 */
class insertActionClass extends controllerClass implements controllerActionInterface {

  /**
   * @author: Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon .
   * @date: fecha de inicio del desarrollo.
   * @return               
   * define la vista  y la accion en la variable $defineView
   */
  public function execute() {
    try {
      $fields = array(
          loteTableClass::ID,
          loteTableClass::UBICACION,
          loteTableClass::CREATED_AT,
          loteTableClass::TAMANO,
          loteTableClass::UNIDAD_DISTANCIA_ID,
          loteTableClass::DESCRIPCION,
          loteTableClass::FECHA_INICIO_SIEMBRA,
          loteTableClass::NUMERO_PLANTULAS,
          loteTableClass::PRESUPUESTO,
          loteTableClass::PRODUCTO_INSUMO_ID,
          loteTableClass::ID_CIUDAD,
          loteTableClass::UPDATED_AT
      );
      $orderBy = array(
          loteTableClass::ID
      );

      $this->objLote = loteTableClass::getAll($fields, true, $orderBy, 'ASC');
      $this->defineView('insert', 'reportes', session::getInstance()->getFormatOutput());
    } //cierre del try
    catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }//cierre del catch
  }

//cierre de la funcion execute
}

//cierre de la clase
