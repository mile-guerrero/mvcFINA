<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\controlPlagaValidatorClass as validator;
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
   * @return   controlPlagaTableClass::NOMBRE retorna $nombre (string),
    controlPlagaTableClass::APELLIDO retorna $apellido (string),
    controlPlagaTableClass::DOCUMENTO retorna $documento (integer),
    controlPlagaTableClass::DIRECCION retorna $direccion (string),
    controlPlagaTableClass::TELEFONO retorna $telefono (integer),
    controlPlagaTableClass::ID_TIPO_ID retorna $idTipo (integer),
    controlPlagaTableClass::ID_CIUDAD retorna $idCiudad (integer),
   * estos datos retornan en la variable $data
   */
  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {

        $lote = trim(request::getInstance()->getPost(controlPlagaTableClass::getNameField(controlPlagaTableClass::LOTE_ID, true)));
        $plaga = trim(request::getInstance()->getPost(controlPlagaTableClass::getNameField(controlPlagaTableClass::PLAGA_ID, true)));
        $insumo = trim(request::getInstance()->getPost(controlPlagaTableClass::getNameField(controlPlagaTableClass::PRODUCTO_INSUMO_ID, true)));
        $cantidad = trim(request::getInstance()->getPost(controlPlagaTableClass::getNameField(controlPlagaTableClass::CANTIDAD, true)));
        
        //llamar la funcion validateInsert()
        validator::validateInsert();


        $data = array(
            controlPlagaTableClass::LOTE_ID => $lote,
            controlPlagaTableClass::PLAGA_ID => $plaga,
            controlPlagaTableClass::PRODUCTO_INSUMO_ID => $insumo,
            controlPlagaTableClass::CANTIDAD => $cantidad,
            '__sequence' => 'control_plaga_id_seq'
        );
        $id = controlPlagaTableClass::insert($data);
        session::getInstance()->setSuccess('El registro fue exitoso');
        $observacion ='se ha insertando un nuevo controlPlaga';
        log::register('Insertar', controlPlagaTableClass::getNameTable(),$observacion,$id);
        routing::getInstance()->redirect('controlPlaga', 'index');
      }//cierre del POST 
      else {
        routing::getInstance()->redirect('controlPlaga', 'index');
      }//cierre del else
    } //cierre de la try
    catch (PDOException $exc) {
      routing::getInstance()->redirect('controlPlaga', 'insert');
      session::getInstance()->setFlash('exc', $exc);
    }//cierre del catch
  }//cierre de la funcion execute 
}//cierre de la clase




