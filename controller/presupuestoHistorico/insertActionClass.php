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
class insertActionClass extends controllerClass implements controllerActionInterface {

/**
* @author: Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon .
* @date: fecha de inicio del desarrollo.
* @return   ciudadTableClass::ID retorna (integer),
            ciudadTableClass::NOMBRE_CIUDAD retorna  (string),
            tipoIdTableClass::ID retorna  (string),
            tipoIdTableClass::DESCRIPCION retorna  (string),            
 * estos datos retornan en la variable $fields
*/
  public function execute() {
    try {
     $fields = array(
            tipoProductoInsumoTableClass::ID,
            tipoProductoInsumoTableClass::DESCRIPCION
        );
        $orderBy = array(
            tipoProductoInsumoTableClass::DESCRIPCION
        );
        $this->objTipo = tipoProductoInsumoTableClass::getAll($fields, true, $orderBy, 'ASC');

      $fields = array(     
      loteTableClass::ID, 
      loteTableClass::UBICACION
      );
      $orderBy = array(
      loteTableClass::UBICACION    
      ); 
      $this->objLote = loteTableClass::getAll($fields, true, $orderBy, 'ASC');
      
      $this->defineView('insert', 'presupuestoHistorico', session::getInstance()->getFormatOutput());
    }//cierre del try
      catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }//cierre del catch
}//cierre de la funcion execute

}//cierre de la clase
