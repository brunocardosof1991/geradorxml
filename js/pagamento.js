$(document).ready(function () {
    function SaveDataToLocalStorage(data)
    {
        var a = JSON.parse(localStorage.getItem("session") || "[]");
        // Push the new data (whether it be an object or anything else) onto the array
        a.push(data);
        // Re-serialize the array back into a string and store it in localStorage
        localStorage.setItem('session', JSON.stringify(a));
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
        $("#modalVisualizarPagamentos .modal-footer").append('<i class="fas fa-trash fa-2x" id="excluirPagamento" style="cursor:pointer;color:red" title="Excluir Formas de Pagamento"></i>').show();

        let a = JSON.parse(localStorage.getItem('session'));
        console.log(a);

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
        $(".modal").on('hidden.bs.modal', function () {
            $('#tablePagamentos').detach();
            $('#excluirPagamento').detach();
        });
        $(document).on('click','#excluirPagamento',function(){     
            console.log(a[0]);
            let pagamento = $(this).closest('tr').children('td:eq(0)').text();   
            let $confirm = confirm("Tem certeza que deseja excluir as formas de pagamento?");
            if($confirm)         
            {

                $(this).closest('tr').detach();
                localStorage.removeItem('session');
            }
        });
    });
    //Multiplas formas de pagamento   
    //No dinheiro com desconto
    $(document).on('click','#btnDinheiro',function(e){
        e.preventDefault();
        if(localStorage.getItem("session") === null)
        {
                $('#formCartao').hide();
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
        } else {
            alert('Forma de Pagamento no Dinheiro já cadastrada')
        }
        });
    $(document).on('click','#btnCredito',function(e){
        e.preventDefault();
        $('#formDinheiro').hide();
        $("#modalCredito").draggable({ handle: ".modal-header" });      
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
        $("#modalCredito .modal-body").append($('#formCartao').show());
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
        });
    });
    $(document).on('click','#btnDebito',function(e){
        $('#rowDinheiro').hide();
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
    });   
});