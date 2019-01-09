$(document).ready(function(){	
	fetchAll();
	var emissor = [];
	var size = '';
    function fetchAll() 
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
			var size = emissor.length;
		});
	}
	$(document).on('click','#editarEmissor',function(e){
		$('#apiModal').on('hidden.bs.modal', function () {
			$(this).find('form').trigger('reset');
		})
		e.preventDefault(); 
		console.log(size)
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
        $("#apiModal .modal-footer .action").on('click',function(e){
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
				if(data == '{"Aviso": {"text": "Emissor Atualizado"}')
				{
					alert('Emissor Atualizado');
					location = location;
				}
			});
		});       
	});
	$(document).on('click','#addEmissor',function(e){
		$.showModal({
			title: 'Cadastrar Emissor',
			body:
				'<form><div class="form-group row">' +
				'<div class="col-3"><label for="text" class="col-form-label">Text</label></div>' +
				'<div class="col-9"><input type="text" class="form-control" id="text"/></div>' +
				'</div>' +
				'<div class="form-group row">' +
				'<div class="col-3"><label for="select" class="col-form-label">Select</label></div>' +
				'<div class="col-9"><select id="select" class="form-control">' +
				'<option value=""></option>' +
				'<option value="red">red</option><option value="green">green</option><option value="blue">blue</option>' +
				'</select></div>' +
				'</div>' +
				'<div class="form-group row">' +
				'<div class="col-3"><label for="textarea" class="col-form-label">Textarea</label></div>' +
				'<div class="col-9"><textarea id="textarea" rows="5" class="form-control"></textarea></div>' +
				'</div></form>',
			footer: '<button type="button" class="btn btn-link" data-dismiss="modal">Cancel</button><button type="submit" class="btn btn-primary">Send</button>',
			onCreate: function (modal) {
				// create event handler for form submit and handle values
				$(modal.element).on("click", "button[type='submit']", function (event) {
					event.preventDefault()
					var $form = $(modal.element).find("form")
					$.showAlert({
						title: "Result",
						body:
							"<b>text:</b> " + $form.find("#text").val() + "<br/>" +
							"<b>select:</b> " + $form.find("#select").val() + "<br/>" +
							"<b>textarea:</b> " + $form.find("#textarea").val()
					})
					modal.hide()
				})
			}
		})
		$.ajax({
			method:'post',
			url:'http://localhost/geradorXml/App/public/api/emissor/add',
			dataType: 'json',
			data:{CNPJ:CNPJ, xFant:fantasia, xNome:social, xLgr:endereco, nro:numero,
				xBairro:bairro, fone:fone, CEP:CEP, xMun:cidade, UF:UF, xPais:pais, cPais:cPais, cMun:cMun,
				CNAE:CNAE, CRT:CRT, IM:IM, IE:IE}
		}).done(function(data){
			if(data == '{"Aviso": {"text": "Emissor Adicionado"}') 
			{
				alert('Emissor Adicionado com Sucesso!!');
				window.location.replace("http://localhost/geradorXml/App/View/Emissor/fetch.php");                
			}
		});
	});
    //Botao fechar modalNFC-e, redirecionar para vendas.php
    $(".modalApi_fechar").on('click',function() {
        location = location;
    }); 
});