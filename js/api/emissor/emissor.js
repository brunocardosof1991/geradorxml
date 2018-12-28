$(document).ready(function () {
	fetch_data();
	function fetch_data()
	{
		$.ajax({
		url:"http://localhost/erpsys/App/Api/Emissor/work/fetch.php",
		success:function(data)
		{
			$("#container").find('#cardVisualizarEmissor .card-body tbody').html(data);
		}
		});
	}
	$('#api_crud_form').on('submit', function(event){
		event.preventDefault();
		var form_data = $(this).serialize();
		$.ajax({
			url:"http://localhost/erpsys/App/Api/Emissor/work/action.php",
			method:"POST",
			data:form_data
		}).done((data) => {
			if(data === "insert")
			{
			 alert("Emissor Cadastrado com Sucesso");
			}
			if(data === "update")
			{
			 alert("Emissor Editado com Sucesso");
			}
			$("#api_crud_form").get(0).reset();
			$('#apicrudModal').modal('hide');
			fetch_data();
		});
	});
	$(document).on('click', '.add_button', function(){
		let pais = $("#inputxPaisEmissor").attr('placeholder');
		let cPais = $("#inputcPaisEmissor").attr('placeholder');
		$("#inputxPaisEmissor").val(pais);
		$("#inputcPaisEmissor").val(cPais);
		$('#action').val('insert');
		$('#button_action').show().val('Insert');
		$('#apicrudModal').modal('show');
	});	
	$(document).on('click', '.visualizar', function(){
		const id = $(this).attr('id');
		var action = 'fetch_single';
		$.ajax({
			url:"http://localhost/erpsys/App/Api/Emissor/work/action.php",
			method:"POST",
			data:{id:id, action:action},
			dataType:"json"
			}).done((data) => {
				let pais = $("#inputxPaisEmissor").attr('placeholder');
				let cPais = $("#inputcPaisEmissor").attr('placeholder');
				$('#hidden_id').val(id);
				$('#inputCNPJEmissor').val(data.cnpj).prop('readonly', true);
				$('#inputRazaoSocialEmissor').val(data.razaoSocial).prop('readonly', true);
				$('#inputNomeFantasiaEmissor').val(data.nomeFantasia).prop('readonly', true);
				$('#inputFoneEmissor').val(data.telefone).prop('readonly', true);
				$('#inputCNAEEmissor').val(data.CNAE).prop('readonly', true);
				$('#inputCEPEmissor').val(data.CEP).prop('readonly', true);
				$('#inputCRTEmissor').val(data.CRT).prop('readonly', true);
				$('#inputIMEmissor').val(data.IM).prop('readonly', true);
				$('#inputIEEmissor').val(data.IE).prop('readonly', true);
				$('#inputEnderecoEmissor').val(data.endereco).prop('readonly', true);
				$('#inputBairroEmissor').val(data.bairro).prop('readonly', true);
				$('#inputNumeroEmissor').val(data.numero).prop('readonly', true);
				$('#inputcMunEmissor').val(data.codigoMun).prop('readonly', true);
				$('#inputCidadeEmissor').val(data.cidade).prop('readonly', true);
				$('#inputUFEmissor').val(data.UF).prop('readonly', true);
				$("#inputxPaisEmissor").val(pais);
				$("#inputcPaisEmissor").val(cPais);
				$('#action').val('visualizar');
				$('#button_action').val('Visualizar').hide();
				$('#apicrudModal').modal('show');
				$('#apicrudModal').on('hidden.bs.modal', function (e) {
					$("#api_crud_form").get(0).reset();
					$("#apicrudModal .modal-body input").prop('readonly', false);

				  });
			});		
	});
	$(document).on('click', '.edit', function(){
		var id = $(this).attr('id');
		var action = 'fetch_single';
		$.ajax({
		url:"http://localhost/erpsys/App/Api/Emissor/work/action.php",
		method:"POST",
		data:{id:id, action:action},
		dataType:"json"
		}).done((data) => {
			let pais = $("#inputxPaisEmissor").attr('placeholder');
			let cPais = $("#inputcPaisEmissor").attr('placeholder');
			$('#hidden_id').val(id);
			$('#inputCNPJEmissor').val(data.cnpj).prop('readonly', false);
			$('#inputRazaoSocialEmissor').val(data.razaoSocial).prop('readonly', false);
			$('#inputNomeFantasiaEmissor').val(data.nomeFantasia).prop('readonly', false);
			$('#inputFoneEmissor').val(data.telefone).prop('readonly', false);
			$('#inputCNAEEmissor').val(data.CNAE).prop('readonly', false);
			$('#inputCEPEmissor').val(data.CEP).prop('readonly', false);
			$('#inputCRTEmissor').val(data.CRT).prop('readonly', false);
			$('#inputIMEmissor').val(data.IM).prop('readonly', false);
			$('#inputIEEmissor').val(data.IE).prop('readonly', false);
			$('#inputEnderecoEmissor').val(data.endereco).prop('readonly', false);
			$('#inputBairroEmissor').val(data.bairro).prop('readonly', false);
			$('#inputNumeroEmissor').val(data.numero).prop('readonly', false);
			$('#inputcMunEmissor').val(data.codigoMun).prop('readonly', false);
			$('#inputCidadeEmissor').val(data.cidade).prop('readonly', false);
			$('#inputUFEmissor').val(data.UF).prop('readonly', false);
			$("#inputxPaisEmissor").val(pais);
			$("#inputcPaisEmissor").val(cPais);
			$('#action').val('update');
			$('#button_action').val('Update').show();
			$('#apicrudModal').modal('show');
			$('#apicrudModal').on('hidden.bs.modal', function (e) {
				$("#api_crud_form").get(0).reset();
			  });
		});	 
	});

	$(document).on('click', '.delete', function(){
		var id = $(this).attr("id");
		var action = 'delete';
		if(confirm("Tem certeza que deseja deletar este Emissor?"))
		{
		 	$.ajax({
		  	url:"http://localhost/erpsys/App/Api/Emissor/work/action.php",
		  	method:"POST",
		  	data:{id:id, action:action},
		  	success:function(data)
		  	{
				fetch_data();
				alert("Emissor Deletado com Sucesso");
		  	}
		 });
		}
	   });
});