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
                
//      } else if(strlen(request::getInstance()->getPost('inputCantidad')) > \manoObraTableClass::CANTIDAD_HORA_LENGTH) {
//        $flag = true;
//        session::getInstance()->setFlash('inputCantidad', true);
//        session::getInstance()->setError('El usuario digitado es mayor en cantidad de caracteres a lo permitido', 'inputCantidad');
//      } else if(self::isUnique(\usuarioTableClass::ID, true, array(\manoObraTableClass::CANTIDAD_HORA_LENGTH => request::getInstance()->getPost('inputCantidad')), \usuarioTableClass::getNameTable())) {
//        $flag = true;
//        session::getInstance()->setFlash('inputCantidad', true);
//        session::getInstance()->setError('El usuario digitado ya existe', 'inputCantidad');
//      }
//      if (request::getInstance()->hasFile('inputFile')) {
//        $type = array(
//            'image/png',
//            'image/jpeg',
//            'image/jpg',
//            'image/gif'
//        );
//        if(request::getInstance()->getFile('inputFile')['error'] !== 0) {
//          $flag = true;
//          session::getInstance()->setFlash('inputFile', true);
//          session::getInstance()->setError('Ocurrio un error en la carga de la imágen, por favor vuelva a intentarlo', 'inputFile');
//        } else if ((array_search(request::getInstance()->getFile('inputFile')['type'], $type) === false)) {
//          $flag = true;
//          session::getInstance()->setFlash('inputFile', true);
//          session::getInstance()->setError('Solo se permiten imágenes del tipo jpg, png o gif', 'inputFile');
//        } else if (request::getInstance()->getFile('inputFile')['size'] > config::getFileSizeAvatar()) {
//          $flag = true;
//          session::getInstance()->setFlash('inputFile', true);
//          session::getInstance()->setError('Solo se permiten imágenes con un tamaño máximo de 150kB', 'inputFile');
//        } else if ($flag === true) {
//          session::getInstance()->setFlash('inputFile', true);
//          session::getInstance()->setError('Debido a errores en el formulario, por favor vuelve a cargar la imagen que vas a usar', 'inputFile');
            }

            if ($flag === true) {
                //request::getInstance()->setMethod('GET');
                routing::getInstance()->forward('pagoTrabajador', 'insert');
            }
        }

    }

}