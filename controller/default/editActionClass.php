
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
 * @category: modulo de defautl.
 */
class editActionClass extends controllerClass implements controllerActionInterface {
 /**
* @author: Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon .
* @date: fecha de inicio del desarrollo.
* @return   usuarioTableClass::ID retorna (integer),
            usuarioTableClass::USUARIO retorna (string),
            usuarioTableClass::PASSWORD retorna (string),
 * estos datos retornan en la variable $fields y el Id en la variable $WHERE
*/
  public function execute() {
    try {

      if (request::getInstance()->hasGet(usuarioTableClass::ID)) {
        $fields = array(
            usuarioTableClass::ID,
            usuarioTableClass::USUARIO,
            usuarioTableClass::NOMBRE_IMAGEN,
          usuarioTableClass::HASH_IMAGEN,
          usuarioTableClass::EXTENCION_IMAGEN,
            usuarioTableClass::PASSWORD
        );
        $where = array(
            usuarioTableClass::ID => request::getInstance()->getGet(usuarioTableClass::ID)
        );
        $this->objUsuarios = usuarioTableClass::getAll($fields, true, null, null, null, null, $where);
        $this->defineView('edit', 'default', session::getInstance()->getFormatOutput());
        
      }//cierre del if existencia de id
       else{
        routing::getInstance()->redirect('default', 'index');
      }//cierre del else

    }//cierre del try 
      catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }//cierre del catch
}//cierre de la funcion execute

}//cierre de la clase
