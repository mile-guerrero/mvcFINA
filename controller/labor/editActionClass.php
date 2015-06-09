
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
   
     if (request::getInstance()->hasGet(laborTableClass::ID)) {
        $fields = array(
            laborTableClass::ID,
            laborTableClass::DESCRIPCION,
            laborTableClass::VALOR      
        );
        $where = array(
             laborTableClass::ID => request::getInstance()->getGet(laborTableClass::ID)
        );
        $this->objLabor = laborTableClass::getAll($fields, false, null, null, null, null, $where);
       
      
        $this->defineView('edit', 'labor', session::getInstance()->getFormatOutput());
     
      }else{
        routing::getInstance()->redirect('labor', 'index');
      }

    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}
