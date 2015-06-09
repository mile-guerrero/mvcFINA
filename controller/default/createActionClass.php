<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\defaultValidatorClass as validator;
use hook\log\logHookClass as log;

/**
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon 
 * @date: fecha de inicio del desarrollo.
 * @category: modulo de defautl.
 */
class createActionClass extends controllerClass implements controllerActionInterface {

 
  /**
   * @author: Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon .
   * @date: fecha de inicio del desarrollo.
   * @return   usuarioTableClass::USUARIO retorna $usuario (string),
               usuarioTableClass::PASSWORD retorna $usuario (string),
   * estos datos retornan en la variable $data
   */
  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')===true) {

        $usuario = trim(request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::USUARIO, true)));
        $password = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::PASSWORD, true). '_1');
        $password2 = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::PASSWORD, true). '_2');
          
        validator::validateInsert();
//        $this->validate($usuario,$password,$password2);
        
        $data = array(
            usuarioTableClass::USUARIO => $usuario,
            usuarioTableClass::PASSWORD => md5($password),
            '__sequence' => 'usuario_id_seq'
        );
       $id = usuarioTableClass::insert($data);        
        session::getInstance()->setSuccess('El registro fue Exitoso');
        $observacion ='se ha insertando un nuevo usuario';
        log::register('Insertar', usuarioTableClass::getNameTable(),$observacion,$id);
        routing::getInstance()->redirect('default', 'index');
      } //cierre del POST 
       else {
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




//private function validate ($usuario,$password,$password2){
//  $flag = false;
//  $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';
//  //--------------validacion usuario--------------------------------------------
//  if (strlen($usuario) > usuarioTableClass::USUARIO_LENGTH) {
//         session::getInstance()->setError(i18n::__(00007, null, 'errors', array(':longitud' => usuarioTableClass::USUARIO_LENGTH)), 00007);
//         $flag = true;
//         }
//  
//  if (!preg_match($emailcorrecto, $usuario)) {
//         session::getInstance()->setError(i18n::__(00017, null, 'errors', array(':longitud' => usuarioTableClass::USUARIO)), 00017);
//         $flag = true;
//         }       
//         
////----------------validacion de password----------------------------------------         
//         
//  if (strlen($password) > usuarioTableClass::PASSWORD_LENGTH) {
//         session::getInstance()->setError(i18n::__(00008, null, 'errors', array(':longitud' => usuarioTableClass::PASSWORD_LENGTH)), 00008);
//         $flag = true;
//        }
//  if($password !== $password2){
//    session::getInstance()->setError(i18n::__(00018, null, 'errors'));
//    $flag = true;
//  }      
//  if ($flag === true){
//    request::getInstance()->setMethod('GET');
//    routing::getInstance()->forward('default', 'insert');
//  }
//        
//}

