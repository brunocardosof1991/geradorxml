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
				if(data.length !== 0)
				{
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
				}
		});
		return ajax;
	}
	$(document).on('click','#addEmissor',function(e){
		if(emissor.length >= 1) 
		{
			alert('Só é permitido cadastradrar um emissor!!');
		} else {
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
			$("#apiModal .modal-footer .action").on('click', function (event){
				let CEP = $('#inputCEP').val();
				let endereco = $('#inputEndereco').val();
				let bairro = $('#inputBairro').val();
				let cidade = $('#inputCidade').val();
				let UF = $('#inputUF').val();
				let numero = $('#inputNumero').val();
				let fone = $('#inputTelefone').val();
				let CNPJ = $('#inputCNPJ').val();
				let fantasia = $('#inputFantasia').val();
				let social = $('#inputSocial').val();
				let pais = $('#inputPais').val();
				let cPais = $('#inputCPais').val();
				let cMun = $('#inputCMunicipio').val();
				let CNAE = $('#inputCNAE').val();
				let CRT = $('#inputCRT').val();
				let IM = $('#inputIM').val();
				let IE = $('#inputIE').val();
				fone = fone.replace(/[^0-9]/g, '');
		
				validateCEPField(CEP, event);
				validateEnderecoField(endereco, event);
				validateBairroField(bairro, event);
				validateMunicipioField(cidade, event);
				validateUFField(UF, event);
				validateNumeroField(numero, event);
				validateTelefoneField(fone, event);
				validateFantasiaField(fantasia, event);
				validateSocialField(social, event);
				validatePaisField(pais, event);
				validatecPaisField(cPais, event); 
				validatecMunField(cMun, event);
				validateCNAEField(CNAE, event);
				validateCRTField(CRT, event);
				validateIMField(IM, event);
				validateIEField(IE, event);
				if(isValidCEP(CEP) !== false && isValidEndereco(endereco) !== false && isValidNumero(numero) !== false && 
				isValidBairro(bairro) !== false && isValidMunicipio(cidade) !== false && 
				isValidUF(UF) !== false  && isValidTelefone(fone) !== false && isValidFantasia(fantasia) !== false && 
				isValidSocial(social) !== false && isValidPais(pais) !== false &&
				isValidcPais(cPais) !== false && isValidcMun(cMun) !== false && isValidCNAE(CNAE) !== false &&
				isValidCRT(CRT) !== false && isValidIM(IM) !== false && isValidIE(IE) !== false)
				{
					$.ajax({
						method:'post',
						url:'http://localhost/geradorXml/App/public/api/emissor/add',
						dataType: 'json',
						data:{CNPJ:CNPJ, xFant:fantasia, xNome:social, xLgr:endereco, nro:numero,
							xBairro:bairro, fone:fone, CEP:CEP, xMun:cidade, UF:UF, xPais:pais, cPais:cPais, cMun:cMun,
							CNAE:CNAE, CRT:CRT, IM:IM, IE:IE}
					}).done(function(data){
						console.log();
						if(data == '{"success": "Emissor Adicionado"}') 
						{
							alert('Emissor Adicionado com Sucesso!!');
							window.location.replace("http://localhost/geradorXml/App/View/Emissor/fetchEmit.php");                
						}
					});					
				} else {alert ('deu merda')}
			});
		}
	});	
	$(document).on('click','#editarEmissor',function(e){
		console.log(emissor);
		// Pegar todos os valores do emissor cadastrado
		let id = emissor[0].id;
		$('#inputCNPJ').val(emissor[0].CNPJ);
		$('#inputFantasia').val(emissor[0].xFant);
		$('#inputSocial').val(emissor[0].xNome);
		$('#inputEndereco').val(emissor[0].xLgr);
		$('#inputNumero').val(emissor[0].nro);
		$('#inputBairro').val(emissor[0].xBairro);
		$('#inputTelefone').val(emissor[0].fone);
		$('#inputCEP').val(emissor[0].CEP);
		$('#inputCidade').val(emissor[0].xMun);
		$('#inputCMunicipio').val(emissor[0].cMun);
		$('#inputUF').val(emissor[0].UF);
		$('#inputPais').val(emissor[0].xPais);
		$('#inputCPais').val(emissor[0].cPais);
		$('#inputCNAE').val(emissor[0].CNAE);
		$('#inputCRT').val(emissor[0].CRT);
		$('#inputIM').val(emissor[0].IM);
		$('#inputIE').val(emissor[0].IE);
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
		$("#apiModal .modal-footer .action").on('click', function (){
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
			foneup = foneup.replace(/[^0-9]/g, '');
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
	//Buscar Endereço, Bairro, Cidade e UF automaticamente pela API viacep
	$("#inputCEP").focusout(function(){
			let cep = $(this).val().replace(/\D/g, '');
			//Verifica se campo cep possui valor informado.
			if (cep != "") {
					//Expressão regular para validar o CEP.
					let validacep = /^[0-9]{8}$/;
					//Valida o formato do CEP.
					if(validacep.test(cep)) {
							//Preenche os campos com "..." enquanto consulta webservice.
							$("#inputEndereco").val("...");
							$("#inputBairro").val("...");
							$("#inputCidade").val("...");
							$("#inputUF").val("...");
							$.ajax({
									method:'get',
									dataType: 'json',
									url:"https://viacep.com.br/ws/"+ cep +"/json/?callback=?"
							}).done(function(data){
									//Atualiza os campos com os valores da consulta.
									$("#inputEndereco").val(data.logradouro);
									$("#inputBairro").val(data.bairro);
									$("#inputCidade").val(data.localidade);
									$("#inputUF").val(data.uf);
							}).fail(function(data){
									console.log(data);
							});
					}
			}
	});
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
        $("#cidade-feedback").text("Municipio Inválido").css('color','red');
        alert('Municipio Inválido!')
        event.preventDefault();
      } else {
        $("#cidade-feedback").text("");
      }
    }
    //Validar UF
    function isValidUF(UF) {
      //UF tamanho 2 letras
      return UF !== null;
    }
  
    function validateUFField(UF, event) {
      if (!isValidUF(UF)) {
        $("#	-feedback").text("UF Inválido").css('color','red');
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
    $('#inputTelefone').mask('(00) 0000-0009');
    $('#inputTelefone').blur(function(event) {
        if($(this).val().length == 14){ // Celular com 9 dígitos + 2 dígitos DDD e 4 da máscara
        $('#inputTelefone').mask('(00) 0000-0009');
        } else {
        $('#inputTelefone').mask('(00) 0000-0009');
        }
    });
    //Validar Telefone
    function isValidTelefone(Telefone) {
      //Tamanho máximo 10, será retirado caracteres especiais
      return Telefone.length > 2 && Telefone.length < 20;
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
   //Validar Nome Fantasia
    function isValidFantasia(Fantasia) {
      return Fantasia.length >  2 && 	Fantasia.length < 100;
    }
  
    function validateFantasiaField(Fantasia, event) {
      if (!isValidFantasia(Fantasia)) {
        $("#nome_fantasia-feedback").text("Nome Fantasia Inválido").css('color','red');
        alert('Nome Fantasia Inválido!');
        event.preventDefault();
      } else {
        $("#nome_fantasia-feedback").text("");
      }
    }
   //Validar Razão Social
    function isValidSocial(Social) {
      return Social.length >  2 && 	Social.length < 100;
    }
  
    function validateSocialField(Social, event) {
      if (!isValidSocial(Social)) {
        $("#razao_social-feedback").text("Razão Social Inválido").css('color','red');
        alert('Razão Social Inválido!');
        event.preventDefault();
      } else {
        $("#razao_social-feedback").text("");
      }
    }
   //Validar Pais
    function isValidPais(Pais) {
      return Pais.length >  2 && 	Pais.length < 100;
    }
  
    function validatePaisField(Pais, event) {
      if (!isValidPais(Pais)) {
        $("#pais-feedback").text("Pais Inválido").css('color','red');
        alert('Nome do Pais Inválido!');
        event.preventDefault();
      } else {
        $("#pais-feedback").text("");
      }
    }
   //Validar Código do Pais
    function isValidcPais(cPais) {
      return cPais !== null;
    }
  
    function validatecPaisField(cPais, event) {
      if (!isValidcPais(cPais)) {
        $("#cPais-feedback").text("Código do Pais Inválido").css('color','red');
        alert('Código do Páis Inválido!');
        event.preventDefault();
      } else {
        $("#cPais-feedback").text("");
      }
    }
   //Validar Código do Pais
    function isValidcMun(cMun) {
      return cMun.length === 7;
    }
  
    function validatecMunField(cMun, event) {
      if (!isValidcMun(cMun)) {
        $("#cMunicipio-feedback").text("Código do Município Inválido").css('color','red');
        alert('Código do Município Inválido!');
        event.preventDefault();
      } else {
        $("#cMunicipio-feedback").text("");
      }
    }
   //Validar CNAE
    function isValidCNAE(CNAE) {
      return CNAE.length === 7;
    }
  
    function validateCNAEField(CNAE, event) {
      if (!isValidCNAE(CNAE)) {
        $("#CNAE-feedback").text("CNAE Inválido").css('color','red');
        alert('CNAE Inválido!');
        event.preventDefault();
      } else {
        $("#CNAE-feedback").text("");
      }
    }
    //Validar CNPJ - Código encontrado na internet
    $('#inputCNPJ').focusout(function(event){
        let CNPJ = $(this).cpfcnpj({
        mask: false,
        validate: 'cpfcnpj',
        event: 'focusout',
        // validateOnlyFocus: true,
        handler: '#inputCNPJ',
        ifValid: function (input) { input.removeClass("error"); input.addClass("success");},
        ifInvalid: function (input){  input.removeClass("success"); input.addClass("error");}
    });
    });
		//Validar CNAE
		 function isValidCNAE(CNAE) {
			 return CNAE.length === 7;
		 }
	 
		 function validateCNAEField(CNAE, event) {
			 if (!isValidCNAE(CNAE)) {
				 $("#CNAE-feedback").text("CNAE Inválido").css('color','red');
				 alert('CNAE Inválido!');
				 event.preventDefault();
			 } else {
				 $("#CNAE-feedback").text("");
			 }
		 }
		//Validar CRT
		 function isValidCRT(CRT) {
			 return CRT !== null;
		 }
	 
		 function validateCRTField(CRT, event) {
			 if (!isValidCRT(CRT)) {
				 $("#CRT-feedback").text("CRT Inválido").css('color','red');
				 alert('CRT Inválido!');
				 event.preventDefault();
			 } else {
				 $("#CRT-feedback").text("");
			 }
		 }
		//Validar IM
		 function isValidIM(IM) {
			 return IM.length > 0 && IM.length < 50;
		 }
	 
		 function validateIMField(IM, event) {
			 if (!isValidIM(IM)) {
				 $("#IM-feedback").text("IM Inválido").css('color','red');
				 alert('IM Inválido!');
				 event.preventDefault();
			 } else {
				 $("#IM-feedback").text("");
			 }
		 }
		//Validar IM
		 function isValidIE(IE) {
			 return IE.length > 0 && IE.length < 50;
		 }
	 
		 function validateIEField(IE, event) {
			 if (!isValidIE(IE)) {
				 $("#IE-feedback").text("IE Inválido").css('color','red');
				 alert('IE Inválido!');
				 event.preventDefault();
			 } else {
				 $("#IE-feedback").text("");
			 }
		 }
});