<?php

class Postagem {
  public static function selecionarTodos() {
    $con = Connection::getConn();

    var_dump($con);
  }
}