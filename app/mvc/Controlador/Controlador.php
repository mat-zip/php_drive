<?php

namespace Controlador;

use DateTime;
use DateTimeZone;
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

  
  public function obterDataAtual()
  {
    $fusoHorario = new DateTimeZone('America/Sao_Paulo');
    $agora = new DateTime('now', $fusoHorario); // com fuso-horário
    $tempoFormatado = $agora->format('Y-m-d H:i:s');
    return $tempoFormatado;
  }
}
