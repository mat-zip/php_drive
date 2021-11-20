<?php

namespace Controlador;

use Framework\DW3Sessao;
use Modelo\Usuario;

class UsuarioControlador extends Controlador
{
  public function criar()
  {
    $this->visao('usuarios/criar.php', [
      'mensagem' => DW3Sessao::getFlash('mensagem', null),
    ]);
  }

  public function armazenar()
  {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $profilePhoto = $_POST['profile-photo'];
    $password = $_POST['password'];

    $usuario = new Usuario($name, $surname, $email, $profilePhoto, $password);
    $usuario->salvar();
    DW3Sessao::setFlash('mensagem', 'Successfully registered user!');
    $this->redirecionar(URL_RAIZ . 'usuarios/criar');
  }
}
