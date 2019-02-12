$(document).ready(function(){
    $("#inputcEANProduto").keypress(function(event){
    if (event.which == '10' || event.which == '13') {
        event.preventDefault();
    }
});            
    var table = $("#tableListarProdutos").DataTable({       
    language: {
        "url": "http://localhost/geradorXml/datatablePortugues.json"
    },
    pagingType: "full_numbers",
    responsive: true,
    ajax: {
        url: 'http://localhost/geradorXml/App/public/api/produto/',
        method: "get",
        dataSrc: ""
    },
    columns: 
    [
        { data: "id" },
        { data: "descricao" },
        { data: "ncm" },
        { data: "preco_custo" },
        { data: "CFOP" },
        { data: "cEAN" },
        { data: "Editar" },
        { data: "Excluir" }
    ],
    columnDefs: 
    [ 
        {
            targets: [-1],
            data: null,
            defaultContent: "<div style='text-align:center'><a class='btn btn-default'><i class='fas fa-user-edit fa-2x' id='editarProduto' style='cursor:pointer;color:orange' title='Editar'></i></a></div>"
        },
        {
            targets: [-2],
            data: null,
            defaultContent: "<div style='text-align:center'><a class='btn btn-default'><i class='fas fa-trash fa-2x' id='excluirProduto' style='cursor:pointer;color:red' title='Excluir'></i></a></div>"
        }
    ]
    });
    $(document).on('click', '#excluirProduto',function() {       
        var id = $(this).closest('tr').children('td:eq(0)').text();
        var produto = $(this).closest('tr').children('td:eq(1)').text();
        let $confirm = confirm("Tem certeza que deseja excluir o produto "+produto);
        if($confirm)         
        {    
            $.ajax({
                method:'delete',
                url: 'http://localhost/geradorXml/App/public/api/produto/delete/'+id
            }).done(function(data){
                if(data == '{"success": "Produto Deletado"}')
                {
                    alert('Produto '+produto+' Foi Deletedo Com Sucesso!!');   
                }   
                location = location;        
            });          
        }
    });
    $(document).on('click', '#editarProduto',function() {   
        var id = $(this).closest('tr').children('td:eq(0)').text();
        var descricaoTable = $(this).closest('tr').children('td:eq(1)').text();
        var NCMTable = $(this).closest('tr').children('td:eq(2)').text();
        var preco_custoTable = $(this).closest('tr').children('td:eq(3)').text();
        var CFOPTable = $(this).closest('tr').children('td:eq(4)').text();
        var cEANTable = $(this).closest('tr').children('td:eq(5)').text();
        $("#apiModal .modal-body .chart").remove(); 
        $("#apiModal .modal-body p").remove(); 
        $("h1").remove(); 
        $("#apiModal .modal-title").text('Editar Produto');
        $("#apiModal").modal('show');
        $("#apiModal .modal-body").append($('#formProduto').show());
        $("#apiModal .modal-footer .action").text('Editar').show(); 
        $('#inputDescricaoProduto').val(descricaoTable);
        $('#inputNCMProduto').val(NCMTable);
        $('#inputPrecoProduto').val(preco_custoTable);
        $('#inputCFOPProduto').val(CFOPTable);        
        $('#inputcEANProduto').val(cEANTable);        
        $("#apiModal .modal-footer .action").on('click',function(){
            let descricao = $('#inputDescricaoProduto').val();
            let NCM = $('#inputNCMProduto').val();
            let preco_custo = $('#inputPrecoProduto').val();
            let CFOP = $('#inputCFOPProduto').val();
            let cEAN = $('#inputcEANProduto').val();
            $.ajax({
                method:'put',
                url: 'http://localhost/geradorXml/App/public/api/produto/update/'+id,
                dataType: 'json',
                data:{id:id, descricao:descricao, NCM:NCM, preco_custo:preco_custo, CFOP:CFOP,cEAN:cEAN}
            }).done(function(data){
                if(data == '{"success": "Produto Atualizado"}')
                {
                    alert('Produto Atualizado');
                    location = location;             
                }
            });
        });
    });
    $(document).on('click','#addProduto',function(){
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
    $("#apiModal .modal-body").append($('#formProduto').show());
    $("#apiModal .modal-footer .action").text('Cadastrar').show();        
    $("#apiModal .modal-footer .action").on('click', function (event){
        let descricao = $('#inputDescricaoProduto').val();
        let NCM = $('#inputNCMProduto').val();
        let preco_custo = $('#inputPrecoProduto').val();
        let CFOP = $('#inputCFOPProduto').val();
        let cEAN = $('#inputcEANProduto').val();
        preco_custo = preco_custo.replace(/,/g, '.');
        validateCFOPField(CFOP, event);
        validatecEANField(cEAN, event);
        validateNCMField(NCM, event);
        validatepreco_custoField(preco_custo, event);
        validateDescricao(descricao, event);
        if(isValidCFOP(CFOP) !== false && isValidcEAN(cEAN) !== false && isValidcEAN(NCM) !== false && isValidpreco_custo(preco_custo) !== false && isValidDescricao(descricao) !== false)
        {
            $.ajax({
                method:'post',
                url: 'http://localhost/geradorXml/App/public/api/produto/add',
                dataType: 'json',
                data:{descricao:descricao, ncm:NCM, preco_custo:preco_custo, CFOP:CFOP,cEAN:cEAN}
            }).done(function(data){
                if(data == '{"success": "Produto Adicionado"}')
                {
                    alert('Produto Adicionado com Sucesso'); 
                    location = location;
                }
            });
        }
        });
    });    
    //Validar CFOP
    function isValidCFOP(CFOP) {
        return CFOP === '5101'   || CFOP === '5102'  || CFOP === '5103'  || CFOP === '5104'  || CFOP === '5115'  || CFOP === '5405'  || CFOP === '5656'  || CFOP === '5667'  || CFOP === '5933';
      }
    
      function validateCFOPField(CFOP, event) {
        if (!isValidCFOP(CFOP)) {
          $("#CFOP-feedback").text("CFOP Inválido").css('color','red');
          alert('CFOP Inválido!')
          event.stopImmediatePropagation();
        } else {
          $("#CFOP-feedback").text("");
        }
      }
    //Validar cEAN
    function isValidcEAN(cEAN) {
        return cEAN.length === 8;
      }
    
      function validatecEANField(cEAN, event) {
        if (!isValidcEAN(cEAN)) {
          $("#cEAN-feedback").text("cEAN Inválido").css('color','red');
          alert('cEAN Não Contêm 8 Dígitos!')
          event.stopImmediatePropagation();
        } else {
          $("#cEAN-feedback").text("");
        }
      }
    //Validar NCM
    function isValidNCM(NCM) {
        return NCM.length === 8;
      }
    
      function validateNCMField(NCM, event) {
        if (!isValidNCM(NCM)) {
          $("#NCM-feedback").text("NCM Inválido").css('color','red');
          alert('NCM Inválido!')
          event.stopImmediatePropagation();
        } else {
          $("#NCM-feedback").text("");
        }
      }    
      //Validar Preço  
    function isValidpreco_custo(preco_custo) {
        return preco_custo.length >= 1 && preco_custo.length <= 30;
      }
    
      function validatepreco_custoField(preco_custo, event) {
        if (!isValidpreco_custo(preco_custo)) {
          $("#preco_custo-feedback").text("Preço Inválido").css('color','red');
          alert('Preço Inválido!')
          event.stopImmediatePropagation();
        } else {
          $("#preco_custo-feedback").text("");
        }
      }   
    //Validar Descrição  
    function isValidDescricao(Descricao) {
        return Descricao.length >= 2 && Descricao.length <= 250;
      }
    
      function validateDescricao(Descricao, event) {
        if (!isValidDescricao(Descricao)) {
          $("#descricao-feedback").text("Descriçao Inválido").css('color','red');
          alert('Descriçao Inválido!')
          event.stopImmediatePropagation();
        } else {
          $("#descricao-feedback").text("");
        }
      }   
});