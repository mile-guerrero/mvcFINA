
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
class editTipoIdActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
   
      if (request::getInstance()->hasRequest(tipoIdTableClass::ID)) {
        $fields = array(
            tipoIdTableClass::ID,
            tipoIdTableClass::DESCRIPCION 
        );
        $where = array(
            tipoIdTableClass::ID => request::getInstance()->getRequest(tipoIdTableClass::ID)
        );
        $this->objTI = tipoIdTableClass::getAll($fields, null,null, null, null, null, $where);
        $this->defineView('editTipoId', 'cliente', session::getInstance()->getFormatOutput());
     
      }else{
        routing::getInstance()->redirect('cliente', 'indexTipoId');
      }

    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}
