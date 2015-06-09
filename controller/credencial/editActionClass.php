
<?php
use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon 
 * @date: fecha de inicio del desarrollo.
 * @category: modulo de credencial.
 */
class editActionClass extends controllerClass implements controllerActionInterface {

  
  /**
* @author: Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon .
* @date: fecha de inicio del desarrollo.
* @return   credencialTableClass::ID retorna (integer),
            credencialTableClass::NOMBRE retorna (string),
 * estos datos retornan en la variable $fields y el Id en la variable $WHERE
*/
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
     
      }//cierre del if existencia de id
        else{
        routing::getInstance()->redirect('credencial', 'index');
      }//cierre del else

    }//cierre del try 
      catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }//cierre del catch
  }//cierre de la funcion execute

}//cierre de la clase
