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
      'mensagem_erro' => DW3Sessao::getFlash('mensagem_erro', null),
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

    if ($this->isUsuarioValido($usuario)) { // Já existe usuário cadastrado com esse email
      $usuario->salvar();
      DW3Sessao::setFlash('mensagem', 'Successfully registered user!');
      $this->redirecionar(URL_RAIZ . 'usuarios/criar');
    }
  }

  public function isUsuarioValido($usuario)
  {
    if (Usuario::buscarEmail($usuario->getEmail()) != null) {
      DW3Sessao::setFlash('mensagem_erro', 'Email already in use!');
      $this->redirecionar(URL_RAIZ . 'usuarios/criar');
    }

    if (
      $usuario->getName() == "" || $usuario->getSurname() == "" ||
      $usuario->getEmail() == "" || $usuario->getProfilePhoto() == ""
    ) {
      DW3Sessao::setFlash('mensagem_erro', 'Fill all the fields with the apropriate data!');
      $this->redirecionar(URL_RAIZ . 'usuarios/criar');
    }
    return true;
  }
}
