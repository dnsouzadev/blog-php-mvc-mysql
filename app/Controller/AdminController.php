<?php

class AdminController
{
  public function index()
  {
    $loader = new \Twig\Loader\FilesystemLoader('app/View');
    $twig = new \Twig\Environment($loader);
    $template = $twig->load('admin.html');

    $objPostagens = Postagem::selecionarTodos();

    $parametros = array();
    $parametros['postagens'] = $objPostagens;

    $conteudo = $template->render($parametros);
    echo $conteudo;
  }

  public function create()
  {
    $loader = new \Twig\Loader\FilesystemLoader('app/View');
    $twig = new \Twig\Environment($loader);
    $template = $twig->load('create.html');

    $parametros = array();

    $conteudo = $template->render($parametros);
    echo $conteudo;
  }

  public function insert()
  {
    try {
      Postagem::insert($_POST);
      echo '<script>alert("Publicação inserida com sucesso");</script>';
      echo '<script>location.href="http://localhost/blog/?pagina=admin&metodo=index";</script>';
    } catch(Exception $e) {
      echo '<script>alert("'.$e->getMessage().'");</script>';
      echo '<script>location.href="http://localhost/blog/?pagina=admin&metodo=create";</script>';
    }
  }

  public function change() 
  {
    $loader = new \Twig\Loader\FilesystemLoader('app/View');
    $twig = new \Twig\Environment($loader);
    $template = $twig->load('update.html');

    $id = $_GET['id'];

    $post = Postagem::selecionarPorId($id);

    $parametros = array();
    $parametros['id'] = $id;
    $parametros['titulo'] = $post->titulo;
    $parametros['conteudo'] = $post->conteudo;

    $conteudo = $template->render($parametros);
    echo $conteudo;

  }

  public function update() {
    $id = $_GET['id'];
    try {
      Postagem::update($_POST);
      echo '<script>alert("Publicação alterada com sucesso");</script>';
      echo '<script>location.href="http://localhost/blog/?pagina=admin&metodo=index";</script>';
    } catch(Exception $e) {
      echo '<script>alert("' . $e->getMessage() . '");</script>';
      echo '<script>location.href="http://localhost/blog/?pagina=admin&metodo=change&id="'.$id.'";</script>';
    }
  }

  public function delete()
  {
    $id = $_GET['id'];
    try {
      Postagem::delete($id);
      echo '<script>alert("Publicação deletada com sucesso");</script>';
      echo '<script>location.href="http://localhost/blog/?pagina=admin&metodo=index";</script>';
    } catch (Exception $e) {
      echo '<script>alert("' . $e->getMessage() . '");</script>';
      echo '<script>location.href="http://localhost/blog/?pagina=admin&metodo=index";</script>';
    }
  }
}
