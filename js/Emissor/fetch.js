$(document).ready(function(){
	fetchAll();
	var emissor = [];
	function fetchAll()
	{
        let ajax = $.ajax({
            method: 'get',
            url: 'http://localhost/geradorXml/App/public/api/emissor/',
            dataType: 'json'
        }).done(function(data) {
			$("#container").find('#pID').text('ID: '+data[0].id);     
			$("#container").find('#pCNPJ #spanCNPJ').text(data[0].CNPJ);     
			$("#container").find('#pRazaoSocial #spanRazaoSocial').text(data[0].xNome);     
			$("#container").find('#pEndereco #spanEndereco').text(data[0].xLgr);     
			$("#container").find('#pNomeFantasia #spanNomeFantasia').text(data[0].xFant);     
			$("#container").find('#pNumero #spanNumero').text(data[0].nro);     
			$("#container").find('#pBairro #spanBairro').text(data[0].xBairro);     
			$("#container").find('#pCodigoMunicipio #spanCodigoMunicipio').text(data[0].cMun);     
			$("#container").find('#pCidade #spanCidade').text(data[0].xMun);     
			$("#container").find('#pUF #spanUF').text(data[0].UF);     
			$("#container").find('#pCEP #spanCEP').text(data[0].CEP);     
			$("#container").find('#pPais #spanPais').text(data[0].xPais);     
			$("#container").find('#pCPais #spanCPais').text(data[0].cPais);     
			$("#container").find('#pTelefone #spanTelefone').text(data[0].fone);     
			$("#container").find('#pIE #spanIE').text(data[0].IE);     
			$("#container").find('#pIM #spanIM').text(data[0].IM);     
			$("#container").find('#pCRT #spanCRT').text(data[0].CRT);     
			$("#container").find('#pCNAE #spanCNAE').text(data[0].CNAE);
			emissor = ajax.responseJSON;
		});
		return ajax;
	}
	$(document).on('click','#addEmissor',function(e){
		if(emissor.length >= 1) 
		{
			alert('Só é permitido cadastradrar um emissor!!');
		} else {
			e.preventDefault();
			$("#apiModal .modal-body .chart").remove(); 
			$("#apiModal .modal-body p").remove(); 
			$("h1").remove(); 
			$("#apiModal .modal-title").text('Cadastrar Emissor');
			$("#apiModal").modal('show');
			$('#apiModal').on('shown.bs.modal', function (e) {
				$(this)
				  .find("input,textarea,select")
					 .val('')
					 .end()
				  .find("input[type=checkbox], input[type=radio]")
					 .prop("checked", "")
					 .end();
			});
			$("#apiModal .modal-body").append($('#formEmissor').show());
			$("#apiModal .modal-footer .action").text('Cadastrar').show();        
			$("#apiModal .modal-footer .action").on('click', function (e){
				e.preventDefault();
				let CNPJ = $('#inputCNPJ').val();
				let fantasia = $('#inputFantasia').val();
				let social = $('#inputSocial').val();
				let endereco = $('#inputEndereco').val();
				let numero = $('#inputNumero').val();
				let bairro = $('#inputBairro').val();
				let fone = $('#inputTelefone').val();
				let CEP = $('#inputCEP').val();
				let cidade = $('#inputCidade').val();
				let cMun = $('#inputCMunicipio').val();
				let UF = $('#inputUF').val();
				let pais = $('#inputPais').val();
				let cPais = $('#inputCPais').val();
				let CNAE = $('#inputCNAE').val();
				let CRT = $('#inputCRT').val();
				let IM = $('#inputIM').val();
				let IE = $('#inputIE').val();
				$.ajax({
					method:'post',
					url:'http://localhost/geradorXml/App/public/api/emissor/add',
					dataType: 'json',
					data:{CNPJ:CNPJ, xFant:fantasia, xNome:social, xLgr:endereco, nro:numero,
						xBairro:bairro, fone:fone, CEP:CEP, xMun:cidade, UF:UF, xPais:pais, cPais:cPais, cMun:cMun,
						CNAE:CNAE, CRT:CRT, IM:IM, IE:IE}
				}).done(function(data){
					if(data == '{"success": "Emissor Adicionado"}') 
					{
						alert('Emissor Adicionado com Sucesso!!');
						window.location.replace("http://localhost/geradorXml/App/View/Emissor/fetchEmit.php");                
					}
				});
			});

		}
	});
	//Função muito grande, diminuir!!!
	$(document).on('click','#editarEmissor',function(e){
		e.preventDefault();
		// Pegar todos os valores do emissor cadastrado
		//Poderia pegar os valores fazendo uma requisição ajax na rota http://localhost/geradorXml/App/public/api/emissor/ - Metodo GET
		var id = $(this).offsetParent().children().find('#rowEmissorBody p#pID').text().replace(/[^0-9\.]/g, '');
		var CNPJ = $(this).offsetParent().children().find('#rowEmissorBody p #spanCNPJ').text();
		var fantasia = $(this).offsetParent().children().find('#rowEmissorBody p #spanNomeFantasia').text();
		var social = $(this).offsetParent().children().find('#rowEmissorBody p #spanRazaoSocial').text();
		var endereco = $(this).offsetParent().children().find('#rowEmissorBody p #spanEndereco').text();
		var numero = $(this).offsetParent().children().find('#rowEmissorBody p #spanNumero').text();
		var bairro = $(this).offsetParent().children().find('#rowEmissorBody p #spanBairro').text();
		var telefone = $(this).offsetParent().children().find('#rowEmissorBody p #spanTelefone').text();
		var CEP = $(this).offsetParent().children().find('#rowEmissorBody p #spanCEP').text();
		var cidade = $(this).offsetParent().children().find('#rowEmissorBody p #spanCidade').text();
		var UF = $(this).offsetParent().children().find('#rowEmissorBody p #spanUF').text();
		var pais = $(this).offsetParent().children().find('#rowEmissorBody p #spanPais').text();
		var cPais = $(this).offsetParent().children().find('#rowEmissorBody p #spanCPais').text();
		var cMun = $(this).offsetParent().children().find('#rowEmissorBody p #spanCodigoMunicipio').text();
		var CNAE = $(this).offsetParent().children().find('#rowEmissorBody p #spanCNAE').text();
		var CRT = $(this).offsetParent().children().find('#rowEmissorBody p #spanCRT').text();
		var IM = $(this).offsetParent().children().find('#rowEmissorBody p #spanIM').text();
		var IE = $(this).offsetParent().children().find('#rowEmissorBody p #spanIE').text();
		//Inserir nos inputs do formulário do emissor todos os valores capturados acima
		$('#inputCNPJ').val(CNPJ);
		$('#inputFantasia').val(fantasia);
		$('#inputSocial').val(social);
		$('#inputEndereco').val(endereco);
		$('#inputNumero').val(numero);
		$('#inputBairro').val(bairro);
		$('#inputTelefone').val(telefone);
		$('#inputCEP').val(CEP);
		$('#inputCidade').val(cidade);
		$('#inputCMunicipio').val(cMun);
		$('#inputUF').val(UF);
		$('#inputPais').val(pais);
		$('#inputCPais').val(cPais);
		$('#inputCNAE').val(CNAE);
		$('#inputCRT').val(CRT);
		$('#inputIM').val(IM);
		$('#inputIE').val(IE);
		//Remover itens que vem por padrão no modal
		$("#apiModal .modal-body .chart").remove(); 
		$("#apiModal .modal-body p").remove(); 
		$("h1").remove(); 
		// Adicionar Título
		$("#apiModal .modal-title").text('Cadastrar Emissor');
		$("#apiModal").modal('show');
		//Inserir o formulário do emissor no modal
		$("#apiModal .modal-body").append($('#formEmissor').show());
		//Modificar o texto do botão do modal
		$("#apiModal .modal-footer .action").text('Atualizar').show(); 
		//Editar o emissor       
		$("#apiModal .modal-footer .action").on('click', function (e){
			e.preventDefault();
			let CNPJup = $('#inputCNPJ').val();
			let fantasiaup = $('#inputFantasia').val();
			let socialup = $('#inputSocial').val();
			let enderecoup = $('#inputEndereco').val();
			let numeroup = $('#inputNumero').val();
			let bairroup = $('#inputBairro').val();
			let foneup = $('#inputTelefone').val();
			let CEPup = $('#inputCEP').val();
			let cidadeup = $('#inputCidade').val();
			let cMunup = $('#inputCMunicipio').val();
			let UFup = $('#inputUF').val();
			let paisup = $('#inputPais').val();
			let cPaisup = $('#inputCPais').val();
			let CNAEup = $('#inputCNAE').val();
			let CRTup = $('#inputCRT').val();
			let IMup = $('#inputIM').val();
			let IEup = $('#inputIE').val();
			$.ajax({
				method:'put',
				url: 'http://localhost/geradorXml/App/public/api/emissor/update/'+id,
				dataType: 'json',
				data:{id:id, CNPJ:CNPJup, xFant:fantasiaup, xNome:socialup, xLgr:enderecoup, nro:numeroup,
					xBairro:bairroup, fone:foneup, CEP:CEPup, xMun:cidadeup, UF:UFup, xPais:paisup, cPais:cPaisup, cMun:cMunup,
					CNAE:CNAEup, CRT:CRTup, IM:IMup, IE:IEup}
			}).done(function(data){
				if(data == '{"success": "Emissor Atualizado"}')
				{
					alert('Emissor Atualizado');
					location = location;
				}
			});
		});
	});
	$(document).on('click','#excluirEmissor',function(e){    
		var id = $(this).offsetParent().children().find('#rowEmissorBody p#pID').text().replace(/[^0-9\.]/g, '');
        let $confirm = confirm("Tem certeza que deseja excluir o emissor?");
        if($confirm)         
        {    
            $.ajax({
                method:'delete',
                url: 'http://localhost/geradorXml/App/public/api/emissor/delete/'+id
            }).done(function(data){
                if(data[0] == '{"success": "Emissor Deletado"}')
                {
                    alert('Emissor Deletedo Com Sucesso!!');   
                }   
                location = location;        
            });          
        }
	});
    //Botao fechar modalNFC-e, redirecionar para vendas.php
    $(".modalApi_fechar").on('click',function() {
        location = location;
    }); 
});