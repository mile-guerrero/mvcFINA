
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
   
      if (request::getInstance()->hasGet(empresaTableClass::ID)) {
        $fields = array(
            empresaTableClass::ID,
            empresaTableClass::NOMBRE,
            empresaTableClass::DIRECCION,
            empresaTableClass::TELEFONO,
            empresaTableClass::EMAIL,
            
        );
        $where = array(
            empresaTableClass::ID => request::getInstance()->getGet(empresaTableClass::ID)
        );
        $this->objEmpresa = empresaTableClass::getAll($fields, true, null, null, null, null, $where);
        
      
        $this->defineView('edit', 'empresa', session::getInstance()->getFormatOutput());
     
      }else{
        routing::getInstance()->redirect('empresa', 'index');
      }

    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}
