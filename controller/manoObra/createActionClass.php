<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\manoObraValidatorClass as validator;
use hook\log\logHookClass as log;

/**
 * Description of ejemploClass
 *
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon
 */
class createActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {

        $cantidad = request::getInstance()->getPost(manoObraTableClass::getNameField(manoObraTableClass::CANTIDAD_HORA, true));
        $valor = request::getInstance()->getPost(manoObraTableClass::getNameField(manoObraTableClass::VALOR_HORA, true));
        $total = request::getInstance()->getPost(manoObraTableClass::getNameField(manoObraTableClass::TOTAL, true));
        $cooperativa = request::getInstance()->getPost(manoObraTableClass::getNameField(manoObraTableClass::COOPERATIVA_ID, true));
        $labor = request::getInstance()->getPost(manoObraTableClass::getNameField(manoObraTableClass::LABOR_ID, true));
        $maquina = request::getInstance()->getPost(manoObraTableClass::getNameField(manoObraTableClass::MAQUINA_ID, true));

        //$this->validate($cantidad, $valor);
        validator::validateInsert();
        
        if($total <= 0){
                session::getInstance()->setFlash('inputTotal', true);
                session::getInstance()->setError('Los valores numericos no pueden ser negativos', 'inputTotal');
                routing::getInstance()->forward('manoObra', 'insert');
            }
            
        if($cantidad <= 0){
                session::getInstance()->setFlash('inputCantidad', true);
                session::getInstance()->setError('Los valores numericos no pueden ser negativos', 'inputCantidad');
                routing::getInstance()->forward('manoObra', 'insert');
            }
            
        if($valor <= 0){
                session::getInstance()->setFlash('inputValor', true);
                session::getInstance()->setError('Los valores numericos no pueden ser negativos', 'inputValor');
                routing::getInstance()->forward('manoObra', 'insert');
            }

        $data = array(
            manoObraTableClass::CANTIDAD_HORA => $cantidad,
            manoObraTableClass::VALOR_HORA => $valor,
            manoObraTableClass::TOTAL => $total,
            manoObraTableClass::COOPERATIVA_ID => $cooperativa,
            manoObraTableClass::LABOR_ID => $labor,            
            manoObraTableClass::MAQUINA_ID => $maquina,
            '__sequence' => 'mano_obra_id_seq'            
        );
        $id = manoObraTableClass::insert($data);
        session::getInstance()->setSuccess('El registro fue exitoso');
        $observacion ='se ha insertando una nueva mano obra';
        log::register('Insertar', manoObraTableClass::getNameTable(),$observacion,$id);
        routing::getInstance()->redirect('manoObra', 'index');
      } else {
        routing::getInstance()->redirect('manoObra', 'index');
      }
    } catch (PDOException $exc) {
      routing::getInstance()->redirect('manoObra', 'insert');
      session::getInstance()->setFlash('exc', $exc);
    }
  }

}






 

        
            
           
        