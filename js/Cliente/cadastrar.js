$(document).ready(function(){
  $("#rowButtons").show();
    $("#formCliente").fadeIn(800);
    $('#formCliente').on('submit', function(event)
    { 
        event.preventDefault();
        let nome = $('#inputNomeCliente').val();
        let CNPJ = $('#inputCNPJCliente').val();
        let endereco = $('#inputEnderecoCliente').val();
        let numero = $('#inputNumeroCliente').val();
        let complemento = $('#inputComplementoCliente').val();
        let bairro = $('#inputBairroCliente').val();
        let municipio = $('#inputMunicipioCliente').val();
        let UF = $('#inputUFCliente').val();
        let CEP = $('#inputCEPCliente').val();
        let fone = $('#inputTelefoneCliente').val();
        fone = fone.replace(/[^0-9]/g, '');

        validateNameField(nome, event);
        validateCEPField(CEP, event);
        validateEnderecoField(endereco, event);
        validateNumeroField(numero, event);
        validateBairroField(bairro, event);
        validateMunicipioField(municipio, event);
        validateUFField(UF, event);
        validateTelefoneField(fone, event);
        if(isValidName(nome) !== false && isValidCEP(CEP) !== false && isValidEndereco(endereco) !== false && isValidNumero(numero) !== false && isValidBairro(bairro) !== false && isValidMunicipio(municipio) !== false && isValidUF(UF) !== false  && isValidTelefone(fone) !== false)
        { 
            $.ajax({
            method:'post',
            url:'http://localhost/geradorXml/App/public/api/cliente/add',
            dataType: 'json',
            data:{nome:nome, CNPJ:CNPJ, endereco:endereco, numero:numero, 
                complemento:complemento, bairro:bairro, municipio:municipio, UF:UF, CEP:CEP, fone:fone }
            }).done(function(data){
                console.log(data);
            if(data == '{"success": "Cliente Adicionado"}') 
            {
                alert('Cliente Adicionado com Sucesso!!');
                window.location.replace("http://localhost/geradorXml/App/View/Cliente/fetch.php");
            }
            });
        }        
    });
    //Buscar Endereço, Bairro, Cidade e UF automaticamente pela API viacep
    $("#inputCEPCliente").focusout(function(){
        let cep = $(this).val().replace(/\D/g, '');
        //Verifica se campo cep possui valor informado.
        if (cep != "") {
            //Expressão regular para validar o CEP.
            let validacep = /^[0-9]{8}$/;
            //Valida o formato do CEP.
            if(validacep.test(cep)) {
                //Preenche os campos com "..." enquanto consulta webservice.
                $("#inputEnderecoCliente").val("...");
                $("#inputBairroCliente").val("...");
                $("#inputMunicipioCliente").val("...");
                $.ajax({
                    method:'get',
                    dataType: 'json',
                    url:"https://viacep.com.br/ws/"+ cep +"/json/?callback=?"
                }).done(function(data){
                    //Atualiza os campos com os valores da consulta.
                    $("#inputEnderecoCliente").val(data.logradouro);
                    $("#inputBairroCliente").val(data.bairro);
                    $("#inputMunicipioCliente").val(data.localidade);
                    $("#inputUFCliente").val(data.uf);
                }).fail(function(data){
                    console.log(data);
                });
            }
        }
    });
    //Validar Nome
    function isValidName(nome) {
      return nome.length >= 2  && nome.length <= 100;
    }
  
    function validateNameField(nome, event) {
      if (!isValidName(nome)) {
        $("#nome-feedback").text("Nome Inválido, Digite entre 2 e 100 letras ").css('color','red');
        alert('Nome Inválido!')
        event.preventDefault();
      } else {
        $("#nome-feedback").text("");
      }
    }
    //Validar CEP
    function isValidCEP(CEP) {
      //Tamanho 8 somente números - Tamanho 9 com a -
      return CEP.length === 8 || CEP.length === 9;
    }
  
    function validateCEPField(CEP, event) {
      if (!isValidCEP(CEP)) {
        $("#CEP-feedback").text("CEP Inválido").css('color','red');;
        alert('CEP Inválido!')
        event.preventDefault();
      } else {
        $("#CEP-feedback").text("");
      }
    }
    //Validar Endereço
    function isValidEndereco(endereco) {
      //Endereço no mínimo 2 letras e no máximo 100
      return endereco.length >= 2  && endereco.length <= 100;
    }
  
    function validateEnderecoField(endereco, event) {
      if (!isValidEndereco(endereco)) {
        $("#endereco-feedback").text("Endereco Inválido").css('color','red');
        alert('Endereco Inválido!')
        event.preventDefault();
      } else {
        $("#endereco-feedback").text("");
      }
    }
    //Validar Bairro
    function isValidBairro(Bairro) {
      //Bairro no mínimo 2 letras e no máximo 100
      return Bairro.length >= 2  && Bairro.length <= 100;
    }
  
    function validateBairroField(Bairro, event) {
      if (!isValidBairro(Bairro)) {
        $("#bairro-feedback").text("Bairro Inválido").css('color','red');
        alert('Bairro Inválido!')
        event.preventDefault();
      } else {
        $("#bairro-feedback").text("");
      }
    }
    //Validar Municipio
    function isValidMunicipio(Municipio) {
      //Municipio no mínimo 2 letras e no máximo 100
      return Municipio.length >= 2  && Municipio.length <= 100;
    }
  
    function validateMunicipioField(Municipio, event) {
      if (!isValidMunicipio(Municipio)) {
        $("#municipio-feedback").text("Municipio Inválido").css('color','red');
        alert('Municipio Inválido!')
        event.preventDefault();
      } else {
        $("#municipio-feedback").text("");
      }
    }
    //Validar UF
    function isValidUF(UF) {
      //UF tamanho 2 letras
      return UF.length === 2;
    }
  
    function validateUFField(UF, event) {
      if (!isValidUF(UF)) {
        $("#UF-feedback").text("UF Inválido").css('color','red');
        alert('UF Inválido!')
        event.preventDefault();
      } else {
        $("#UF-feedback").text("");
      }
    }
    //Validar Numero
    function isValidNumero(numero) {
      //Municipio no mínimo 2 letras e no máximo 20
      return numero.length >= 2  && numero.length <= 20;
    }
  
    function validateNumeroField(numero, event) {
      if (!isValidNumero(numero)) {
        $("#numero-feedback").text("Numero Inválido").css('color','red');
        alert('Numero Inválido!')
        event.preventDefault();
      } else {
        $("#numero-feedback").text("");
      }
    }
    //Validar Telefone - mascara para telefone residencial
    $('#inputTelefoneCliente').mask('(00) 0000-0009');
    $('#inputTelefoneCliente').blur(function(event) {
        if($(this).val().length == 14){ // Celular com 9 dígitos + 2 dígitos DDD e 4 da máscara
        $('#inputTelefoneCliente').mask('(00) 0000-0009');
        } else {
        $('#inputTelefoneCliente').mask('(00) 0000-0009');
        }
    });
    //Validar Telefone
    function isValidTelefone(Telefone) {
      //Tamanho máximo 10, será retirado caracteres especiais
      return Telefone.length === 10;
    }
  
    function validateTelefoneField(Telefone, event) {
      if (!isValidTelefone(Telefone)) {
        $("#telefone-feedback").text("Telefone Inválido").css('color','red');
        alert('Telefone Inválido!')
        event.preventDefault();
      } else {
        $("#telefone-feedback").text("");
      }
    }
    //Validar CNPJ - Código encontrado na internet
    $('#inputCNPJCliente').focusout(function(event){
        let CNPJ = $(this).cpfcnpj({
        mask: false,
        validate: 'cpfcnpj',
        event: 'focusout',
        // validateOnlyFocus: true,
        handler: '#inputCNPJCliente',
        ifValid: function (input) { input.removeClass("error"); input.addClass("success");},
        ifInvalid: function (input){  input.removeClass("success"); input.addClass("error");}
    });
    });
});