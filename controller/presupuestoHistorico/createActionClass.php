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
   * @return   presupuestoHistoricoTableClass::NOMBRE retorna $nombre (string),
    presupuestoHistoricoTableClass::APELLIDO retorna $apellido (string),
    presupuestoHistoricoTableClass::DOCUMENTO retorna $documento (integer),
    presupuestoHistoricoTableClass::DIRECCION retorna $direccion (string),
    presupuestoHistoricoTableClass::TELEFONO retorna $telefono (integer),
    presupuestoHistoricoTableClass::ID_TIPO_ID retorna $idTipo (integer),
    presupuestoHistoricoTableClass::ID_CIUDAD retorna $idCiudad (integer),
   * estos datos retornan en la variable $data
   */
  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {

        $lote = trim(request::getInstance()->getPost(presupuestoHistoricoTableClass::getNameField(presupuestoHistoricoTableClass::LOTE_ID, true)));
        $insumo = trim(request::getInstance()->getPost(presupuestoHistoricoTableClass::getNameField(presupuestoHistoricoTableClass::PRODUCTO_INSUMO_ID, true)));
        $presupuesto = trim(request::getInstance()->getPost(presupuestoHistoricoTableClass::getNameField(presupuestoHistoricoTableClass::PRESUPUESTO, true)));
        $totalProduccion = trim(request::getInstance()->getPost(presupuestoHistoricoTableClass::getNameField(presupuestoHistoricoTableClass::TOTAL_PRODUCCION, true)));
        $totalPago = trim(request::getInstance()->getPost(presupuestoHistoricoTableClass::getNameField(presupuestoHistoricoTableClass::TOTAL_PAGO_TRABAJADOR, true)));
        
        //llamar la funcion validateInsert()
//        validator::validateInsert();


        $data = array(
            presupuestoHistoricoTableClass::LOTE_ID => $lote,
            presupuestoHistoricoTableClass::PRODUCTO_INSUMO_ID => $insumo,
            presupuestoHistoricoTableClass::PRESUPUESTO => $presupuesto,
            presupuestoHistoricoTableClass::TOTAL_PRODUCCION => $totalProduccion,
            presupuestoHistoricoTableClass::TOTAL_PAGO_TRABAJADOR => $totalPago,
            '__sequence' => 'presupuesto_historico_id_seq'
        );
        $id = presupuestoHistoricoTableClass::insert($data);
        session::getInstance()->setSuccess('El registro fue exitoso');
        $observacion ='se ha insertando un nuevo presupuestoHistorico';
        log::register('Insertar', presupuestoHistoricoTableClass::getNameTable(),$observacion,$id);
        routing::getInstance()->redirect('presupuestoHistorico', 'index');
      }//cierre del POST 
      else {
        routing::getInstance()->redirect('presupuestoHistorico', 'index');
      }//cierre del else
    } //cierre de la try
    catch (PDOException $exc) {
      routing::getInstance()->redirect('presupuestoHistorico', 'insert');
      session::getInstance()->setFlash('exc', $exc);
    }//cierre del catch
  }//cierre de la funcion execute 
}//cierre de la clase




