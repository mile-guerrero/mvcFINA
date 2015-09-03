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
     
      
       $id = array(
            registroLoteTableClass::ID => request::getInstance()->getRequest(registroLoteTableClass::ID)
        );
//        print_r($id); 
         session::getInstance()->setAttribute('idRegistro', $id);
//    exit();
      $fields = array(
          registroLoteTableClass::ID,
          registroLoteTableClass::UBICACION,
          registroLoteTableClass::CREATED_AT,
          registroLoteTableClass::PRODUCCION,
          registroLoteTableClass::FECHA_RIEGO,
          registroLoteTableClass::NUMERO_PLANTULAS,
          registroLoteTableClass::PRODUCTO_INSUMO_ID,
          registroLoteTableClass::UNIDAD_MEDIDA_ID
      );
      $orderBy = array(
          registroLoteTableClass::ID
      );
       

      $this->objLote = registroLoteTableClass::getAll($fields, false, $orderBy, 'ASC');
      
      $fields = array(
          loteTableClass::ID,
          loteTableClass::UBICACION,
      );
      $orderBy = array(
          loteTableClass::ID
      );
       

      $this->objLoteR = loteTableClass::getAll($fields, true, $orderBy, 'ASC');
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
