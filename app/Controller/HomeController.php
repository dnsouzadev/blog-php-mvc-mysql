<?php

class HomeController {
  public function index() {
    try {
      $colecPostagens = Postagem::selecionarTodos();
      var_dump($colecPostagens);
    } catch(Exception $e) {
      echo $e->getMessage();
    }
  }
}