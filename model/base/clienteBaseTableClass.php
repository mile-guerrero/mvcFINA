<?php

use mvc\model\table\tableBaseClass;

/**
 * Description of clienteClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class clienteBaseTableClass extends tableBaseClass {
  
  private $id;
  private $nombre;
  private $apellido;
  private $direccion;
  private $telefono;
  private $idTipoId;
  private $idCiudad;
  private $createdAt;
  private $updatedAt;
  private $deletedAt;

  const ID = 'id';
  const NOMBRE = 'nombre';
  const NOMBRE_LENGTH = 80;
  const APELLIDO = 'apellido';
  const APELLIDO_LENGTH = 80;
  const DIRECCION = 'direccion';
  const TELEFONO = 'telefono';
  const ID_TIPO_ID = 'id_tipo_id';
  const ID_CIUDAD = 'id_ciudad';
  const CREATED_AT = 'created_at';
  const UPDATED_AT = 'updated_at';
  const DELETED_AT = 'deleted_at';

  public function get_id() {
    return $this->id;
  }

  public function get_nombre() {
    return $this->nombre;
  }

  public function get_apellido() {
    return $this->apellido;
  }

  public function get_direccion() {
    return $this->direccion;
  }

  public function get_telefono() {
    return $this->telefono;
  }

  public function get_idTipoId() {
    return $this->idTipoId;
  }

  public function get_idCiudad() {
    return $this->idCiudad;
  }

  public function get_createdAt() {
    return $this->createdAt;
  }

  public function get_updatedAt() {
    return $this->updatedAt;
  }

  public function get_deletedAt() {
    return $this->deletedAt;
  }

  public function set_id($id) {
    $this->id = $id;
  }

  public function set_nombre($nombre) {
    $this->nombre = $nombre;
  }

  public function set_apellido($apellido) {
    $this->apellido = $apellido;
  }

  public function set_direccion($direccion) {
    $this->direccion = $direccion;
  }

  public function set_telefono($telefono) {
    $this->telefono = $telefono;
  }

  public function set_idTipoId($idTipoId) {
    $this->idTipoId = $idTipoId;
  }

  public function set_idCiudad($idCiudad) {
    $this->idCiudad = $idCiudad;
  }

  public function set_createdAt($createdAt) {
    $this->createdAt = $createdAt;
  }

  public function set_updatedAt($updatedAt) {
    $this->updatedAt = $updatedAt;
  }

  public function set_deletedAt($deletedAt) {
    $this->deletedAt = $deletedAt;
  }

    
  /**
   * Obtiene el nombre de la tabla
   * @return string
   */
  static public function getNameTable() {
    return 'cliente';
  }

  /**
   * Método para obtener el nombre del campo más la tabla ya sea en formato
   * DB (.) o en formato HTML (_)
   *
   * @param string $field Nombre del campo
   * @param string $html [optional] Por defecto traerá el nombre del campo en
   * versión DB
   * @return string
   */
  public static function getNameField($field, $html = false, $table = null) {
    return parent::getNameField($field, self::getNameTable(), $html);
  }

  /**
   * Método para borrar un registro de una tabla X en la base de datos
   *
   * @param array $ids Array con los campos por posiciones
   * asociativas y los valores por valores a tener en cuenta para el borrado.
   * Ejemplo $fieldsAndValues['id'] = 1
   * @param boolean $deletedLogical [optional] Borrado lógico o
   * borrado físico [por defecto] de un registro en una tabla de la base de datos
   * @return \PDOException|boolean
   */
  public static function delete($ids, $deletedLogical = true, $table = null) {
    return parent::delete($ids, $deletedLogical, self::getNameTable());
  }

  /**
   * Método para insertar en una tabla usuario
   *
   * @param array $data Array asociativo donde las claves son los nombres de
   * los campos y su valor sería el valor a insertar. Ejemplo:
   * $data['nombre'] = 'Erika'; $data['apellido'] = 'Galindo';
   * @return \PDOException|boolean
   */
  public static function insert($data, $table = null) {
    return parent::insert(self::getNameTable(), $data);
  }

  /**
   * Método para leer todos los registros de una tabla
   *
   * @param array $fields Array con los nombres de los campos a solicitar
   * @param boolean $deletedLogical [optional] Indicación de borrado lógico
   * o borrado físico
   * @param array $orderBy [optional] Array con el o los nombres de los campos
   * por los cuales se ordenará la consulta
   * @param string $order [optional] Forma de ordenar la consulta
   * (por defecto NULL), pude ser ASC o DESC
   * @param integer $limit [optional] Cantidad de resultados a mostrar
   * @param integer $offset [optional] Página solicitadad sobre la cantidad
   * de datos a mostrar
   * @return mixed una instancia de una clase estandar, la cual tendrá como
   * variables publica los nombres de las columnas de la consulta o una
   * instancia de \PDOException en caso de fracaso.
   */
  public static function getAll($fields, $deletedLogical = true, $orderBy = null, $order = null, $limit = null, $offset = null,$where = NULL, $table = null) {
    return parent::getAll(self::getNameTable(), $fields, $deletedLogical, $orderBy, $order, $limit, $offset, $where, $table);
  }

  /**
   * Método para actualizar un registro en una tabla de una base de datos
   *
   * @param array $ids Array asociativo con las posiciones por nombres de los
   * campos y los valores son quienes serían las llaves a buscar.
   * @param array $data Array asociativo con los datos a modificar,
   * las posiciones por nombres de las columnas con los valores por los nuevos
   * datos a escribir
   * @return \PDOException|boolean
   */
  public static function update($ids, $data, $table = null) {
    return parent::update($ids, $data, self::getNameTable());
  }

}
