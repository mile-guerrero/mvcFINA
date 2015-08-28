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

      //$this->mensaje = 'Hola a todos';
      $where = null;
      $where = session::getInstance()->getAttribute('graficaWhere');
//      print_r($where);
//     exit();
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

      
//      $fields = array(
//          historialTableClass::ID,
//            historialTableClass::PRODUCTO_INSUMO_ID,
//          historialTableClass::LOTE_ID,
//            historialTableClass::ENFERMEDAD_ID,
//          historialTableClass::CREATED_AT 
//      );
//      $orderBy = array(
//      historialTableClass::ID   
//      ); 
//      
//      $this->objHistorial = historialTableClass::getAll($fields, false, $orderBy, 'ASC',null,null,$where);

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