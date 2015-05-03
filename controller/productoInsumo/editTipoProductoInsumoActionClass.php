
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
class editTipoProductoInsumoActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {

      if (request::getInstance()->hasGet(tipoProductoInsumoTableClass::ID)) {
        $fields = array(
            tipoProductoInsumoTableClass::ID,
            tipoProductoInsumoTableClass::DESCRIPCION,
        );
        $where = array(
            tipoProductoInsumoTableClass::ID => request::getInstance()->getGet(tipoProductoInsumoTableClass::ID)
        );
        $this->objTPI = tipoProductoInsumoTableClass::getAll($fields, true, null, null, null, null, $where);
        $this->defineView('editTipoProductoInsumo', 'productoInsumo', session::getInstance()->getFormatOutput());
        
      }else{
        routing::getInstance()->redirect('productoInsumo', 'indexTipoProductoInsumo');
      }

    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}
