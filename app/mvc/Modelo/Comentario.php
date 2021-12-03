<?php

namespace Modelo;

use PDO;
use Framework\DW3BancoDeDados;

class Comentario extends Modelo
{
  const BUSCAR_POR_ID_ARQUIVO = 'SELECT * FROM comentarios WHERE file_id = ?';
  const INSERIR = 'INSERT INTO comentarios(user_id, file_id, text, upload_date) VALUES (?,?,?,?)';
  const BUSCAR_ID = 'SELECT * FROM comentarios WHERE id = ?';
  const DELETAR = 'DELETE FROM comentarios WHERE id = ?';

  private $id;
  private $userId;
  private $fileId;
  private $text;
  private $uploadDate;

  public function __construct(
    $userId,
    $fileId,
    $text,
    $uploadDate,
    $id = null
  ) {
    $this->userId = $userId;
    $this->fileId = $fileId;
    $this->text = $text;
    $this->uploadDate = $uploadDate;
    $this->id = $id;
  }

  public function getId()
  {
    return $this->id;
  }
  public function getUserId()
  {
    return $this->userId;
  }
  public function getFileId()
  {
    return $this->fileId;
  }
  public function getText()
  {
    return $this->text;
  }
  public function getUploadDate()
  {
    return $this->uploadDate;
  }

  public function salvar()
  {
    $this->inserir();
  }

  public function inserir()
  {
    DW3BancoDeDados::getPdo()->beginTransaction();
    $comando = DW3BancoDeDados::prepare(self::INSERIR);
    $comando->bindValue(1, $this->userId, PDO::PARAM_INT);
    $comando->bindValue(2, $this->fileId, PDO::PARAM_INT);
    $comando->bindValue(3, $this->text, PDO::PARAM_STR);
    $comando->bindValue(4, $this->uploadDate);
    $comando->execute();

    $this->id = DW3BancoDeDados::getPdo()->lastInsertId();
    DW3BancoDeDados::getPdo()->commit();
  }

  public static function buscarComentarioPorArquivoId($id)
  {
    $comando = DW3BancoDeDados::prepare(self::BUSCAR_POR_ID_ARQUIVO);
    $comando->bindValue(1, $id, PDO::PARAM_INT);
    $comando->execute();
    $registros = $comando->fetchAll();
    $comentarios = [];

    foreach ($registros as $registro) {
      $comentarios[] = new Comentario(
        $registro['user_id'],
        $registro['file_id'],
        $registro['text'],
        $registro['upload_date'],
        $registro['id'],
      );
    }

    return $comentarios;
  }

  public static function buscarId($id)
  {
    $comando = DW3BancoDeDados::prepare(self::BUSCAR_ID);
    $comando->bindValue(1, $id, PDO::PARAM_INT);
    $comando->execute();
    $registro = $comando->fetch();

    return new Comentario(
      $registro['user_id'],
      $registro['file_id'],
      $registro['text'],
      $registro['upload_date'],
      $registro['id']
    );
  }

  public static function destruir($id)
  {
    $comentario = Comentario::buscarId($id);

    $comando = DW3BancoDeDados::prepare(self::DELETAR);
    $comando->bindValue(1, $id, PDO::PARAM_INT);
    $comando->execute();
  }
}
