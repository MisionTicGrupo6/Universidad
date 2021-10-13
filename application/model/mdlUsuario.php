<?php

class mdlUsuario{

  public $idUsuario;
  public $usuario;
  public $clave;
  public $nombreCompleto;
  public $estado;
  public $db;

  public function __construct($db){
    try {
      $this->db = $db;
    } catch (PDOException $e) {
      exit("No se pudo conectar a la base de datos ".$e->getMessage());
    }

  }

  public function __SET($atributo, $valor){
      $this->$atributo = $valor;
  }

  public function __GET($atributo){
      return $this->$atributo;
  }

  public function validarUsuario(){
    $sql = "CALL validarUsuario(?,?)";
    $consulta = $this->db->prepare($sql);
    $consulta->bindParam(1, $this->usuario);
    $consulta->bindParam(2, $this->clave);
    $consulta->execute();
    return $consulta->fetch(PDO::FETCH_ASSOC);
  }

  public function crearUsuario(){
    $sql = "CALL sp_insertarUsuario(?,?,?,?)";
    $consulta = $this->db->prepare($sql);
    $consulta->bindParam(1, $this->usuario);
    $consulta->bindParam(2, $this->clave);
    $consulta->bindParam(3, $this->nombreCompleto);
    $consulta->bindParam(4, $this->estado);
    $res = $consulta->execute();
    return $res;
  }

  public function listaUsuarios(){
    $sql = "CALL sp_listaUsuarios()";
    $consulta = $this->db->prepare($sql);
    $consulta->execute();
    return $consulta->fetchAll(PDO::FETCH_ASSOC);
  }

  public function editarUsuario(){
    $sql = "CALL sp_editarUsuario(?,?,?)";
    $consulta = $this->db->prepare($sql);
    $consulta->bindParam(1, $this->idUsuario);
    $consulta->bindParam(2, $this->nombreCompleto);
    $consulta->bindParam(3, $this->usuario);
    $res = $consulta->execute();
    return $res;
  }

  public function cambiarEstado(){
    $sql = "CALL sp_cambiarEstado(?)";
    $consulta = $this->db->prepare($sql);
    $consulta->bindParam(1, $this->idUsuario);
    $res = $consulta->execute();
    return $res;
  }

  public function eliminarU(){
    $sql = "CALL SP_eliminarUsuario(?)";
    $consulta = $this->db->prepare($sql);
    $consulta->bindParam(1, $this->idUsuario);
    $res = $consulta->execute();
    return $res;
  }


}






 ?>
