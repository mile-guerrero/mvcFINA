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
class insertLoteActionClass extends controllerClass implements controllerActionInterface {

  
  /**
* @author: Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon .
* @date: fecha de inicio del desarrollo.
* @return   ciudadTableClass::ID retorna (integer),
            ciudadTableClass::NOMBRE_CIUDAD retorna  (string),
            unidadDistanciaTableClass::ID (integer)  , 
            unidadDistanciaTableClass::DESCRIPCION (string)  
            productoInsumoTableClass::ID  (integer) , 
            productoInsumoTableClass::DESCRIPCION    (string)   

    
            
 * estos datos retornan en la variable $fields
*/
  public function execute() {
    try {
         $fields = array(     
      unidadDistanciaTableClass::ID, 
      unidadDistanciaTableClass::DESCRIPCION
      );
      $orderBy = array(
      unidadDistanciaTableClass::DESCRIPCION    
      ); 
      $this->objLUD = unidadDistanciaTableClass::getAll($fields, false, $orderBy, 'ASC');
     
        
        
        $fields = array(     
      ciudadTableClass::ID, 
      ciudadTableClass::NOMBRE_CIUDAD
      );
      $orderBy = array(
      ciudadTableClass::NOMBRE_CIUDAD    
      ); 
      $this->objLC = ciudadTableClass::getAll($fields, false, $orderBy, 'ASC');
     
      $fields = array(     
      productoInsumoTableClass::ID, 
      productoInsumoTableClass::DESCRIPCION
      );
      $orderBy = array(
      productoInsumoTableClass::DESCRIPCION    
      ); 
      $this->objLPI = productoInsumoTableClass::getAll($fields, true, $orderBy, 'ASC');
     
      $this->defineView('insertLote', 'lote', session::getInstance()->getFormatOutput());
    }//cierre del try
      catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
  }//cierre del catch
}//cierre de la funcion execute

}//cierre de la clase