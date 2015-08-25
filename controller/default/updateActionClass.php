
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
class updateActionClass extends controllerClass implements controllerActionInterface {

  
   /**
* @author: Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon .
* @date: fecha de inicio del desarrollo.
* @return   usuarioTableClass::ID retorna $id (integer),
            usuarioTableClass::USUARIO retorna $usuario (string),
            usuarioTableClass::PASSWORD retorna $password (string),
 * estos datos retornan en la variable $data y el $id retorna en la variable $ids
*/
  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {
        $id = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::ID, true));
        $usuario = trim(request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::USUARIO, true)));
        $password = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::PASSWORD, true). '_1');
        $password2 = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::PASSWORD, true). '_2');
        $file = request::getInstance()->getFile(usuarioTableClass::getNameField(usuarioTableClass::NOMBRE_IMAGEN, true));
        
        validator::validateEdit();
//        $this->validate($usuario,$password,$password2);
        $long = -3;
        $ext = substr($file['name'], $long);
        if ($ext == 'JPG' or $ext =='jpg') {
              $ext = 'jpg';
             }
        $sizeKB = $file['size'] / 1024;
        $hashImagen = md5($file['name'] . strtotime(date(config::getFormatTimestamp()))) . '.' . $ext;


        if ($ext == "jpg" || $ext == "JPG" || $ext == "gif" || $ext == "png") {
          if (move_uploaded_file($file['tmp_name'], config::getPathAbsolute() . 'web/imgUsuario/' . $hashImagen) && ($sizeKB < 2048)) {
            
            //$extencion = substr($file['name'], $long);
            $hash = $file['type'];
        $ids = array(
            usuarioTableClass::ID => $id
        );
        $data = array(
            usuarioTableClass::USUARIO => $usuario,
            usuarioTableClass::NOMBRE_IMAGEN => $file['name'],
            usuarioTableClass::EXTENCION_IMAGEN => $ext,
            usuarioTableClass::HASH_IMAGEN => $hashImagen,
            usuarioTableClass::PASSWORD => md5($password)
        );
        usuarioTableClass::update($ids, $data);
        session::getInstance()->setSuccess('La actualizacion fue correcta');
        $observacion ='se ha modificado el usuario';
        log::register('Modificar', usuarioTableClass::getNameTable(),$observacion,$id);
        routing::getInstance()->redirect('default', 'index');
      } else {
          //  validator::validateEdit();
              session::getInstance()->setError('El archivo sobre pasa el peso minimo requerido', 'inputImagen');
              routing::getInstance()->forward('default', 'edit');
          }
        } else {
          session::getInstance()->setError('No es un tipo de archivo válido', 'inputImagen');
          routing::getInstance()->forward('default', 'edit');
    }
    
        }
      }
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
//    request::getInstance()->addParamGet(array(usuarioTableClass::ID => request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::ID, true))));
//    routing::getInstance()->forward('default', 'edit');
//  }
//        
//}
