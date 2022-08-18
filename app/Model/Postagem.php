<?php

class Postagem {
  public static function selecionarTodos() {
    $con = Connect::getConn();

    $sql = "SELECT * FROM postagem ORDER BY id DESC";
    $sql = $con->prepare($sql);
    $sql->execute();

    $resultado = array();

    while ($row = $sql->fetchObject('Postagem')) {
      $resultado[] = $row;
    }

    return !empty($resultado) ? $resultado : throw new Exception("Não foi encontrado nenhum registro");
  }

  public static function selecionarPorId($idPost) {
    $con = Connect::getConn();

    $sql = "SELECT * FROM postagem WHERE id = :id";
    $sql = $con->prepare($sql);
    $sql->bindValue(':id', $idPost, PDO::PARAM_INT);
    $sql->execute();

    $resultado = $sql->fetchObject('Postagem');

    if (!$resultado) {
      throw new Exception('Não foi encontrado nenhum registro');
    } else {
      $resultado->comentarios = Comentario::selecionarComentarios($resultado->id);
      
      if (!$resultado->comentarios) {
        $resultado->comentarios = 'Não existe nenhum comentário para essa postagem!';
      }
    }
    return $resultado;
  }
}