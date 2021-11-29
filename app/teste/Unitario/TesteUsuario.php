<?php

namespace Teste\Unitario;

use \Teste\Teste;
use \Modelo\Usuario;
use \Framework\DW3BancoDeDados;

class TesteUsuario extends Teste
{
  public function testeArmazenar()
  {
    $usuario = new Usuario(
      "Matheus",
      "Rocha",
      "matheus@gmail.com",
      "https://avatars.githubusercontent.com/u/48885595?v=4",
      "123"
    );

    $usuario->salvar();
    $query = DW3BancoDeDados::query('SELECT * FROM usuarios WHERE name = "Matheus"');
    $bdUsuarios = $query->fetchAll();
    $this->verificar(count($bdUsuarios) == 1);
  }

  public function testeBuscarId()
  {
    $usuario1 = new Usuario(
      "Maria",
      "Silva",
      "maria@gmail.com",
      "https://avatars.githubusercontent.com/u/48885595?v=4",
      "123"
    );

    $usuario1->salvar();
    $usuario2 = Usuario::buscarId($usuario1->getId());
    $this->verificar($usuario1->getName() == $usuario2->getName());
  }

  public function testeBuscarNome()
  {
    (new Usuario(
      "Matheus",
      "Rocha",
      "matheus@gmail.com",
      "https://avatars.githubusercontent.com/u/48885595?v=4",
      "123"
    ))->salvar();

    $usuario = Usuario::buscarNome("Matheus");
    $this->verificar($usuario != null);
  }
}
