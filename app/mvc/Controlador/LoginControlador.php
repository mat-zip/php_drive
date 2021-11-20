<?php

namespace Controlador;

use Framework\DW3Sessao;
use Modelo\Usuario;

class LoginControlador extends Controlador
{
  public function criar()
  {
    $this->visao('login/index.php');
  }

  public function armazenar()
  {
    $usuario = Usuario::buscarEmail($_POST['email']);

    if ($usuario && $usuario->verificarSenha($_POST['password'])) {
      DW3Sessao::set('usuario', $usuario->getId());
      $this->redirecionar(URL_RAIZ . 'drive');
    } else {
      $this->visao('login/index.php');
    }
  }

  public function destruir()
  {
    DW3Sessao::deletar('usuario');
    $this->redirecionar(URL_RAIZ . 'login');
  }
}
