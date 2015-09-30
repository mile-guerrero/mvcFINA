
<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\pagoTrabajadorValidatorUpdateClass as validator;
use hook\log\logHookClass as log;

/**
 * Description of ejemploClass
 *
 * @author 
 */
class updateActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {
        $id = request::getInstance()->getPost(pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::ID, true));
        $fecha_ini = request::getInstance()->getPost(pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::FECHA_INICIAL, true));
        $fecha_fin = request::getInstance()->getPost(pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::FECHA_FINAL, true));
        $idEmpresa = request::getInstance()->getPost(pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::EMPRESA_ID, true));
        $idTrabajador = request::getInstance()->getPost(pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::TRABAJADOR_ID, true));
        $valor = request::getInstance()->getPost(pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::VALOR_SALARIO, true));
        $horas = request::getInstance()->getPost(pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::HORAS_PERDIDAS, true));
        $total = request::getInstance()->getPost(pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::TOTAL_PAGAR, true));

        validator::validateUpdate();
        if($fecha_fin < $fecha_ini){
                session::getInstance()->setFlash('selectFechaIni', true);
                session::getInstance()->setError('La fecha final no puede ser menor a la actual', 'selectFechaIni');
                request::getInstance()->setMethod('GET');
                request::getInstance()->addParamGet(array(\pagoTrabajadorTableClass::ID => request::getInstance()->getPost(\pagoTrabajadorTableClass::getNameField(\pagoTrabajadorTableClass::ID, true))));
                routing::getInstance()->forward('pagoTrabajador', 'edit');
            }elseif($fecha_fin == $fecha_ini){
                session::getInstance()->setFlash('selectFechaIni', true);
                session::getInstance()->setError('La fecha final es igual a la actual', 'selectFechaIni');
                request::getInstance()->setMethod('GET');
                request::getInstance()->addParamGet(array(\pagoTrabajadorTableClass::ID => request::getInstance()->getPost(\pagoTrabajadorTableClass::getNameField(\pagoTrabajadorTableClass::ID, true))));
                routing::getInstance()->forward('pagoTrabajador', 'edit');
            }
             if($horas > $valor){
                session::getInstance()->setFlash('selectFechaIni', true);
                session::getInstance()->setError('Las deudas a cancelar no pueden ser mayor al sueldo', 'inputValor');
               request::getInstance()->setMethod('GET');
                request::getInstance()->addParamGet(array(\pagoTrabajadorTableClass::ID => request::getInstance()->getPost(\pagoTrabajadorTableClass::getNameField(\pagoTrabajadorTableClass::ID, true))));
                routing::getInstance()->forward('pagoTrabajador', 'edit');
            }
            
            if($total < 0){
                session::getInstance()->setFlash('selectFechaIni', true);
                session::getInstance()->setError('El total a pagar no puede ser negativo', 'inputTotal');
                request::getInstance()->setMethod('GET');
                request::getInstance()->addParamGet(array(\pagoTrabajadorTableClass::ID => request::getInstance()->getPost(\pagoTrabajadorTableClass::getNameField(\pagoTrabajadorTableClass::ID, true))));
                routing::getInstance()->forward('pagoTrabajador', 'edit');
            }
            
            if($horas < 0){
                session::getInstance()->setFlash('inputHorasPerdidas', true);
                session::getInstance()->setError('Los valores numericos no pueden ser negativos', 'inputHorasPerdidas');
                request::getInstance()->setMethod('GET');
                request::getInstance()->addParamGet(array(\pagoTrabajadorTableClass::ID => request::getInstance()->getPost(\pagoTrabajadorTableClass::getNameField(\pagoTrabajadorTableClass::ID, true))));
                routing::getInstance()->forward('pagoTrabajador', 'edit');
            }
            
        $ids = array(
            pagoTrabajadorTableClass::ID => $id
        );
        $data = array(
          pagoTrabajadorTableClass::FECHA_INICIAL => $fecha_ini,
          pagoTrabajadorTableClass::FECHA_FINAL => $fecha_fin,
          pagoTrabajadorTableClass::EMPRESA_ID => $idEmpresa,
          pagoTrabajadorTableClass::TRABAJADOR_ID => $idTrabajador,
          pagoTrabajadorTableClass::VALOR_SALARIO => $valor,
          pagoTrabajadorTableClass::HORAS_PERDIDAS => $horas,
          pagoTrabajadorTableClass::TOTAL_PAGAR => $total
            
        );
        pagoTrabajadorTableClass::update($ids, $data);
        session::getInstance()->setSuccess('La actualizacion fue correcta');
         $observacion ='se ha modificado el documento pago trabajador';
        log::register('Modificar', pagoTrabajadorTableClass::getNameTable(),$observacion,$id);
        routing::getInstance()->redirect('pagoTrabajador', 'index');
      }
    } catch (PDOException $exc) {
      routing::getInstance()->redirect('pagoTrabajador', 'edit');
      session::getInstance()->setFlash('exc', $exc);
    }
  }

}

