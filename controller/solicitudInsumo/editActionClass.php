
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
   
      if (request::getInstance()->hasGet(solicitudInsumoTableClass::ID)) {
        $fields = array(
            solicitudInsumoTableClass::ID,
            solicitudInsumoTableClass::FECHA_HORA,
            solicitudInsumoTableClass::TRABAJADOR_ID,
            solicitudInsumoTableClass::CANTIDAD,
            solicitudInsumoTableClass::PRODUCTO_INSUMO_ID,
            solicitudInsumoTableClass::LOTE_ID
        );
        $where = array(
            solicitudInsumoTableClass::ID => request::getInstance()->getGet(solicitudInsumoTableClass::ID)
        );
        $this->objS = solicitudInsumoTableClass::getAll($fields, true, null, null, null, null, $where);
        
        $fields = array(
            trabajadorTableClass::ID,
            trabajadorTableClass::NOMBRET
        );
        $orderBy = array(
            trabajadorTableClass::NOMBRET
        );
        $this->objT = trabajadorTableClass::getAll($fields, true, $orderBy, 'ASC');
        
        $fields = array(
            productoInsumoTableClass::ID,
            productoInsumoTableClass::DESCRIPCION
        );
        $orderBy = array(
            productoInsumoTableClass::DESCRIPCION
        );
        $this->objP = productoInsumoTableClass::getAll($fields, true, $orderBy, 'ASC');
        
        $fields = array(
            loteTableClass::ID,
            loteTableClass::DESCRIPCION
        );
        $orderBy = array(
            loteTableClass::DESCRIPCION
        );
        $this->objL = loteTableClass::getAll($fields, true, $orderBy, 'ASC');
        $this->defineView('edit', 'solicitudInsumo', session::getInstance()->getFormatOutput());
     
      }else{
        routing::getInstance()->redirect('solicitudInsumo', 'index');
      }

    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}
