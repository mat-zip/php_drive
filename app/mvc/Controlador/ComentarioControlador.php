<?php

namespace Controlador;

use Framework\DW3Sessao;
use Modelo\Comentario;
use Modelo\Usuario;
use Modelo\Arquivo;

class ComentarioControlador extends Controlador
{
  public function mostrar($id)
  {
    $arquivo = Arquivo::buscarId($id);
    $usuario = Usuario::buscarId(DW3Sessao::get('usuario'));
    $comentarios = Comentario::buscarComentarioPorArquivoId($id);
    $mensagem = DW3Sessao::getFlash('mensagem');

    if ($arquivo->getUserId() == $usuario->getId()) {
      $this->visao(
        'drive/comentarios.php',
        [
          'comentarios' => $comentarios,
          'usuario' => $usuario,
          'arquivo' => $arquivo,
          'mensagem' => $mensagem
        ]
      );
    } else {
      $this->redirecionar(URL_RAIZ . 'drive');
    }
  }

  public function armazenar($id)
  {
    $this->verificarLogado();

    $comentario = new Comentario(
      DW3Sessao::get('usuario'),
      $id, // id do arquivo que será adicionado um comentário
      $_POST['text'],
      $this->obterDataAtual(),
    );

    if ($comentario->isValido()) {
      $comentario->salvar();
      DW3Sessao::setFlash('mensagem', 'Comment successfully registered!');
      $this->redirecionar(URL_RAIZ . 'drive/' . $id . '/comentarios');
    }
  }

  public function destruir($id)
  {
    $commentId = $_POST['comment_id'];

    Comentario::destruir($commentId);
    DW3Sessao::setFlash('mensagem', 'Comment successfully deleted!');
    $this->redirecionar(URL_RAIZ . 'drive/' . $id . '/comentarios');
  }

  public function editar($id)
  {

    $comentario = Comentario::buscarId($id);
    $usuario = Usuario::buscarId(DW3Sessao::get('usuario'));
    $arquivo = Arquivo::buscarId($comentario->getFileId());

    if ($usuario->getId() == $comentario->getUserId()) {
      $this->visao(
        'drive/editar.php',
        [
          'comentario' => $comentario,
          'usuario' => $usuario,
          'arquivo' => $arquivo
        ]
      );
    } else {
      $this->redirecionar(URL_RAIZ . 'drive');
    }
  }

  public function atualizar($id)
  {
    $comentario = Comentario::buscarId($_POST['comment_id']);
    $comentario->setText($_POST['text-comment']);
    $comentario->setUploadDate($this->obterDataAtual());
    $comentario->salvar();
    DW3Sessao::setFlash('mensagem', 'Comment successfully updated!');
    $this->redirecionar(URL_RAIZ . 'drive/' . $id . '/comentarios');
  }
}
