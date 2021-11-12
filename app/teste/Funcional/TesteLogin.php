<?php

namespace Teste\Funcional;

use \Teste\Teste;

class TesteLogin extends Teste
{
  public function testeAcessar()
  {
    $resposta = $this->get(URL_RAIZ . 'login');
    $this->verificarContem($resposta, 'Login to your account');
  }
}
