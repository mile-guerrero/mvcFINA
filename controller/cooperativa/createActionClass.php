<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\cooperativaValidatorClass as validator;
use hook\log\logHookClass as log;

/**
 * Description of ejemploClass
 *
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon
 * @date: fecha de inicio del desarrollo.
 * @static: se define si la clase es de tipo estatica.
 * @category:modulo de cooperativa
 */
class createActionClass extends controllerClass implements controllerActionInterface {

/**
* @author: Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon
* @date: fecha de inicio del desarrollo.
* @return cooperativaTableClass::ID retorna $id(integer),
 *        cooperativaTableClass::NOMBRE retorna $nombre(string),
 *        cooperativaTableClass::DESCRIPCION retorna $descripcion(string),
 *        cooperativaTableClass::DIRECCION retorna $direccion(string),
 *        cooperativaTableClass::TELEFONO retorna $telefono(integer),  
 *        cooperativaTableClass::ID_CIUDAD retorna $id_ciudad(integer),
 * estos datos retornan en la variable $data
 */

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')===true) {

        $nombre = trim(request::getInstance()->getPost(cooperativaTableClass::getNameField(cooperativaTableClass::NOMBRE, true)));
        $descripcion = trim(request::getInstance()->getPost(cooperativaTableClass::getNameField(cooperativaTableClass::DESCRIPCION, true)));
        $direccion = request::getInstance()->getPost(cooperativaTableClass::getNameField(cooperativaTableClass::DIRECCION, true));
        $telefono = request::getInstance()->getPost(cooperativaTableClass::getNameField(cooperativaTableClass::TELEFONO, true));
        $idCiudad = request::getInstance()->getPost(cooperativaTableClass::getNameField(cooperativaTableClass::ID_CIUDAD, true));
        
        
        validator::validateInsert();
//        $this->validate($nombre,$descripcion,$direccion,$telefono);
        
        $data = array(
            cooperativaTableClass::NOMBRE => $nombre,
            cooperativaTableClass::DESCRIPCION => $descripcion,
            cooperativaTableClass::DIRECCION => $direccion,
            cooperativaTableClass::TELEFONO => $telefono,
            cooperativaTableClass::ID_CIUDAD=> $idCiudad,
            '__sequence' => 'cooperativa_id_seq'
        );
        $id = cooperativaBaseTableClass::insert($data);
        session::getInstance()->setSuccess('El registro fue exitoso');
        $observacion ='se ha insertando un nuevo cooperativa';
        log::register('Insertar', cooperativaTableClass::getNameTable(),$observacion,$id);
        routing::getInstance()->redirect('cooperativa', 'index');
      } else {
        routing::getInstance()->redirect('cooperativa', 'index');
      }
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }
//private function validate ($nombre,$descripcion,$direccion,$telefono){
//  $flag = false;
//    $soloNumeros = "/^[[:digit:]]+$/";
//    $soloLetras = "/^[a-z]+$/i";
//    $soloTelefono = "/[0-9](9)$/";
//    
//    //---------------------validacion nombre-------------------------------------
//  if (strlen($nombre) > cooperativaTableClass::NOMBRE_LENGTH) {
//         session::getInstance()->setError(i18n::__(00007, null, 'errors', array(':longitud' => cooperativaTableClass::NOMBRE_LENGTH)), 00007);
//         $flag = true;
//         session::getInstance()->setFlash(cooperativaTableClass::getNameField(cooperativaTableClass::NOMBRE, true),true);
//         }
// if (strlen($nombre)  == null or $nombre === "") {
//      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => cooperativaTableClass::NOMBRE)), 00009);
//      $flag = true;
//     }
// if (!preg_match($soloLetras, $nombre)) {
//       session::getInstance()->setError(i18n::__(00012, null, 'errors', array(':no permite letras' => cooperativaTableClass::NOMBRE)), 00012);
//       $flag = true;
//       }
//     //---------------------validacion descripcion-------------------------------------
//  
//  if (strlen($descripcion) > cooperativaTableClass::DESCRIPCION_LENGTH) {
//         session::getInstance()->setError(i18n::__(00008, null, 'errors', array(':longitud' => cooperativaTableClass::DESCRIPCION_LENGTH)), 00008);
//         $flag = true;
//         session::getInstance()->setFlash(cooperativaTableClass::getNameField(cooperativaTableClass::DESCRIPCION, true),true);
//       }
//       
//   if (strlen($descripcion)  == null or $descripcion === "") {
//      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => cooperativaTableClass::DESCRIPCION)), 00009);
//      $flag = true;
//     }
// if (!preg_match($soloLetras, $descripcion)) {
//       session::getInstance()->setError(i18n::__(00012, null, 'errors', array(':no permite letras' => cooperativaTableClass::DESCRIPCION)), 00012);
//       $flag = true;
//       }
// 
//       
// //---------------------validacion direccion-------------------------------------
//     if (strlen($direccion) > cooperativaTableClass::DIRECCION_LENGTH) {
//      session::getInstance()->setError(i18n::__(00002, null, 'errors', array(':longitud' => cooperativaTableClass::DIRECCION_LENGTH)), 00002);
//      $flag = true;
//     }
//     
//     if (strlen($direccion)  == null or $direccion === "") {
//      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => cooperativaTableClass::DIRECCION)), 00009);
//      $flag = true;
//     }
//  
//     
//     //---------------------validacion telefono-------------------------------------
//  if (strlen($telefono) > cooperativaTableClass::TELEFONO_LENGTH) {
//      session::getInstance()->setError(i18n::__(00019, null, 'errors', array(':longitud' => cooperativaTableClass::TELEFONO_LENGTH)), 00019);
//      $flag = true;
//     }
//  if (strlen($telefono) == null or $telefono === "") {
//      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' =>cooperativaTableClass::TELEFONO)), 00009);
//      $flag = true;
//     }
// if (!preg_match($soloNumeros, $telefono)) {
//      session::getInstance()->setError(i18n::__(00016, null, 'errors', array(':no permite letras' => cooperativaTableClass::TELEFONO)), 00016);
//      $flag = true;
//       }
//     
//     
//  if ($flag === true){
//    request::getInstance()->setMethod('GET');
//    routing::getInstance()->forward('cooperativa', 'insert');
//  }
//        
//}
}
