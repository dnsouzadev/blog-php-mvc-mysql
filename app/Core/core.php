<?php

class Core {
  public function start($urlget) {
    $acao = 'index';

    $controller = !isset($urlget['pagina']) ? 'HomeController' : ucfirst($urlget['pagina'].'Controller');

    if(!class_exists($controller)) {
      $controller = 'ErroController';
    }

    $id = isset($urlget['id']) && $urlget['id'] != null ? $urlget['id'] : '0';

    call_user_func(array(new $controller, $acao), array('id' => $id));
  }
}