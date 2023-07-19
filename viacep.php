<?php
if (isset($_POST['cep'])) { // Verifica se o campo 'cep' foi enviado no formulário
  $cep = $_POST['cep']; // Obtém o valor do campo 'cep' enviado no formulário
  $url = "https://viacep.com.br/ws/" . urlencode($cep) . "/json/"; // Cria a URL da API do ViaCEP com o CEP informado

  $ch = curl_init(); // Inicia uma sessão cURL
  curl_setopt($ch, CURLOPT_URL, $url); // Define a URL para a requisição cURL
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Define a opção para retornar o resultado como uma string
  $response = curl_exec($ch); // Executa a requisição cURL e obtém a resposta
  curl_close($ch); // Fecha a sessão cURL

  $addressData = json_decode($response, true); // Decodifica o JSON da resposta em um array associativo

  if ($addressData && !isset($addressData['erro'])) {  // Verifica se o array de dados do endereço existe e se não há erros
    // Utiliza os dados do endereço retornado para preencher os campos desejados
    $logradouro = $addressData['logradouro'] ?? '';
    $bairro = $addressData['bairro'] ?? '';
    $cidade = $addressData['localidade'] ?? '';
    $uf = $addressData['uf'] ?? '';

    var_dump($addressData); // Exibe os dados retornados pela API para verificar a estrutura
  } else {
    echo "Erro ao consultar o CEP."; // Exibe uma mensagem de erro caso ocorra algum problema na consulta ou se o CEP não foi encontrado
  }
}
