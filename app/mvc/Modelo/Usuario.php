<?php

namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;

class Usuario extends Modelo
{
  const BUSCAR_ID = 'SELECT * FROM usuarios WHERE id = ?';
  const BUSCAR_NOME = 'SELECT * FROM usuarios WHERE name = ?';
  const BUSCAR_EMAILS = 'SELECT * FROM usuarios WHERE email = ?';
  const INSERIR = 'INSERT INTO usuarios(name, surname, email, profilePhoto, password) VALUES (?,?,?,?,?)';

  private $id;
  private $name;
  private $surname;
  private $email;
  private $profilePhoto;
  private $password;
  private $password_hash;

  public function __construct(
    $name = null,
    $surname = null,
    $email = null,
    $profilePhoto = null,
    $passwordHash = null,
    $id = null
  ) {
    $this->name = $name;
    $this->surname = $surname;
    $this->email = $email;
    $this->profilePhoto = $profilePhoto;
    $this->passwordHash = $passwordHash;
    $this->password = password_hash($passwordHash, PASSWORD_BCRYPT);
    $this->id = $id;
  }

  public function getId()
  {
    return $this->id;
  }

  public function getName()
  {
    return $this->name;
  }

  public function getSurname()
  {
    return $this->surname;
  }

  public function getFullName()
  {
    return $this->name . ' ' . $this->surname;
  }

  public function getEmail()
  {
    return $this->email;
  }

  public function getProfilePhoto()
  {
    return $this->profilePhoto;
  }

  public function verificarSenha($password_hash)
  {
    return password_verify($password_hash, $this->password);
  }

  public function salvar()
  {
    $this->inserir();
  }

  public function inserir()
  {
    DW3BancoDeDados::getPdo()->beginTransaction();
    $comando = DW3BancoDeDados::prepare(self::INSERIR);
    $comando->bindValue(1, $this->name, PDO::PARAM_STR);
    $comando->bindValue(2, $this->surname, PDO::PARAM_STR);
    $comando->bindValue(3, $this->email, PDO::PARAM_STR);
    $comando->bindValue(4, $this->profilePhoto, PDO::PARAM_STR);
    $comando->bindValue(5, $this->password, PDO::PARAM_STR);
    $comando->execute();
    $this->id = DW3BancoDeDados::getPdo()->lastInsertId();
    DW3BancoDeDados::getPdo()->commit();
  }

  public static function buscarEmail($email)
  {
    $comando = DW3BancoDeDados::prepare(self::BUSCAR_EMAILS);
    $comando->bindValue(1, $email, PDO::PARAM_STR);
    $comando->execute();
    $registro = $comando->fetch();
    $usuario = null;
    if ($registro) {
      $usuario = new Usuario(
        $registro['name'],
        $registro['surname'],
        $registro['email'],
        $registro['profilePhoto'],
        null,
        $registro['id']
      );
      $usuario->password = $registro['password'];
    }
    return $usuario;
  }

  public static function buscarId($id)
  {
    $comando = DW3BancoDeDados::prepare(self::BUSCAR_ID);
    $comando->bindValue(1, $id, PDO::PARAM_INT);
    $comando->execute();
    $registro = $comando->fetch();
    return new Usuario(
      $registro['name'],
      $registro['surname'],
      $registro['email'],
      $registro['profilePhoto'],
      null,
      $registro['id']
    );
  }

  public static function buscarNome($name)
  {
    $comando = DW3BancoDeDados::prepare(self::BUSCAR_NOME);
    $comando->bindValue(1, $name, PDO::PARAM_STR);
    $comando->execute();
    $registro = $comando->fetch();
    $usuario = null;
    if ($registro) {
      $usuario = new Usuario(
        $registro['name'],
        $registro['surname'],
        $registro['email'],
        $registro['profilePhoto'],
        null,
        $registro['id']
      );
      $usuario->password = $registro['password'];
    }

    return $usuario;
  }
}
