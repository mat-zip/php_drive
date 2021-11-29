<?php

namespace Controlador;

use \Modelo\Usuario;
use \Framework\DW3Controlador;
use \Framework\DW3Sessao;

abstract class Controlador extends DW3Controlador
{
  protected $usuario;

  public function verificarLogado()
  {
    $usuario = $this->getUsuario();
    if ($usuario == null)
      $this->redirecionar(URL_RAIZ . 'login');
  }

  public function getUsuario()
  {
    if ($this->usuario == null) {
      $usuarioId = DW3Sessao::get('usuario');
      if ($usuarioId == null)
        return null;

      $this->usuario = Usuario::buscarId($usuarioId);
    }
    return $this->usuario;
  }
}
