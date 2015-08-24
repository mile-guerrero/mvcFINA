<?php

namespace mvc\validator {

    use mvc\validator\validatorClass;
    use mvc\session\sessionClass as session;
    use mvc\request\requestClass as request;
    use mvc\routing\routingClass as routing;
    use mvc\config\myConfigClass as config;

    /**
     * Description of manoObraValidatorClass
     *
     * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon
     */
    class pagoTrabajadorValidatorClass extends validatorClass {

        public static function validateInsert() {
            $flag = false;

            if (self::notBlank(request::getInstance()->getPost(\pagoTrabajadorTableClass::getNameField(\pagoTrabajadorTableClass::CANTIDAD_HORAS_EXTRAS, true)))) {
                $flag = true;
                session::getInstance()->setFlash('inputCantidad', true);
                session::getInstance()->setError('La cantidad es requerida', 'inputCantidad');
            } else if (!is_numeric(request::getInstance()->getPost(\pagoTrabajadorTableClass::getNameField(\pagoTrabajadorTableClass::CANTIDAD_HORAS_EXTRAS, true)))) {
                $flag = true;
                session::getInstance()->setFlash('inputCantidad', true);
                session::getInstance()->setError('La cantidad no puede ser letras', 'inputCantidad');
            } else if(strlen(request::getInstance()->getPost(\pagoTrabajadorTableClass::getNameField(\pagoTrabajadorTableClass::CANTIDAD_HORAS_EXTRAS, true))) > \pagoTrabajadorTableClass::CANTIDAD_HORAS_EXTRAS_LENGTH) {
                $flag = true;
                session::getInstance()->setFlash('inputCantidad', true);
                session::getInstance()->setError('La catidad digitado sobre pasa los caracteres permitidos', 'inputCantidad');
            }    
            if (self::notBlank(request::getInstance()->getPost(\pagoTrabajadorTableClass::getNameField(\pagoTrabajadorTableClass::VALOR_SALARIO, true)))) {
                $flag = true;
                session::getInstance()->setFlash('inputValor', true);
                session::getInstance()->setError('El valor es requerido', 'inputValor');
            } else if (!is_numeric(request::getInstance()->getPost(\pagoTrabajadorTableClass::getNameField(\pagoTrabajadorTableClass::VALOR_SALARIO, true)))) {
                $flag = true;
                session::getInstance()->setFlash('inputValor', true);
                session::getInstance()->setError('El valor no puede ser letras', 'inputValor');
            } else if(strlen(request::getInstance()->getPost(\pagoTrabajadorTableClass::getNameField(\pagoTrabajadorTableClass::VALOR_SALARIO, true))) > \pagoTrabajadorTableClass::VALOR_SALARIO_LENGTH) {
                $flag = true;
                session::getInstance()->setFlash('inputValor', true);
                session::getInstance()->setError('La catidad digitado sobre pasa los caracteres permitidos', 'inputValor');
            }    
            if (self::notBlank(request::getInstance()->getPost(\pagoTrabajadorTableClass::getNameField(\pagoTrabajadorTableClass::VALOR_HORAS_EXTRAS, true)))) {
                $flag = true;
                session::getInstance()->setFlash('inputHoras', true);
                session::getInstance()->setError('Las horas extras son requeridas', 'inputHoras');
            } else if (!is_numeric(request::getInstance()->getPost(\pagoTrabajadorTableClass::getNameField(\pagoTrabajadorTableClass::VALOR_HORAS_EXTRAS, true)))) {
                $flag = true;
                session::getInstance()->setFlash('inputHoras', true);
                session::getInstance()->setError('Las horas extras no puede ser letras', 'inputHoras');
            } else if(strlen(request::getInstance()->getPost(\pagoTrabajadorTableClass::getNameField(\pagoTrabajadorTableClass::VALOR_HORAS_EXTRAS, true))) > \pagoTrabajadorTableClass::VALOR_HORAS_EXTRAS_LENGTH) {
                $flag = true;
                session::getInstance()->setFlash('inputHoras', true);
                session::getInstance()->setError('La catidad digitado sobre pasa los caracteres permitidos', 'inputHoras');
            }    
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