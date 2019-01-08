$(document).ready(function(){
    $("#formCliente").fadeIn(800);
    $("#rowButtons").show();
	$('#formCliente').on('submit', function(e){ 
		e.preventDefault();
        let nome = $('#inputNomeCliente').val();
        let CNPJ = $('#inputCNPJCliente').val();
        let endereco = $('#inputEnderecoCliente').val();
        let numero = $('#inputNumeroCliente').val();
        let complemento = $('#inputComplementoCliente').val();
        let bairro = $('#inputBairroCliente').val();
        let CEP = $('#inputCEPCliente').val();
        let fone = $('#inputTelefoneCliente').val();
        $.ajax({
            method:'post',
            url:'http://localhost/geradorXml/App/public/api/cliente/add',
            dataType: 'json',
            data:{nome:nome, CNPJ:CNPJ, endereco:endereco, numero:numero, 
                complemento:complemento, bairro:bairro, CEP:CEP, fone:fone }
        }).done(function(data){
            if(data == '{\"Aviso\": {\"text\": \"Cliente Adicionado\"}') 
            {
                alert('Cliente Adicionado com Sucesso!!');
                window.location.replace("http://localhost/geradorXml/App/View/Cliente/fetch.php");
            }
        });
    });   
});