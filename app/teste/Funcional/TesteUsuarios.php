<?php

namespace Teste\Funcional;

use \Teste\Teste;

class TesteUsuarios extends Teste
{
  public function testeAcessar()
  {
    $resposta = $this->get(URL_RAIZ . 'usuarios/criar');
    $this->verificarContem($resposta, 'Create your account at');
  }
}
