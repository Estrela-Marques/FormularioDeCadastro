<?php

class Form
{
  public static function alert($tipo, $mensagem)
  {
    if ($tipo == 'erro') {
      echo '<div style="background: black; color: red; font-size:25px">' . $mensagem . '</div>';
      return false;
    } else if ($tipo == 'sucesso') {
      echo '<div style="background: black; color: red; font-size: 25px;">' . $mensagem . '</div>';
      return true;
    }
  }

  public static function cadastrar($nome, $cep, $logradouro, $bairro, $cidade, $uf)
  {
    $dsn = "mysql:host=localhost;dbname=form_cadastro;charset=utf8";
    $pdo = new PDO($dsn, 'root', '');

    // Verifica se o registro já existe
    $selectQuery = $pdo->prepare("SELECT * FROM `formulario` WHERE nome = ? AND cep = ? AND logradouro = ? AND bairro = ? AND cidade = ? AND uf = ?");
    $selectQuery->execute(array($nome, $cep, $logradouro, $bairro, $cidade, $uf));
    $existingRecord = $selectQuery->fetch(PDO::FETCH_ASSOC);

    if ($existingRecord) {
      // Registro já existe
      return;
    }

    // Insere um novo registro
    $insertQuery = $pdo->prepare("INSERT INTO `formulario` VALUES (null, ?, ?, ?, ?, ?, ?)");
    $insertQuery->execute(array($nome, $cep, $logradouro, $bairro, $cidade, $uf));
  }
}
