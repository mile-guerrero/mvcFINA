
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
   
      if (request::getInstance()->hasRequest(ordenServicioTableClass::ID)) {
        $fields = array(
            ordenServicioTableClass::ID,
            ordenServicioTableClass::FECHA_MANTENIMIENTO,
            ordenServicioTableClass::TRABAJADOR_ID
        );
        $where = array(
            ordenServicioTableClass::ID => request::getInstance()->getRequest(ordenServicioTableClass::ID)
        );
        $this->objOS = ordenServicioTableClass::getAll($fields, null, null, null, null, null, $where);
        $this->defineView('edit', 'ordenServicio', session::getInstance()->getFormatOutput());
     
      }else{
        routing::getInstance()->redirect('ordenServicio', 'index');
      }

    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}
