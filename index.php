<?php
// Inclusão dos arquivos
include_once('Form.php');
include('config.php');
include('Mysql.php');
Mysql::conectar(); // Conexão com o banco de dados
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <title>Página de Cadastro</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="form.css">
  <script type="text/javascript" src="js/jquery-3.6.1.min.js"></script>
  <script type="text/javascript" src="js/jquery.mask.min.js"></script>
</head>

<body>
  <div class="form_cd">
    <?php
    if (isset($_POST['acao']) && $_POST['form'] == 'f_form') {
      // Atribuição dos valores dos campos do formulário
      $nome = $_POST['nome'];
      $cep = $_POST['cep'];
      $logradouro = $_POST['logradouro'];
      $bairro = $_POST['bairro'];
      $cidade = $_POST['cidade'];
      $uf = $_POST['uf'];

      // Se houver campo vazio aparece msg de erro. Senão exibe uma mensagem sucesso
      if ($nome == '') {
        Form::alert('erro', 'Nome precisa ser preenchido!');
      } else if ($cep == '') {
        Form::alert('erro', 'Cep precisa ser preenchido!');
      } else if ($logradouro == '') {
        Form::alert('erro', 'Logradouro precisa ser preenchido!');
      } else if ($bairro == '') {
        Form::alert('erro', 'Bairro precisa ser preenchido!');
      } else if ($cidade == '') {
        Form::alert('erro', 'Cidade precisa ser preenchida!');
      } else if ($uf == '') {
        Form::alert('erro', 'UF precisa ser preenchido!');
      } else {
        Form::cadastrar($nome, $cep, $logradouro, $bairro, $cidade, $uf);
      }
    }
    ?>

    <h2>Cadastre-se</h2>
    <form method="POST">
      <div><input type="text" placeholder="Nome" name="nome"></div>
      <div><input type="text" placeholder="Cep" name="cep" id="cep"></div>
      <div><input type="text" placeholder="Logradouro" name="logradouro" id="logradouro" class=".endereco"></div>
      <div><input type="text" placeholder="Bairro" name="bairro" id="bairro" class=".endereco"></div>
      <div><input type="text" placeholder="Cidade" name="cidade" id="cidade" class=".endereco"></div>
      <div><input type="text" placeholder="UF" name="uf" id="uf" class=".endereco"></div>
      <div><input type="submit" name="acao" value="Cadastrar"></div>
      <div><input type="hidden" name="form" value="f_form"></div>
    </form>
  </div>
</body>
<script type="text/javascript" src="js/index.js"></script>

</html>