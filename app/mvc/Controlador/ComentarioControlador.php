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
    $usuario = Usuario::buscarId($arquivo->getUserId());
    $comentarios = Comentario::buscarComentarioPorArquivoId($id);

    $this->visao(
      'drive/comentarios.php',
      [
        'comentarios' => $comentarios,
        'usuario' => $usuario,
        'arquivo' => $arquivo,
      ]
    );
  }

  public function armazenar($id)
  {
    $this->verificarLogado();

    $comentario = new Comentario(
      DW3Sessao::get('usuario'),
      $id,
      $_POST['text'],
      $this->obterDataAtual(),
    );

    if ($comentario->isValido()) {
      $comentario->salvar();
      DW3Sessao::setFlash('comentarioSucesso', 'Comentário Cadastrado!');
      $this->redirecionar(URL_RAIZ . 'drive/' . $id . '/comentarios');
    }
  }

  public function destruir($id)
  {
    $commentId = $_POST['comment_id'];
    
    Comentario::destruir($commentId);
    $this->redirecionar(URL_RAIZ . 'drive/' . $id . '/comentarios');
  }
}
