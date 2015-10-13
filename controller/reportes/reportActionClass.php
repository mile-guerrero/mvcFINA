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
      
      $this->fechaInicial = session::getInstance()->getAttribute('graficaRFecha1');
       $this->fechaFin = session::getInstance()->getAttribute('graficaRFecha2');
//       $this->idProducto = session::getInstance()->getAttribute('Trabajador');
      
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
       $this->fechaInicial = session::getInstance()->getAttribute('TrabajadorFechaInicial');
       $this->fechaFin = session::getInstance()->getAttribute('TrabajadorFechaFin');
       $this->idTrabajador = session::getInstance()->getAttribute('Trabajador');
       $this->where = session::getInstance()->getAttribute('graficaWhere');
        $this->mensaje3 = 'Informacion de pago a trabajadores';
        
        
       $fields = array(
          pagoTrabajadorTableClass::ID,
          pagoTrabajadorTableClass::FECHA_INICIAL,
          pagoTrabajadorTableClass::FECHA_FINAL,
          pagoTrabajadorTableClass::EMPRESA_ID,
          pagoTrabajadorTableClass::TRABAJADOR_ID,
          pagoTrabajadorTableClass::VALOR_SALARIO,
          pagoTrabajadorTableClass::HORAS_PERDIDAS,
          pagoTrabajadorTableClass::TOTAL_PAGAR
      );
      $orderBy = array(
          pagoTrabajadorTableClass::ID
      );
      $this->objPTrabajador = pagoTrabajadorTableClass::getAll($fields, false, $orderBy, 'ASC', null, null, $where); 
//      print_r($objPTrabajador);
//            exit();
      
            
     }

 if ($value == 4){
       $where = session::getInstance()->getAttribute('graficaWhereAno');
       
       $this->mensaje4 = 'Informacion del presupuesto historico';
       $fields = array(
            registroLoteTableClass::UBICACION,
            registroLoteTableClass::PRODUCTO_INSUMO_ID,
            registroLoteTableClass::ID,
            registroLoteTableClass::FECHA_RIEGO,
            registroLoteTableClass::PRODUCCION,
            registroLoteTableClass::PRESUPUESTO,
            registroLoteTableClass::CREATED_AT
        );
        $orderBy = array(
//            registroLoteTableClass::ID,
            registroLoteTableClass::PRODUCCION
        );
        $this->objPresupuesto = registroLoteTableClass::getAll($fields, false, $orderBy, 'ASC', null, null, $where);
     }
          
     if ($value == 4){
      $where = session::getInstance()->getAttribute('graficaWhereTrabajadorAno');
     $fields = array(
            pagoTrabajadorTableClass::ID,
            pagoTrabajadorTableClass::TOTAL_PAGAR,
            pagoTrabajadorTableClass::FECHA_INICIAL
        );
        $orderBy = array(
//            registroLoteTableClass::ID,
            pagoTrabajadorTableClass::FECHA_INICIAL
        );
        $this->objPagoTrabajador = pagoTrabajadorTableClass::getAll($fields, false, $orderBy, 'ASC', null, null, $where);
     }
     
     //------------------------------------------------------------------------------
     
     
     if ($value == 4){
       $where = session::getInstance()->getAttribute('graficaWhere');
       
       $this->mensaje4 = 'Informacion del presupuesto historico';
       $fields = array(
            registroLoteTableClass::UBICACION,
            registroLoteTableClass::PRODUCTO_INSUMO_ID,
            registroLoteTableClass::ID,
            registroLoteTableClass::FECHA_RIEGO,
            registroLoteTableClass::PRODUCCION,
            registroLoteTableClass::PRESUPUESTO,
            registroLoteTableClass::CREATED_AT
        );
        $orderBy = array(
//            registroLoteTableClass::ID,
            registroLoteTableClass::PRODUCCION
        );
        $this->objPresupuesto2 = registroLoteTableClass::getAll($fields, false, $orderBy, 'ASC', null, null, $where);
     }
     
     
     if ($value == 4){
      $where = session::getInstance()->getAttribute('graficaWhereTrabajador');
     $fields = array(
            pagoTrabajadorTableClass::ID,
         pagoTrabajadorTableClass::TOTAL_PAGAR,
            pagoTrabajadorTableClass::FECHA_INICIAL
        );
        $orderBy = array(
//            registroLoteTableClass::ID,
            pagoTrabajadorTableClass::FECHA_INICIAL
        );
        $this->objPagoTrabajador2 = pagoTrabajadorTableClass::getAll($fields, false, $orderBy, 'ASC', null, null, $where);
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