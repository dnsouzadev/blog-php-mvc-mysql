<?php

class Core {
  public function start($urlget) {
    $acao = 'index';

    if(!isset($urlget['pagina'])) {
      $controller = 'HomeController';
    } else {
      $controller = ucfirst($urlget['pagina'].'Controller');
    }

    if(!class_exists($controller)) {
      $controller = 'ErroController';
    }

    call_user_func_array(array(new $controller, $acao), array());
  }
}