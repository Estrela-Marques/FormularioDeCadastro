//mensagens utilizadas na página
var mensagens = {
  cepObrigatorio: 'Digite um cep válido!'
}

var servicos = {
  conultaDeCep: 'https://viacep.com.br/ws/'
}

//campos da landing page
var campos = {
  nome: $('#nome'),
  cep: $('#cep'),
  bairro: $('#bairro'),
  logradouro: $('#logradouro'),
  cidade: $('#cidade'),
  uf: $('#uf'),
  grupoEndereco: $('.endereco')
}

//configuração do campo cep
var cepOptions = {
  onComplete: function (cep) {
    desabilitaCamposDeEndereco()
    encontrarCep(cep)
  },
  onKeyPress: function (cep, event, currentField, options) {},
  onChange: function (cep) {},
  onInvalid: function (val, e, f, invalid, options) {
    var error = invalid[0]
    console.log(
      'Digit: ',
      error.v,
      ' is invalid for the position: ',
      error.p,
      '. We expect something like: ',
      error.e
    )
  }
}

function montaUrlConsultaCep(cep) {
  return servicos.conultaDeCep + cep + '/json/'
}

//consulta do CEP na API
function encontrarCep(cep) {
  if (cep) {
    $.ajax({
      type: 'GET',
      dataType: 'json',
      url: montaUrlConsultaCep(cep),
      async: true,
      success: function (response) {
        campos.bairro.val(response.bairro)
        campos.logradouro.val(response.logradouro)
        campos.cidade.val(response.localidade)
        campos.uf.val(response.uf)
      },
      error: function (e) {
        alert(e.statusText)
      },
      complete: function () {
        habilitaCamposDeEndereco()
      }
    })
  } else {
    alert(mensagens.cepObrigatorio)
  }
}

function desabilitaCamposDeEndereco() {
  campos.grupoEndereco.prop('readonly', true)
}

function habilitaCamposDeEndereco() {
  campos.grupoEndereco.prop('readonly', false)
}

//definindo eventos dos campos
$(document).ready(function () {
  campos.cep.mask('00000000', cepOptions)
})
