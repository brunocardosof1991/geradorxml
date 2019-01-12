$(document).ready(function(){
	fetchAll();
	var emissor = [];
	function fetchAll () 
    {      
        let ajax = $.ajax({
            method: 'get',
            url: 'http://localhost/geradorXml/App/public/api/emissor/',
            dataType: 'json'
        }).done(function(data) {
			//console.log(data);
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
	$(document).on('click','#editarEmissor',function(e){
		let id = emissor[0]['id'];
		$('#inputCNPJ').val(emissor[0]['CNPJ']);
		$('#inputFantasia').val(emissor[0]['xFant']);
		$('#inputSocial').val(emissor[0]['xNome']);
		$('#inputEndereco').val(emissor[0]['xLgr']);
		$('#inputNumero').val(emissor[0]['nro']);
		$('#inputBairro').val(emissor[0]['xBairro']);
		$('#inputTelefone').val(emissor[0]['fone']);
		$('#inputCEP').val(emissor[0]['CEP']);
		$('#inputCidade').val(emissor[0]['xMun']);
		$('#inputUF').val(emissor[0]['UF']);
		$('#inputPais').val(emissor[0]['xPais']);
		$('#inputCPais').val(emissor[0]['cPais']);
		$('#inputCMunicipio').val(emissor[0]['cMun']);
		$('#inputCNAE').val(emissor[0]['CNAE']);
		$('#inputCRT').val(emissor[0]['CRT']);
		$('#inputIM').val(emissor[0]['IM']);
		$('#inputIE').val(emissor[0]['IE']);
        $("#apiModal .modal-body .chart").remove(); 
        $("#apiModal .modal-body p").remove(); 
        $("h1").remove(); 
        $("#apiModal .modal-title").text('Editar Emissor');
        $("#apiModal").modal('show');
        $("#apiModal .modal-body").append($('#formEmissor').show());
		$("#apiModal .modal-footer .action").text('Editar').show();
		// onClick no botão Editar
		$("#apiModal .modal-footer .action").on('click',function(e)
		{
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
			let UF = $('#inputUF').val();
			let pais = $('#inputPais').val();
			let cPais = $('#inputCPais').val();
			let cMun = $('#inputCMunicipio').val();
			let CNAE = $('#inputCNAE').val();
			let CRT = $('#inputCRT').val();
			let IM = $('#inputIM').val();
			let IE = $('#inputIE').val();
			$.ajax({
				method:'put',
				url: 'http://localhost/geradorXml/App/public/api/emissor/update/'+id,
				dataType: 'json',
				data:{id:id, CNPJ:CNPJ, xFant:fantasia, xNome:social, xLgr:endereco, nro:numero,
					xBairro:bairro, fone:fone, CEP:CEP, xMun:cidade, UF:UF, xPais:pais, cPais:cPais, cMun:cMun,
					CNAE:CNAE, CRT:CRT, IM:IM, IE:IE}
			}).done(function(data){
				if(data == '{"success": "Emissor Atualizado"}')
				{
					alert('Emissor Atualizado');
					location = location;
				}
			});
		});       
	});
	$(document).on('click','#addEmissor',function(e){
        let ajax = $.ajax({
            method: 'get',
            url: 'http://localhost/geradorXml/App/public/api/emissor/',
            dataType: 'json'
        }).done(function(data) {
			if(typeof data[0] === "undefined")
			{		
				$("#apiModal .modal-body .chart").remove(); 
				$("#apiModal .modal-body p").remove(); 
				$("h1").remove(); 
				$("#apiModal .modal-title").text('Cadastrar Produto');
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
							window.location.replace("http://localhost/geradorXml/App/View/Emissor/fetch.php");                
						}
					});
				});
			} else
			{
				alert('Só é permitido cadastrar um emissor, favor excluir o emissor atual');
			}
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
	$(document).on('click','#salvarConfig',function(){
		alert('Configurar');
	});
    //Botao fechar modalNFC-e, redirecionar para vendas.php
    $(".modalApi_fechar").on('click',function() {
        location = location;
    }); 
});