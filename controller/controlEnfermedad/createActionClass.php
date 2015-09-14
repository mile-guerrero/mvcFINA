<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\clienteValidatorClass as validator;
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
   * @return   controlEnfermedadTableClass::NOMBRE retorna $nombre (string),
    controlEnfermedadTableClass::APELLIDO retorna $apellido (string),
    controlEnfermedadTableClass::DOCUMENTO retorna $documento (integer),
    controlEnfermedadTableClass::DIRECCION retorna $direccion (string),
    controlEnfermedadTableClass::TELEFONO retorna $telefono (integer),
    controlEnfermedadTableClass::ID_TIPO_ID retorna $idTipo (integer),
    controlEnfermedadTableClass::ID_CIUDAD retorna $idCiudad (integer),
   * estos datos retornan en la variable $data
   */
  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {

        $lote = trim(request::getInstance()->getPost(controlEnfermedadTableClass::getNameField(controlEnfermedadTableClass::LOTE_ID, true)));
        $enfermedad = trim(request::getInstance()->getPost(controlEnfermedadTableClass::getNameField(controlEnfermedadTableClass::ENFERMEDAD_ID, true)));
        $insumo = trim(request::getInstance()->getPost(controlEnfermedadTableClass::getNameField(controlEnfermedadTableClass::PRODUCTO_INSUMO_ID, true)));
        $cantidad = trim(request::getInstance()->getPost(controlEnfermedadTableClass::getNameField(controlEnfermedadTableClass::CANTIDAD, true)));
        
        //llamar la funcion validateInsert()
//        validator::validateInsert();


        $data = array(
            controlEnfermedadTableClass::LOTE_ID => $lote,
            controlEnfermedadTableClass::ENFERMEDAD_ID => $enfermedad,
            controlEnfermedadTableClass::PRODUCTO_INSUMO_ID => $insumo,
            controlEnfermedadTableClass::CANTIDAD => $cantidad,
            '__sequence' => 'control_enfermedad_id_seq'
        );
        $id = controlEnfermedadTableClass::insert($data);
        session::getInstance()->setSuccess('El registro fue exitoso');
        $observacion ='se ha insertando un nuevo controlEnfermedad';
        log::register('Insertar', controlEnfermedadTableClass::getNameTable(),$observacion,$id);
        routing::getInstance()->redirect('controlEnfermedad', 'index');
      }//cierre del POST 
      else {
        routing::getInstance()->redirect('controlEnfermedad', 'index');
      }//cierre del else
    } //cierre de la try
    catch (PDOException $exc) {
      routing::getInstance()->redirect('controlEnfermedad', 'insert');
      session::getInstance()->setFlash('exc', $exc);
    }//cierre del catch
  }//cierre de la funcion execute 
}//cierre de la clase




