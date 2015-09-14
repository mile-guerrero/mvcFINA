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
* @category: modulo de cliente.
*/
class verActionClass extends controllerClass implements controllerActionInterface {

  
  /**
* @author: Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon .
* @date: fecha de inicio del desarrollo.
* @return   presupuestoHistoricoTableClass::ID retorna (integer),
            presupuestoHistoricoTableClass::NOMBRE retorna  (string),
            presupuestoHistoricoTableClass::APELLIDO retorna  (string),
            presupuestoHistoricoTableClass::DOCUMENTO retorna  (integer),
            presupuestoHistoricoTableClass::DIRECCION retorna  (string),
            presupuestoHistoricoTableClass::TELEFONO retorna  (integer),
            presupuestoHistoricoTableClass::ID_TIPO_ID retorna (integer),
            presupuestoHistoricoTableClass::ID_CIUDAD retorna  (integer),
            presupuestoHistoricoTableClass::UPDATE_AT retorna  (timestamp),
 * estos datos retornan en la variable $fields el $id retorna en la variable $WHERE
*/
  public function execute() {
    try {
      $fields = array(
          presupuestoHistoricoTableClass::ID,
          presupuestoHistoricoTableClass::LOTE_ID,
          presupuestoHistoricoTableClass::TOTAL_PAGO_TRABAJADOR,
          presupuestoHistoricoTableClass::PRODUCTO_INSUMO_ID, 
          presupuestoHistoricoTableClass::TOTAL_PRODUCCION, 
          presupuestoHistoricoTableClass::PRESUPUESTO
      );
      
       $where = array(
            presupuestoHistoricoTableClass::ID => request::getInstance()->getRequest(presupuestoHistoricoTableClass::ID)
        );
      $this->objPresupuestoHistorico = presupuestoHistoricoTableClass::getAll($fields, true, null, null, null, null, $where);
      
     
      $this->defineView('ver', 'presupuestoHistorico', session::getInstance()->getFormatOutput());
    }//cierre del try
     catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }//cierre del catch
}//cierre de la funcion execute

}//cierre de la clase
