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
    }
    return $resultado;
  }

  public static function insert($dadosPost) {
    $con = Connect::getConn();

    $dados = $dadosPost['conteudo'] && $dadosPost['titulo'] ? $dadosPost : null;

    if ($dados == null) {
      return false;
    }

    $sql = "INSERT INTO postagem (titulo, conteudo) VALUES (:titulo, :conteudo)";
    $sql = $con->prepare($sql);
    $sql->bindValue(':titulo', $dados['titulo']);
    $sql->bindValue(':conteudo', $dados['conteudo']);
    $sql->execute();

    $resultado = $sql->fetchObject('Postagem');
    return true;
  }
}