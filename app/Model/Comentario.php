<?php

use Connection as GlobalConnection;
use FTP\Connection;

class Comentario {
  public static function selecionarComentarios($idPostagem) {
    $conn = Connect::getConn();

    $sql = "SELECT * FROM comentario WHERE id_postagem = :id";
    $sql = $conn->prepare($sql);
    $sql->bindValue(':id', $idPostagem, PDO::PARAM_INT);
    $sql->execute();

    $resultado = array();

    while ($row = $sql->fetchObject('Comentario')) {
      $resultado[] = $row;
    }

    return $resultado;
  }
}