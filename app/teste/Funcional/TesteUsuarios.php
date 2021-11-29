<?php

namespace Teste\Funcional;

use \Teste\Teste;
use Framework\DW3Sessao;
use Modelo\Usuario;

class TesteUsuarios extends Teste
{
  public function testeAcessar()
  {
    $resposta = $this->get(URL_RAIZ . 'usuarios/criar');
    $this->verificarContem($resposta, 'Create your account at');
  }

  public function testeCadastrarUsuario()
  {
    $resposta = $this->post(URL_RAIZ . 'usuarios', [
      'name' => 'Matheus',
      'surname' => 'Rocha',
      'email' => 'matheus@gmail.com',
      'profile-photo' => 'https://avatars.githubusercontent.com/u/48885595?v=4',
      'password' => '123',
    ]);

    $this->verificarRedirecionar($resposta, URL_RAIZ . 'usuarios/criar');
    $resposta = $this->get(URL_RAIZ . 'usuarios/criar');
    $this->verificarContem($resposta, 'Successfully registered user!');
  }

  public function testeCadastroInvalido()
  {
    $resposta = $this->post(URL_RAIZ . 'usuarios', [
      'name' => 'Matheus',
      'surname' => '',
      'email' => 'matheus@gmail.com',
      'profile-photo' => 'https://avatars.githubusercontent.com/u/48885595?v=4',
      'password' => '123',
    ]);

    $this->verificarRedirecionar($resposta, URL_RAIZ . 'usuarios/criar');
    $resposta = $this->get(URL_RAIZ . 'usuarios/criar');
    $this->verificarContem($resposta, 'Fill all the fields with the apropriate data!');
  }
}
