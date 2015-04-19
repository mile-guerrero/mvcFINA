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
class editClienteActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {

      if (request::getInstance()->hasRequest(clienteTableClass::ID)) {
       $fields = array(
          clienteTableClass::ID,
          clienteTableClass::NOMBRE,
          clienteTableClass::APELLIDO,
          clienteTableClass::DOCUMENTO,
          clienteTableClass::DIRECCION,
          clienteTableClass::TELEFONO,
          clienteTableClass::ID_TIPO_ID,
          clienteTableClass::ID_CIUDAD
        );
        $where = array(
            clienteTableClass::ID => request::getInstance()->getRequest(clienteTableClass::ID)
        );
        $this->objCliente = clienteTableClass::getAll($fields, true, null, null, null, null, $where);
        
        
        $fields = array(
      tipoIdTableClass::ID,
      tipoIdTableClass::DESCRIPCION
      );
      $orderBy = array(
      tipoIdTableClass::DESCRIPCION   
      );      
      $this->objCTI = tipoIdTableClass::getAll($fields, false, $orderBy, 'ASC');
      
      $fields = array(     
      ciudadTableClass::ID, 
      ciudadTableClass::NOMBRE_CIUDAD
      );
      $orderBy = array(
      ciudadTableClass::NOMBRE_CIUDAD    
      ); 
      $this->objCC = ciudadTableClass::getAll($fields, false, $orderBy, 'ASC');

        
        
        $this->defineView('editCliente', 'cliente', session::getInstance()->getFormatOutput());
        
      }else{
        routing::getInstance()->redirect('cliente', 'indexCliente');
      }

    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}
