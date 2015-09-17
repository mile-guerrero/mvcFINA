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
class reportActionClass extends controllerClass implements controllerActionInterface {

  /**
   * @author: Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon .
   * @date: fecha de inicio del desarrollo.
   * @return   usuarioTableClass::ID retorna (integer),
    usuarioTableClass::USUARIO retorna  (string),
    usuarioTableClass::CREATED_AT retorna  (timestamp),
    usuarioTableClass::ACTIVED retorna  (integer),
   * estos datos retornan en la variable $fields
   */
  public function execute() {
    try {

      $where = null;
      $where = session::getInstance()->getAttribute('graficaWhere');
      $value = session::getInstance()->getAttribute('idGrafica');
     if ($value == 1 or $value == 2) {
      $this->mensaje = 'Informacion de Producción';
      $this->mensaje1 = 'Informacion de Lotes';
      $fields = array(
          registroLoteTableClass::UBICACION,
          registroLoteTableClass::PRODUCCION,
          registroLoteTableClass::UNIDAD_MEDIDA_ID,
          registroLoteTableClass::CREATED_AT,
          registroLoteTableClass::PRODUCTO_INSUMO_ID,
          registroLoteTableClass::NUMERO_PLANTULAS,
          registroLoteTableClass::FECHA_RIEGO,
      );
      $orderBy = array(
          registroLoteTableClass::PRODUCCION
      );
      $this->objLote = registroLoteTableClass::getAll($fields, false, $orderBy, 'ASC', null, null, $where);
     }
      
     
     if ($value == 3){
       $this->idTrabajador = session::getInstance()->getAttribute('Trabajador');
       
        $this->mensaje3 = 'Informacion de pago a trabajadores';
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
      $orderBy = array(
          pagoTrabajadorTableClass::ID
      );
      $this->objPTrabajador = pagoTrabajadorTableClass::getAll($fields, false, $orderBy, 'ASC', null, null, $where);       
     }

 if ($value == 4){
       $where = session::getInstance()->getAttribute('graficaWhere');
       
       $this->mensaje4 = 'Informacion del presupuesto historico';
       $fields = array(
            presupuestoHistoricoTableClass::LOTE_ID,
            presupuestoHistoricoTableClass::PRODUCTO_INSUMO_ID,
            presupuestoHistoricoTableClass::ID,
            presupuestoHistoricoTableClass::TOTAL_PAGO_TRABAJADOR,
            presupuestoHistoricoTableClass::TOTAL_PRODUCCION,
            presupuestoHistoricoTableClass::PRESUPUESTO,
            presupuestoHistoricoTableClass::CREATED_AT
        );
        $orderBy = array(
//            presupuestoHistoricoTableClass::ID,
            presupuestoHistoricoTableClass::TOTAL_PRODUCCION
        );
        $this->objPresupuesto = presupuestoHistoricoTableClass::getAll($fields, true, $orderBy, 'ASC', null, null, $where);
     }
     
     if ($value == 4){
       $whereAno = session::getInstance()->getAttribute('graficaWhereAno');
       
       $this->mensaje5 = 'Informacion del presupuesto historico año anterior';
       $fields = array(
            presupuestoHistoricoTableClass::LOTE_ID,
            presupuestoHistoricoTableClass::PRODUCTO_INSUMO_ID,
            presupuestoHistoricoTableClass::ID,
            presupuestoHistoricoTableClass::TOTAL_PAGO_TRABAJADOR,
            presupuestoHistoricoTableClass::TOTAL_PRODUCCION,
            presupuestoHistoricoTableClass::PRESUPUESTO,
            presupuestoHistoricoTableClass::CREATED_AT
        );
        $orderBy = array(
//            presupuestoHistoricoTableClass::ID,
            presupuestoHistoricoTableClass::TOTAL_PRODUCCION
        );
        $this->objPresupuesto2 = presupuestoHistoricoTableClass::getAll($fields, true, $orderBy, 'ASC', null, null, $whereAno);
     }
      $this->defineView('index', 'reportes', session::getInstance()->getFormatOutput());
    } //cierre del try
    catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo '<pre>';
      print_r($exc->getTrace());
      echo '</pre>';
    }//cierre del catch
  }

//cierre de la funcion execute
}

//cierre de la clase