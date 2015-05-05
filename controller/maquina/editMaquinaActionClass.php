
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
class editMaquinaActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
   
      if (request::getInstance()->hasGet(maquinaTableClass::ID)) {
        $fields = array(
            maquinaTableClass::ID,
            maquinaTableClass::NOMBRE,
            maquinaTableClass::DESCRIPCION,
            maquinaTableClass::TIPO_USO_ID,
            maquinaTableClass::ORIGEN_MAQUINA,
            maquinaTableClass::PROVEEDOR_ID
        );
        $where = array(
            maquinaTableClass::ID => request::getInstance()->getGet(maquinaTableClass::ID)
        );
        $this->objMaquina = maquinaTableClass::getAll($fields, true, null, null, null, null, $where);
  
      $fields = array(     
      tipoUsoMaquinaTableClass::ID, 
      tipoUsoMaquinaTableClass::DESCRIPCION
      );
      $orderBy = array(
      tipoUsoMaquinaTableClass::DESCRIPCION    
      ); 
       
      $this->objMTUM = tipoUsoMaquinaTableClass::getAll($fields, false, $orderBy, 'ASC');

      
       $fields = array(
      proveedorTableClass::ID,
      proveedorTableClass::NOMBREP
      );
      $orderBy = array(
      proveedorTableClass::NOMBREP   
      );      
      
      $this->objMP = proveedorTableClass::getAll($fields, true, $orderBy, 'ASC');
      
        
        $this->defineView('editMaquina', 'maquina', session::getInstance()->getFormatOutput());
     
      }else{
        routing::getInstance()->redirect('maquina', 'indexMaquina');
      }

    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}
