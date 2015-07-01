<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\enfermedadValidatorClass as validator;
use hook\log\logHookClass as log;

/**
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon 
 * @date: fecha de inicio del desarrollo.
 * @category: modulo de cliente.
 */
class createActionClass extends controllerClass implements controllerActionInterface {

  /**
   * @author: Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon .
   * @date: fecha de inicio del desarrollo.
   * @return   enfermedadTableClass::NOMBRE retorna $nombre (string),
    enfermedadTableClass::DESCRIPCION retorna $descripcion (string),
    enfermedadTableClass::TRATAMIENTO retorna $tratamiento (string)
   * estos datos retornan en la variable $data
   */
  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {

        $nombre = trim(request::getInstance()->getPost(enfermedadTableClass::getNameField(enfermedadTableClass::NOMBRE, true)));
        $descripcion = trim(request::getInstance()->getPost(enfermedadTableClass::getNameField(enfermedadTableClass::DESCRIPCION, true)));
        $tratamiento = trim(request::getInstance()->getPost(enfermedadTableClass::getNameField(enfermedadTableClass::TRATAMIENTO, true)));
        
        //llamar la funcion validateInsert()
        validator::validateInsert();


        $data = array(
            enfermedadTableClass::NOMBRE => $nombre,
            enfermedadTableClass::DESCRIPCION => $descripcion,
            enfermedadTableClass::TRATAMIENTO => $tratamiento,
            '__sequence' => 'enfermedad_id_seq'
        );
        $id = enfermedadTableClass::insert($data);
        session::getInstance()->setSuccess('El registro fue exitoso');
        $observacion ='se ha insertando una nueva enfermedad';
        log::register('Insertar', enfermedadTableClass::getNameTable(),$observacion,$id);
        routing::getInstance()->redirect('enfermedad', 'index');
      }//cierre del POST 
      else {
        routing::getInstance()->redirect('enfermedad', 'index');
      }//cierre del else
    } //cierre de la try
    catch (PDOException $exc) {
      routing::getInstance()->redirect('enfermedad', 'insert');
      session::getInstance()->setFlash('exc', $exc);
    }//cierre del catch
  }//cierre de la funcion execute 
}//cierre de la clase
      
     
//$sql = 'SELECT ' . clienteTableClass::NOMBRE .  ' As nombre  '
//             . '  FROM ' . clienteTableClass::getNameTable() . '  '
//             . '  WHERE ' . clienteTableClass::DOCUMENTO . ' = :documento';
//    $params = array(
//          ':documento' => $documento
//      );
//    
//    $answer = model::getInstance()->prepare($sql);
//    $answer->execute($params);
//    $answer = $answer->fetchAll(PDO::FETCH_OBJ);
//    print_r ($answer);
   



