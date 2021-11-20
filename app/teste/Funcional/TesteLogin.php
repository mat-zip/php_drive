<?php

namespace Teste\Funcional;

use Framework\DW3Sessao;
use Modelo\Usuario;
use \Teste\Teste;

class TesteLogin extends Teste
{
  public function testeAcessar()
  {
    $resposta = $this->get(URL_RAIZ . 'login');
    $this->verificarContem($resposta, 'Login to your account');
  }

  public function testeLogin()
  {
    (new Usuario(
      'Matheus',
      'Rocha',
      'matheus@gmail.com',
      'https://avatars.githubusercontent.com/u/48885595?v=4',
      '123'
    ))->salvar();

    $resposta = $this->post(URL_RAIZ . 'login', [
      'email' => 'matheus@gmail.com',
      'password' => '123'
    ]);

    $this->verificarRedirecionar($resposta, URL_RAIZ . 'drive');
    $this->verificar(DW3Sessao::get('usuario') != null);
  }

  public function testeLoginInvalido()
  {
    (new Usuario(
      'Matheus',
      'Rocha',
      'matheus@gmail.com',
      'https://avatars.githubusercontent.com/u/48885595?v=4',
      '123'
    ))->salvar();

    $resposta = $this->post(URL_RAIZ . 'login', [
      'email' => 'matheus@gmail.com',
      'password' => '123'
    ]);

    $resposta = $this->delete(URL_RAIZ . 'login');
    $this->verificarRedirecionar($resposta, URL_RAIZ . 'login');
    $this->verificar(DW3Sessao::get('usuario') == null);
  }
}
