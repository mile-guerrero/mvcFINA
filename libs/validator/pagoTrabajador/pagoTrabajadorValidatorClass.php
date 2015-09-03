<?php

namespace mvc\validator {

    use mvc\validator\validatorClass;
    use mvc\session\sessionClass as session;
    use mvc\request\requestClass as request;
    use mvc\routing\routingClass as routing;
    use mvc\config\myConfigClass as config;

    /**
     * Description of pagoTrabajadorValidatorClass
     *
     * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon
     */
    class pagoTrabajadorValidatorClass extends validatorClass {

        public static function validateInsert() {
            $flag = false;

           
             
                
            if (self::notBlank(request::getInstance()->getPost(\pagoTrabajadorTableClass::getNameField(\pagoTrabajadorTableClass::HORAS_PERDIDAS, true)))) {
                $flag = true;
                session::getInstance()->setFlash('inputHorasPerdidas', true);
                session::getInstance()->setError('Las horas perdidas son requeridas', 'inputHorasPerdidas');
            } else if (!is_numeric(request::getInstance()->getPost(\pagoTrabajadorTableClass::getNameField(\pagoTrabajadorTableClass::HORAS_PERDIDAS, true)))) {
                $flag = true;
                session::getInstance()->setFlash('inputHorasPerdidas', true);
                session::getInstance()->setError('Las horas perdidas no puede ser letras', 'inputHorasPerdidas');
            } else if(strlen(request::getInstance()->getPost(\pagoTrabajadorTableClass::getNameField(\pagoTrabajadorTableClass::HORAS_PERDIDAS, true))) > \pagoTrabajadorTableClass::HORAS_PERDIDAS_LENGTH) {
                $flag = true;
                session::getInstance()->setFlash('inputHorasPerdidas', true);
                session::getInstance()->setError('La catidad digitado sobre pasa los caracteres permitidos', 'inputHorasPerdidas');
            }
            if (self::notBlank(request::getInstance()->getPost(\pagoTrabajadorTableClass::getNameField(\pagoTrabajadorTableClass::TOTAL_PAGAR, true)))) {
                $flag = true;
                session::getInstance()->setFlash('inputTotal', true);
                session::getInstance()->setError('El total es requerido', 'inputTotal');
            } else if (!is_numeric(request::getInstance()->getPost(\pagoTrabajadorTableClass::getNameField(\pagoTrabajadorTableClass::TOTAL_PAGAR, true)))) {
                $flag = true;
                session::getInstance()->setFlash('inputTotal', true);
                session::getInstance()->setError('El total no puede ser letras', 'inputTotal');
            } else if(strlen(request::getInstance()->getPost(\pagoTrabajadorTableClass::getNameField(\pagoTrabajadorTableClass::TOTAL_PAGAR, true))) > \pagoTrabajadorTableClass::TOTAL_PAGAR_LENGTH) {
                $flag = true;
                session::getInstance()->setFlash('inputTotal', true);
                session::getInstance()->setError('La catidad digitado sobre pasa los caracteres permitidos', 'inputTotal');
                
                //-------------------------------campo Trabajador-----------------------------
          //----campo nulo----
            } if (self::notBlank(request::getInstance()->getPost(\pagoTrabajadorTableClass::getNameField(\pagoTrabajadorTableClass::TRABAJADOR_ID, true)))) {
                $flag = true;
                session::getInstance()->setFlash('selectTrabajador', true);
                session::getInstance()->setError('El trabajador es requerido', 'selectTrabajador');
        //-------------------------------campo Empresa-----------------------------
          //----campo nulo----
            } if (self::notBlank(request::getInstance()->getPost(\pagoTrabajadorTableClass::getNameField(\pagoTrabajadorTableClass::EMPRESA_ID, true)))) {
                $flag = true;
                session::getInstance()->setFlash('selectEmpresa', true);
                session::getInstance()->setError('La empresa es requerida', 'selectEmpresa');
                }
            //fecha 
              

            if ($flag === true) {
                //request::getInstance()->setMethod('GET');
                routing::getInstance()->forward('pagoTrabajador', 'insert');
            }
        }
        
 public static function validateFiltroFecha($fechaInicial,$fechaFin) {
      
      if (strtotime($fechaFin) < strtotime($fechaInicial)){
        session::getInstance()->setError('La fecha final no puede ser menor a la actual', 'inputFecha');
          session::getInstance()->setFlash('modalFilters', true);
         
         // echo "<script> alert(' La fecha final no puede ser menor a la actual');</script>'";
      }       
    }
    
    }

}