<?php
if (isset($_POST['cep'])) {
  $cep = $_POST['cep'];
  $url = "https://viacep.com.br/ws/" . urlencode($cep) . "/json/";

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $response = curl_exec($ch);
  curl_close($ch);

  $addressData = json_decode($response, true);

  if ($addressData && !isset($addressData['erro'])) {
    // Utilize os dados do endereço retornado para preencher os campos desejados
    $logradouro = $addressData['logradouro'] ?? '';
    $bairro = $addressData['bairro'] ?? '';
    $cidade = $addressData['localidade'] ?? '';
    $uf = $addressData['uf'] ?? '';

    var_dump($addressData); // Exibir os dados retornados pela API para verificar a estrutura
  } else {
    // Se houve um erro na consulta ou o CEP não foi encontrado
    // Trate o erro conforme necessário
    echo "Erro ao consultar o CEP.";
  }
}
