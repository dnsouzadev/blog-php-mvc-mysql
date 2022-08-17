<?php

class Postagem {
  public static function selecionarTodos() {
    $con = Connection::getConn();

    $sql = "SELECT * FROM postagem ORDER BY id DESC";
    $sql = $con->prepare($sql);
    $sql->execute();

    $resultado = array();

    while ($row = $sql->fetchObject('Postagem')) {
      $resultado[] = $row;
    }

    return !empty($resultado) ? $resultado : throw new Exception("Não foi encontrado nenhum registro");
  }
}