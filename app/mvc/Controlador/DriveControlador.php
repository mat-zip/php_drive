<?php

namespace Controlador;

use Framework\DW3Sessao;
use Modelo\Arquivo;
use Modelo\Usuario;

class DriveControlador extends Controlador
{
  public function index()
  {
    
    $this->verificarLogado();
    $idUsuario = DW3Sessao::get('usuario');
    $usuario = Usuario::buscarId($idUsuario);
    if(isset($_GET['order_by'])){
      $order_by = $_GET['order_by'];
      $arquivos = Arquivo::buscarTodos($idUsuario, $order_by);
    } else {
      $arquivos = Arquivo::buscarTodos($idUsuario);
    }


    $this->visao(
      'drive/index.php',
      [
        'id' => $usuario->getId(),
        'name' => $usuario->getName(),
        'surname' => $usuario->getSurname(),
        'fullName' => $usuario->getFullName(),
        'email' => $usuario->getEmail(),
        'profilePhoto' => $usuario->getProfilePhoto(),
        'arquivos' => $arquivos,
        'mensagem' => DW3Sessao::getFlash('mensagem', null)
      ],
      'drive-template.php'
    );
  }

  public function armazenar()
  {
    if (array_key_exists('file', $_FILES)) {
      $nome = $_FILES['file']['name'];
      $tipo = $_FILES['file']['type'];
      $tamanho = $_FILES['file']['size'];
      $caminhoAtual = $_FILES['file']['tmp_name'];
      $caminhoSalvar = URL_ARQUIVOS . $nome;
      $dataAtual = $this->obterDataAtual();

      if ($nome == '' || $tipo == '' || $tamanho == 0) {
        $this->redirecionar(URL_RAIZ . 'drive');
      }

      $idUsuario = DW3Sessao::get('usuario');

      $arquivo = new Arquivo(
        $idUsuario,
        $nome,
        $tipo,
        $tamanho,
        $caminhoSalvar,
        $dataAtual
      );

      $arquivo->salvar();
      move_uploaded_file($caminhoAtual, $caminhoSalvar);
      DW3Sessao::setFlash('mensagem', 'File sent successfully');
      $this->redirecionar(URL_RAIZ . 'drive');
    }
  }

  public function destruir($id)
  {
    Arquivo::destruir($id);
    DW3Sessao::setFlash('mensagem', 'File deleted successfully');
    $this->redirecionar(URL_RAIZ . 'drive');
  }
}
