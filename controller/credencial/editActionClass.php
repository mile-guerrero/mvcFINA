
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
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class editActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
   
      if (request::getInstance()->hasRequest(credencialTableClass::ID)) {
        $fields = array(
            credencialTableClass::ID,
            credencialTableClass::NOMBRE
        );
        $where = array(
            credencialTableClass::ID => request::getInstance()->getRequest(credencialTableClass::ID)
        );
        $this->objCredencial = credencialTableClass::getAll($fields, true, null, null, null, null, $where);
        $this->defineView('edit', 'credencial', session::getInstance()->getFormatOutput());
     
      }else{
        routing::getInstance()->redirect('credencial', 'index');
      }

    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}
