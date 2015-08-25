
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
   
      if (request::getInstance()->hasGet(usuarioCredencialTableClass::ID)) {
        $fields = array(
            usuarioCredencialTableClass::ID,
            usuarioCredencialTableClass::USUARIO_ID,          
            usuarioCredencialTableClass::CREDENCIAL_ID
        );
        $where = array(
            usuarioCredencialTableClass::ID => request::getInstance()->getGet(usuarioCredencialTableClass::ID)
        );
        $this->objUC = usuarioCredencialTableClass::getAll($fields,false, null, null, null, null, $where);
       $fields = array(
      usuarioTableClass::ID,
      usuarioTableClass::USUARIO
      );
      $orderBy = array(
      usuarioTableClass::USUARIO   
      );      
      $this->objUCU = usuarioTableClass::getAll($fields, true, $orderBy, 'ASC');
      
      $fields = array(     
      credencialTableClass::ID, 
      credencialTableClass::NOMBRE
      );
      $orderBy = array(
      credencialTableClass::NOMBRE    
      ); 
      $this->objUCC = credencialTableClass::getAll($fields, true, $orderBy, 'ASC');

        $this->defineView('edit', 'usuarioCredencial', session::getInstance()->getFormatOutput());
     
        
      }else{
        routing::getInstance()->redirect('usuarioCredencial', 'index');
      }

    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}
