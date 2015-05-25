
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
      if (request::getInstance()->hasGet(manoObraTableClass::ID)) {
        $fields = array(
          manoObraTableClass::ID,
          manoObraTableClass::CANTIDAD_HORA,
          manoObraTableClass::VALOR_HORA,
          manoObraTableClass::COOPERATIVA_ID,
          manoObraTableClass::LABOR_ID,
          manoObraTableClass::MAQUINA_ID,
          manoObraTableClass::CREATED_AT,
          manoObraTableClass::UPDATED_AT,
          manoObraTableClass::DELETED_AT
        );
        $where = array(
            manoObraTableClass::ID => request::getInstance()->getGet(manoObraTableClass::ID)
        );
        $this->objManoObra = manoObraTableClass::getAll($fields, true, null, null, null, null, $where);
        $fields = array(
           cooperativaTableClass::ID,
           cooperativaTableClass::DESCRIPCION
      );
      $orderBy = array(
      cooperativaTableClass::DESCRIPCION   
      );      
      $this->objCooperativa = cooperativaTableClass::getAll($fields, true, $orderBy, 'ASC');
    
      $fields = array(
          laborTableClass::ID,
          laborTableClass::DESCRIPCION
      );
      $orderBy = array(
      laborTableClass::DESCRIPCION   
      );      
      $this->objLabor = laborTableClass::getAll($fields, false, $orderBy, 'ASC');
    
       $fields = array(
      maquinaTableClass::ID,
      maquinaTableClass::NOMBRE
      );
      $orderBy = array(
      maquinaTableClass::NOMBRE   
      );      
      $this->objMaquina = maquinaTableClass::getAll($fields, true, $orderBy, 'ASC');
        $this->defineView('edit', 'manoObra', session::getInstance()->getFormatOutput());
     
      }else{
        routing::getInstance()->redirect('manoObra', 'index');
      }

    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}
