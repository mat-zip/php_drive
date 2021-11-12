<?php

namespace Controlador;

class UsuarioControlador extends Controlador
{
  public function criar()
  {
    $this->visao('usuarios/criar.php');
  }
}
