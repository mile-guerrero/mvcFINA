
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
   
      if (request::getInstance()->hasGet(viveroTableClass::ID)) {
        $fields = array(
            viveroTableClass::ID,
            viveroTableClass::FECHA_INICIAL,
            viveroTableClass::FECHA_FINAL,
            viveroTableClass::CANTIDAD,
            viveroTableClass::PRODUCTO_INSUMO_ID
            
        );
        $where = array(
            viveroTableClass::ID => request::getInstance()->getGet(viveroTableClass::ID)
        );
        $this->objVivero = viveroTableClass::getAll($fields, true, null, null, null, null, $where);
        
//         $id = array(
//            viveroTableClass::ID => request::getInstance()->getRequest(viveroTableClass::ID)
//        );

        $fields = array(
            productoInsumoTableClass::ID,
            productoInsumoTableClass::DESCRIPCION
        );
        $orderBy = array(
            productoInsumoTableClass::DESCRIPCION
       
   
        );
        $this->objProducto = productoInsumoTableClass::getAll($fields, true, $orderBy, 'ASC');

//        $fields = array(
//            tipoProductoInsumoTableClass::ID,
//            tipoProductoInsumoTableClass::DESCRIPCION
//        );
//        $orderBy = array(
//            tipoProductoInsumoTableClass::DESCRIPCION
//        );
//        $this->objTipo = tipoProductoInsumoTableClass::getAll($fields, true, $orderBy, 'ASC');
//
//        
//        $fields = array(
//            trabajadorTableClass::ID,
//            trabajadorTableClass::NOMBRET
//        );
//        $orderBy = array(
//            trabajadorTableClass::NOMBRET
//        );
//        $this->objT = trabajadorTableClass::getAll($fields, true, $orderBy, 'ASC');
//        
//     
//        $fields = array(
//            loteTableClass::ID,
//            loteTableClass::UBICACION
//        );
//        $orderBy = array(
//            loteTableClass::UBICACION
//        );
//        $this->objL = loteTableClass::getAll($fields, true, $orderBy, 'ASC');
        $this->defineView('edit', 'vivero', session::getInstance()->getFormatOutput());
     
      }else{
        routing::getInstance()->redirect('vivero', 'index');
      }

    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}
