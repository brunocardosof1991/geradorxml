$(document).ready(function () {
    console.log(localStorage);    
    function SaveDataToLocalStorage(data)
    {
        var a = JSON.parse(localStorage.getItem("session") || "[]");
        // Push the new data (whether it be an object or anything else) onto the array
        a.push(data);
        // Re-serialize the array back into a string and store it in localStorage
        localStorage.setItem('session', JSON.stringify(a));
    }
    function btnDinheiro()
    {
        $('#divCartao').hide();
        $("#apiModal").draggable({ handle: ".modal-header" });   
        $('#pagamento option[value="02"]').hide();
        $('#pagamento option[value="03"]').hide();
        $('#pagamento option[value="04"]').hide();
        $('#pagamento option[value="05"]').hide();
        $('#pagamento option[value="10"]').hide();
        $('#pagamento option[value="11"]').hide();
        $('#pagamento option[value="12"]').hide();
        $('#pagamento option[value="13"]').hide();
        $('#pagamento option[value="99"]').hide();
        $('#pagamento option[value="01"]').show();
        $("#apiModal .modal-body .chart").remove(); 
        $("#apiModal .modal-body p").remove(); 
        $("h1").remove(); 
        $("#apiModal .modal-title").text('Pagamento em Dinheiro');
        //Resetar Modal
        $('#apiModal').on('shown.bs.modal', function (e) {
            $(this)
              .find("input,textarea,select")
                 .val('')
                 .end()
              .find("input[type=checkbox], input[type=radio]")
                 .prop("checked", "")
                 .end();
        });    
        $("#apiModal").modal('show');
        $("#apiModal .modal-body").append($('#divDinheiro').show());
        $("#apiModal .modal-footer .action").text('Cadastrar Pagamento').show();
        if(!$( "#checkboxDesconto" ).is( ":checked" ))
        {$('#divinputDesconto').hide();}
        $("#apiModal .modal-footer .action").on('click', function (e){
            let dinheiro = $('#inputDinheiro').val();
            let desconto = $('#inputDesconto').val();
            let troco = $('#inputTroco').val();
            if($( "#checkboxDesconto" ).is( ":checked" )) {
                let json = {'formaPagamento': 'dinheiro', 'dinheiro': dinheiro,'troco': troco,'desconto':desconto};
                SaveDataToLocalStorage(json);
                calcDesconto();
                calcTroco();
                alert('Forma de Pagamento Adicionada');
                $("#apiModal").modal('hide'); 
            } else {
                let json = {'formaPagamento': 'dinheiro', 'dinheiro': dinheiro,'troco': troco};
                SaveDataToLocalStorage(json);
                calcTroco();
                alert('Forma de Pagamento Adicionada');
                $("#apiModal").modal('hide'); 
            }
        });
    }
    function btnDebito ()
    {        
        $("#modalDebito").draggable({ handle: ".modal-header" });  
        $('#divDinheiro').hide();
        $('#pagamento option[value="01"]').hide();
        $('#pagamento option[value="02"]').hide();
        $('#pagamento option[value="03"]').hide();
        $('#pagamento option[value="05"]').hide();
        $('#pagamento option[value="10"]').hide();
        $('#pagamento option[value="11"]').hide();
        $('#pagamento option[value="12"]').hide();
        $('#pagamento option[value="13"]').hide();
        $('#pagamento option[value="99"]').hide();
        $('#pagamento option[value="04"]').show();
        $("#modalDebito .modal-body").append($('#divCartao').show());
        //Resetar Modal
        $('#modalDebito').on('shown.bs.modal', function (e) {
            $(this)
              .find("input,textarea,select")
                 .val('')
                 .end()
              .find("input[type=checkbox], input[type=radio]")
                 .prop("checked", "")
                 .end();
        });   
        $("#modalDebito").modal('show');
        $("#modalDebito .modal-footer .action").text('Cadastrar Pagamento').show(); 
        $("#modalVisualizarPagamentos").on('shown.bs.modal', function () {
            $('#pagamento').show();
        });    
        $("#modalDebito .modal-footer .action").on('click',function(e){
            e.preventDefault();
            let payment = $('#pagamento').val();
            let bandeira = $('#bandeira').val();
            let credCartao = $('#credenciadora').val();
            let intPag = $('#intPagamento').val();        
            let codigo = $('#inputCS').val(); 
            let dinheiro = $('#inputDinheiro').val(); 
            var json = {'formaPagamento': 'debito','dinheiro':dinheiro,'payment': payment, 'bandeira': bandeira,'credCartao': credCartao,'intPag':intPag,'codigo':codigo}; 
            SaveDataToLocalStorage(json);
            alert('Forma de Pagamento Adicionada');
            $("#modalDebito").modal('hide'); 
        });
    }
    function btnCredito ()
    {        
        $("#modalCredito").draggable({ handle: ".modal-header" });  
        $('#formDinheiro').hide();    
        $('#pagamento option[value="01"]').hide();
        $('#pagamento option[value="02"]').hide();
        $('#pagamento option[value="04"]').hide();
        $('#pagamento option[value="05"]').hide();
        $('#pagamento option[value="10"]').hide();
        $('#pagamento option[value="11"]').hide();
        $('#pagamento option[value="12"]').hide();
        $('#pagamento option[value="13"]').hide();
        $('#pagamento option[value="99"]').hide();
        $('#pagamento option[value="03"]').show();
        $("#modalCredito .modal-body").append($('#divCartao').show());
        $("#modalCredito").modal('show');
        //Resetar Modal
        $('#modalCredito').on('shown.bs.modal', function (e) {
            e.preventDefault();
            $(this)
              .find("input,textarea,select")
                 .val('')
                 .end()
              .find("input[type=checkbox], input[type=radio]")
                 .prop("checked", "")
                 .end();
        });
        $("#modalCredito .modal-footer .action").text('Cadastrar Pagamento').show();     
        $("#modalCredito .modal-footer .action").on('click',function(e){
            e.preventDefault();
            let payment = $('#pagamento').val();
            let bandeira = $('#bandeira').val();
            let credCartao = $('#credenciadora').val();
            let intPag = $('#intPagamento').val();        
            let codigo = $('#inputCS').val(); 
            let dinheiro = $('#inputDinheiro').val(); 
            var json = {'formaPagamento': 'credito','dinheiro':dinheiro,'payment': payment, 'bandeira': bandeira,'credCartao': credCartao,'intPag':intPag,'codigo':codigo}; 
            SaveDataToLocalStorage(json);
            alert('Forma de Pagamento Adicionada');
            $("#modalCredito").modal('hide'); 
        });
    }
    function btnAlimentacao()
    {        
        $("#modalAlimentacao").draggable({ handle: ".modal-header" });  
        $('#divCartao').hide();    
        $('#pagamento option[value="01"]').hide();
        $('#pagamento option[value="02"]').hide();
        $('#pagamento option[value="03"]').hide();
        $('#pagamento option[value="04"]').hide();
        $('#pagamento option[value="05"]').hide();
        $('#pagamento option[value="11"]').hide();
        $('#pagamento option[value="12"]').hide();
        $('#pagamento option[value="13"]').hide();
        $('#pagamento option[value="99"]').hide();
        $('#pagamento option[value="10"]').show();
        $("#modalAlimentacao .modal-body").append($('#divCartao').show());
        $("#modalAlimentacao").modal('show');
        //Resetar Modal
        $('#modalAlimentacao').on('shown.bs.modal', function (e) {
            e.preventDefault();
            $(this)
              .find("input,textarea,select")
                 .val('')
                 .end()
              .find("input[type=checkbox], input[type=radio]")
                 .prop("checked", "")
                 .end();
        });
        $("#modalAlimentacao .modal-footer .action").text('Cadastrar Pagamento').show();     
        $("#modalAlimentacao .modal-footer .action").on('click',function(e){
            e.preventDefault();
            let payment = $('#pagamento').val();
            let bandeira = $('#bandeira').val();
            let credCartao = $('#credenciadora').val();
            let intPag = $('#intPagamento').val();        
            let codigo = $('#inputCS').val(); 
            let dinheiro = $('#inputDinheiro').val(); 
            var json = {'formaPagamento': 'alimentacao','dinheiro':dinheiro,'payment': payment, 'bandeira': bandeira,'credCartao': credCartao,'intPag':intPag,'codigo':codigo}; 
            SaveDataToLocalStorage(json);
            alert('Forma de Pagamento Adicionada');
            $("#modalCredito").modal('hide'); 
        });
    }
    function calcDesconto()
    {   
        if($("#inputDesconto").val() === '')
        {alert('Digite o Desconto!');}
        else if($("#inputDesconto").val() !== '')
        {
            $('#spanValorTotalDesconto').text('');
            let valorTotal = $("#spanValorTotal").text();
            let desconto = $("#inputDesconto").val();
            let total =
            (valorTotal = valorTotal.replace(/,/g, '.')) - (desconto = desconto.replace(/,/g, '.'));
            $('#spanValorTotalDesconto').append((total));
            $('#divValorTotalDesconto').fadeIn(1000).css('font-weight','bold');
            return total;
        }
    }
    function calcTroco()
    {
        if($("#inputDesconto").val() === '')
        {
            let valorTotal = $("#spanValorTotal").text();
            let dinheiro = $("#inputDinheiro").val();
            let troco = 
            (dinheiro = dinheiro.replace(/,/g, '.')) - (valorTotal = valorTotal.replace(/,/g, '.'));
            troco = parseFloat((troco).toFixed(2));
            $('#spanTroco').append(troco);
            $('#divTroco').fadeIn(1000).css('font-weight','bold');
            if(troco < 0)
            {
                $('#divTroco').hide();
                $('#spanRestante').append(troco * -1);
                $('#divValorRestante').fadeIn(1000).css('font-weight','bold');
                alert('Valor pago não completou o valor total da NFC-e!!');
            } else if(troco > 0)
            {
            $('#spanTroco').append(troco);
            $('#divTroco').fadeIn(1000).css('font-weight','bold');
            } else if(troco === 0) 
            {
                alert('Valor total da NFC-e paga!');
            }
        }
        else if($("#inputDesconto").val() !== '')
        {
            let valorTotal = $("#spanValorTotalDesconto").text();
            let dinheiro = $("#inputDinheiro").val();
            let troco = 
            (dinheiro = dinheiro.replace(/,/g, '.')) - (valorTotal = valorTotal.replace(/,/g, '.'));
            troco = parseFloat((troco).toFixed(2));
            $('#spanTroco').append(troco);
            if(troco < 0)
            {
                $('#spanRestante').append(troco * -1);
                $('#divValorRestante').fadeIn(1000).css('font-weight','bold');
                alert('Valor pago não completou o valor total da NFC-e!!');
            } else if(troco > 0)
            {
            $('#spanTroco').append(troco);
            $('#divTroco').fadeIn(1000).css('font-weight','bold');
            } else if(troco === 0) 
            {
                alert('Valor total da NFC-e paga!');
            }
        } 
    }
    $(document).on('click','#cleanLS',function(){
        localStorage.clear();
        alert('localStorage Cleaned');
        location.reload()
    });
    $(document).on('click','#visualizarFormaPagamento',function(e){
        e.preventDefault();
        $("#modalVisualizarPagamentos").draggable({ handle: ".modal-header" });   
        $("#modalVisualizarPagamentos").draggable({ handle: ".modal-footer" });   
        let table = 
        `        
        <table class="table table-hover table-bordered mt-3 mx-auto text-center" id="tablePagamentos">
            <thead class="thead-dark">
                <tr>
                    <th>Forma de Pagamento</th>
                    <th>Valor Pago</th>
            </thead>
            <tbody><tr></tr></tbody>
        </table>
        `;  
        $("#modalVisualizarPagamentos .modal-title").text('Visualizar Formas de Pagamento');
        $("#modalVisualizarPagamentos").modal('show');
        $("#modalVisualizarPagamentos .modal-body").append(table).show();

        let a = JSON.parse(localStorage.getItem('session'));
        $.each(a,function(i,v){         
            var tr = 
                $('<tr>')
                .append(
                $('<td>').text(v.formaPagamento),
                $('<td>').text(v.dinheiro))
                .appendTo('#tablePagamentos').html();
        }); 
        /* Sem esse código, no segundo click em #visualizarFormaPagamento (Sem refresh da pagina), a tabela será multiplicada, 
        aparecendo duas no modal */
        $("#modalVisualizarPagamentos").on('hidden.bs.modal', function () {
            $('#tablePagamentos').detach();
            $('#excluirPagamento').detach();
        });
        $(document).on('click','#resetarLS',function()
        {  
            localStorage.clear();
            alert('localStorage Cleaned')
        });
    });
    //Multiplas formas de pagamento
    // Card Dinheiro
    $(document).on('click','#btnDinheiro',function(e){
        e.preventDefault();
        let b;      
        if(localStorage.length !== 0)
        {b = JSON.parse(localStorage.getItem('session'));}
        if(localStorage.getItem("session") === null)
        {
            btnDinheiro();
        } else if(b[0].formaPagamento === 'dinheiro'){
            alert('Forma de Pagamento no Dinheiro Já Cadastrada')
        } else if(b[0].formaPagamento !== 'dinheiro'){
            alert('Forma de Pagamento no Dinheiro Deve ser Cadastrada Primeira')
        }
        });
    // Card Cartão de Crédito
    $(document).on('click','#btnCredito',function(e){
        e.preventDefault();
        var creditoFilter;
        let b;
        if(localStorage.length !== 0)
        {      
            b = JSON.parse(localStorage.getItem('session'));      
            creditoFilter = b.filter(function (el) {
                return el.formaPagamento === 'credito';
            });
            
        }
        if(localStorage.length === 0)
        {
            let $confirm = confirm("Essa venda terá dinheiro em espécie OU Cartão de Débito?");
            if($confirm)         
            {
                alert('Então comece pela forma de pagamento em Dinheiro ou Débito!');
            } else{                
                btnCredito();
            }
        } else if(localStorage.length === 1 && b[0].formaPagamento === 'credito' )
        {
            alert('Forma de Pagamento no Cartão de Crédito Já Cadastrada');
        }else if(localStorage.length === 1 && creditoFilter.length === 1)
        {
            alert('Forma de Pagamento no Cartão de Crédito Já Cadastrada');
        }
        else if(localStorage.length === 1 && b[0].formaPagamento === 'dinheiro')
        {
            btnCredito();
        }else if(localStorage.length === 1 && b[0].formaPagamento === 'debito')
        {
            btnCredito();
        }
    });
    //Card Debito
    $(document).on('click','#btnDebito',function(e){
        e.preventDefault();
        var debitoFilter;
        let b;
        if(localStorage.length !== 0)
        {      
            b = JSON.parse(localStorage.getItem('session'));      
            debitoFilter = b.filter(function (el) {
                return el.formaPagamento === 'debito';
            });
            
        }
        if(localStorage.length === 0)
        {
            let $confirm = confirm("Essa venda terá dinheiro em espécie também?");
            if($confirm)         
            {
                alert('Então comece pela forma de pagamento em Dinheiro!');
            } else {
                btnDebito();
            }
        } else if(localStorage.length === 1 && b[0].formaPagamento === 'debito' )
        {
            alert('Forma de Pagamento no Cartão de Débito Já Cadastrada');
        }
        else if(localStorage.length === 1 && b[0].formaPagamento === 'dinheiro' && debitoFilter.length < 1)
        {
            btnDebito();
        }else if(localStorage.length === 1 && debitoFilter.length === 1)
        {
            alert('Forma de Pagamento no Cartão de Crédito Já Cadastrada');
        }
    });
    //Card Alimentação
    $(document).on('click','#btnAlimentacao',function(){
        e.preventDefault();
        var creditoFilter;
        let b;
        if(localStorage.length !== 0)
        {      
            b = JSON.parse(localStorage.getItem('session'));      
            creditoFilter = b.filter(function (el) {
                return el.formaPagamento === 'credito';
            });
            
        }
        if(localStorage.length === 0)
        {
            let $confirm = confirm("Essa venda terá dinheiro em espécie OU Cartão de Débito?");
            if($confirm)         
            {
                alert('Então comece pela forma de pagamento em Dinheiro ou Débito!');
            } else{                
                btnAlimentacao();
            }
        } else if(localStorage.length === 1 && b[0].formaPagamento === 'credito' )
        {
            alert('Forma de Pagamento no Vale Alimentação Já Cadastrada');
        }else if(localStorage.length === 1 && creditoFilter.length === 1)
        {
            alert('Forma de Pagamento no Vale Alimentação Já Cadastrada');
        }
        else if(localStorage.length === 1 && b[0].formaPagamento === 'dinheiro')
        {
            btnAlimentacao();
        }else if(localStorage.length === 1 && b[0].formaPagamento === 'debito')
        {
            btnAlimentacao();
        }else if(localStorage.length === 1 && b[0].formaPagamento === 'credito')
        {
            btnAlimentacao();
        }        
    });  
});