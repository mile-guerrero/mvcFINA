
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
class editActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
   
      if (request::getInstance()->hasGet(cooperativaTableClass::ID)) {
        $fields = array(
            cooperativaTableClass::ID,
            cooperativaTableClass::NOMBRE,
            cooperativaTableClass::DESCRIPCION,
            cooperativaTableClass::DIRECCION,
            cooperativaTableClass::TELEFONO,
            cooperativaTableClass::ID_CIUDAD
        );
        $where = array(
            cooperativaTableClass::ID => request::getInstance()->getGet(cooperativaTableClass::ID)
        );
        $this->objCooperativa = cooperativaTableClass::getAll($fields, true, null, null, null, null, $where);
        
        $fields = array(     
      ciudadTableClass::ID, 
      ciudadTableClass::NOMBRE_CIUDAD
      );
      $orderBy = array(
      ciudadTableClass::NOMBRE_CIUDAD    
      ); 
      $this->objCC = ciudadTableClass::getAll($fields, false, $orderBy, 'ASC');
        
        $this->defineView('edit', 'cooperativa', session::getInstance()->getFormatOutput());
     
      }else{
        routing::getInstance()->redirect('cooperativa', 'index');
      }

    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}
