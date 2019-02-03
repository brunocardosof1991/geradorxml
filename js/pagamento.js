$(document).ready(function () {
    //Array com as formas de pagamento
    let ls = JSON.parse(localStorage.getItem('session'));

    $(document).on('click','#cleanLS',function(){
        localStorage.clear();
        alert('localStorage Cleaned');
        location.reload()
    });    
    //Limitar a venda em somente duas formas de pagamento
    //Descobrir como utilizar o array do localStorage para + de 2 formas de pagamento
    function limitarVenda()
    {
        /* let ls; */
        if(localStorage.length > 0) 
        {
            ls = JSON.parse(localStorage.getItem('session'));
            if((ls[0]) && (ls[1]))
            {
                alert("O Sistema só Permite Duas Formas de Pagamento");
                throw'O Sistema só Permite Duas Formas de Pagamento';
            }
        } 
    }
    //Input desconto somente na primeira forma de pagamento
    //Validar se o usuário realmente digitou o desconto
    function validarInputDesconto()
    {
        if(localStorage.length === 0)   
        {
            if($( "#checkboxDesconto" ).is( ":checked" )) 
            {
                $("#divinputDescontoC").css('display','block');
                // Validar Campo desconto no focusout
                $("#divinputDescontoC").focusout(function(event){
                    event.stopImmediatePropagation();
                    if($("#inputDescontoC").val() === '')
                    {alert('Favor Digite o Desconto!');}
                });
            }  
            else{$("#divinputDescontoC").css('display','none');}   
        } else if(localStorage.length === 1)
        {
            if($( "#checkboxDesconto" ).is( ":checked" )) 
            {$("#divinputDescontoC").css('display','none');}  

        }
    }
    function cadastrarPagamento(payment,formaPagamento)
    {     
            let dinheiro = $('#inputDinheiroC').val(); 
            dinheiro = dinheiro.replace(/,/g, '.');
            let desconto = $('#inputDescontoC').val();
            //Se o input desconto não estiver vazio, significa que o checkbox desconto foi marcado
            if($('#inputDescontoC').val() !== '') {
                var json = {'formaPagamento': formaPagamento,'dinheiro':dinheiro,'payment': payment,'desconto':desconto};
                calcDesconto();
                calcTroco(dinheiro); 
                SaveDataToLocalStorage(json);
                alert('Forma de Pagamento Adicionada');
                $(".modal").modal('hide'); 
                $("#visualizarFormaPagamento").animate({
                    color: '#FF0000'
                },1000);
            } else if($('#inputDescontoC').val() === '') {
                var json = {'formaPagamento': formaPagamento,'dinheiro':dinheiro,'payment': payment};
                calcTroco(dinheiro); 
                SaveDataToLocalStorage(json);
                alert('Forma de Pagamento Adicionada');
                $(".modal").modal('hide'); 
                $("#visualizarFormaPagamento").animate({
                    color: '#FF0000'
                },1000);
            }
    }
    function cadastrarPagamentoTEF(paymentTEF,formaPagamentoTEF)
    {                 
        let bandeira = $('#bandeira').val();
        let credCartao = $('#credenciadora').val();
        let intPag = $('#intPagamento').val();        
        let codigo = $('#inputCS').val(); 
        let dinheiro = $('#inputDinheiroC').val(); 
        dinheiro = dinheiro.replace(/,/g, '.');
        let desconto = $('#inputDescontoC').val();
        if($('#inputDescontoC').val() !== '') {
            var json = {'formaPagamento': formaPagamentoTEF,'dinheiro':dinheiro,'payment': paymentTEF, 'bandeira': bandeira,'credCartao': credCartao,'intPag':intPag,'codigo':codigo,'desconto':desconto};
            calcDesconto();
            calcTroco(dinheiro); 
            SaveDataToLocalStorage(json);
            alert('Forma de Pagamento Adicionada');
            $(".modal").modal('hide');
            $("#visualizarFormaPagamento").animate({
                color: '#FF0000'
            },1000);
        } else if($('#inputDescontoC').val() === ''){
            var json = {'formaPagamento': formaPagamentoTEF,'dinheiro':dinheiro,'payment': paymentTEF, 'bandeira': bandeira,'credCartao': credCartao,'intPag':intPag,'codigo':codigo};
            calcTroco(dinheiro); 
            SaveDataToLocalStorage(json);
            alert('Forma de Pagamento Adicionada');
            $(".modal").modal('hide'); 
            $("#visualizarFormaPagamento").animate({
                color: '#FF0000'
            },1000);
        }
    }
    //Salvar as formas de pagamento no localStorage
    function SaveDataToLocalStorage(data)
    {
        var ls = JSON.parse(localStorage.getItem("session") || "[]");
        // Push the new data (whether it be an object or anything else) onto the array
        ls.push(data);
        // Re-serialize the array back into a string and store it in localStorage
        localStorage.setItem('session', JSON.stringify(ls));
    }
    function btnDinheiro ()
    {  
        let formaPagamento = 'dinheiro';
        //Necessário para o preenchimento do XML
        let payment = '01';
        limitarVenda();
        validarInputDesconto();
        //Botao Visualizar Formas de Pagamento: Retornar a cor preta
        $("#visualizarFormaPagamento").css({'color':'black'});
        //jQuery UI - Movere o modal pelo body
        $("#modalDinheiro").draggable({ handle: ".modal-body" });
        //Esconder inputs das formas no cartão
        $('#parcela').hide();
        $('#valorParcelas').hide();
        $('#divBandeira').hide();
        $('#divCredenciadora').hide();
        $('#divintPag').hide();
        $('#divAutorizacaoCartao').hide();
        //Iniciar o modal com select pagamento dinheiro
        $('#pagamento').val('01');
        //Esconder o restante dos options 
        $('#pagamento option[value="02"]').hide();
        $('#pagamento option[value="03"]').hide();
        $('#pagamento option[value="04"]').hide();
        $('#pagamento option[value="05"]').hide();
        $('#pagamento option[value="10"]').hide();
        $('#pagamento option[value="11"]').hide();
        $('#pagamento option[value="12"]').hide();
        $('#pagamento option[value="13"]').hide();
        $('#pagamento option[value="99"]').hide();
        //Adicionar ao body do modal o formPagamentoDinheiro
        $("#modalDinheiro .modal-body").append($('#divPagamento').show());
        /* Caso dinheiro seje escolhido como segunda forma de pagamento, adicionar automaticamente
        ao input dinheiro, o valor restante*/
        if($("#spanRestante").text() !== '')
        {
            $('#inputDinheiroC').val($("#spanRestante").text());
        }   
        $("#modalDinheiro").modal('show');
        //Resetar Modal
        if(localStorage.length === 0)
        {
            $('#modalDinheiro').on('shown.bs.modal', function (e) {
                $(this)
                  .find("input,textarea,select")
                  .not("#pagamento")
                  //Talvez não precise dessa linha abaixo
                  .not("#inputDescontoC")
                     .val('')
                     .end()
                  .find("input[type=checkbox], input[type=radio]")
                     .prop("checked", "")
                     .end();
            }); 
        } else if(localStorage.length > 0)
        {
            $('#modalDinheiro').on('shown.bs.modal', function (e) {
                $(this)
                  .find("input,textarea,select")
                     .not("#pagamento")
                     .not("#inputDinheiroC")
                     .val('')
                     .end()
                  .find("input[type=checkbox], input[type=radio]")
                     .prop("checked", "")
                     .end();
            });             
        }
        $("#modalDinheiro .modal-footer .action").one('click',function(event){
            event.stopImmediatePropagation();
            cadastrarPagamento(payment,formaPagamento);
        });
    }
    function btnCheque ()
    { 
        let formaPagamento = 'cheque';
        //Necessário para o preenchimento do XML 
        let payment = '02';
        limitarVenda();
        validarInputDesconto();
        //Botao Visualizar Formas de Pagamento: Retornar a cor preta
        $("#visualizarFormaPagamento").css({'color':'black'});
        //jQuery UI - Movere o modal pelo body
        $("#modalCheque").draggable({ handle: ".modal-body" });
        //Esconder inputs das formas no cartão
        $('#parcela').hide();
        $('#valorParcelas').hide();
        $('#divBandeira').hide();
        $('#divCredenciadora').hide();
        $('#divintPag').hide();
        $('#divAutorizacaoCartao').hide();
        //Iniciar o modal com select pagamento dinheiro
        $('#pagamento').val('02');
        //Esconder o restante dos options 
        $('#pagamento option[value="01"]').hide();
        $('#pagamento option[value="03"]').hide();
        $('#pagamento option[value="04"]').hide();
        $('#pagamento option[value="05"]').hide();
        $('#pagamento option[value="10"]').hide();
        $('#pagamento option[value="11"]').hide();
        $('#pagamento option[value="12"]').hide();
        $('#pagamento option[value="13"]').hide();
        $('#pagamento option[value="99"]').hide();
        //Adicionar ao body do modal o formPagamentoDinheiro
        $("#modalCheque .modal-body").append($('#divPagamento').show());
        /* Caso dinheiro seje escolhido como segunda forma de pagamento, adicionar automaticamente
        ao input dinheiro, o valor restante*/
        if($("#spanRestante").text() !== '')
        {
            $('#inputDinheiroC').val($("#spanRestante").text());
        }   
        $("#modalCheque").modal('show');
        //Resetar Modal
        if(localStorage.length === 0)
        {
            $('#modalCheque').on('shown.bs.modal', function (e) {
                $(this)
                  .find("input,textarea,select")
                  .not("#pagamento")
                  //Talvez não precise dessa linha abaixo
                  .not("#inputDescontoC")
                     .val('')
                     .end()
                  .find("input[type=checkbox], input[type=radio]")
                     .prop("checked", "")
                     .end();
            }); 
        } else if(localStorage.length > 0)
        {
            $('#modalCheque').on('shown.bs.modal', function (e) {
                $(this)
                  .find("input,textarea,select")
                     .not("#pagamento")
                     .not("#inputDinheiroC")
                     .val('')
                     .end()
                  .find("input[type=checkbox], input[type=radio]")
                     .prop("checked", "")
                     .end();
            });             
        }
        $("#modalCheque .modal-footer .action").one('click',function(event){
            event.stopImmediatePropagation();
            cadastrarPagamento(payment,formaPagamento)
        });
    }
    function btnDebito ()
    {
        let formaPagamentoTEF = 'debito';
        //Necessário para o preenchimento do XML 
        let paymentTEF = '04';
        limitarVenda(); 
        validarInputDesconto();
        //Botao Visualizar Formas de Pagamento: Retornar a cor preta
        $("#visualizarFormaPagamento").css({'color':'black'});
        $("#modalDebito").draggable({ handle: ".modal-body" });  
        $('#parcela').hide();
        $('#valorParcelas').hide();
        $('#divBandeira').show();
        $('#divCredenciadora').show();
        $('#divintPag').show();
        $('#divAutorizacaoCartao').show();
        $('#pagamento').val('04'); 
        $('#pagamento option[value="01"]').hide();
        $('#pagamento option[value="02"]').hide();
        $('#pagamento option[value="03"]').hide();
        $('#pagamento option[value="04"]').show();
        $('#pagamento option[value="05"]').hide();
        $('#pagamento option[value="10"]').hide();
        $('#pagamento option[value="11"]').hide();
        $('#pagamento option[value="12"]').hide();
        $('#pagamento option[value="13"]').hide();
        $('#pagamento option[value="99"]').hide();
        $("#modalDebito .modal-body").append($('#divPagamento').show());
        if($("#spanRestante").text() !== '')
        {
            $('#inputDinheiroC').val($("#spanRestante").text());
        }   
        $("#modalDebito").modal('show');
        //Resetar Modal
        if(localStorage.length === 0)
        {
            $('#modalDebito').on('shown.bs.modal', function (e) {
                $(this)
                  .find("input,textarea,select")
                     .not("#pagamento")
                     .not("#inputDescontoC")
                     .val('')
                     .end()
                  .find("input[type=checkbox], input[type=radio]")
                     .prop("checked", "")
                     .end();
            }); 
        } else if(localStorage.length > 0)
        {
            $('#modalDebito').on('shown.bs.modal', function (e) {
                $(this)
                  .find("input,textarea,select")
                     .not('#inputDinheiroC')
                     .not('#pagamento')
                     .val('')
                     .end()
                  .find("input[type=checkbox], input[type=radio]")
                     .prop("checked", "")
                     .end();
            });             
        }
        $("#modalDebito .modal-footer .action").one('click',function(event){
            event.stopImmediatePropagation();
            cadastrarPagamentoTEF(paymentTEF,formaPagamentoTEF);
        });
    }
    function btnCredito ()
    { 
        let formaPagamentoTEF = 'credito';
        //Necessário para o preenchimento do XML 
        let paymentTEF = '03';
        limitarVenda();
        validarInputDesconto();
        //Botao Visualizar Formas de Pagamento: Retornar a cor preta
        $("#visualizarFormaPagamento").css({'color':'black'});  
        $("#modalCredito").draggable({ handle: ".modal-body" });       
        $('#parcela').show();
        $('#valorParcelas').show();
        $('#divBandeira').show();
        $('#divCredenciadora').show();
        $('#divintPag').show();
        $('#divAutorizacaoCartao').show();
        $('#pagamento').val('03'); 
        //$('#pagamento option[value="03"]').show();
        $('#pagamento option[value="01"]').hide();
        $('#pagamento option[value="02"]').hide();
        $('#pagamento option[value="04"]').hide();
        $('#pagamento option[value="05"]').hide();
        $('#pagamento option[value="10"]').hide();
        $('#pagamento option[value="11"]').hide();
        $('#pagamento option[value="12"]').hide();
        $('#pagamento option[value="13"]').hide();
        $('#pagamento option[value="99"]').hide();
        $("#modalCredito .modal-body").append($('#divPagamento').show());
        if($("#spanRestante").text() !== '')
        {
            $('#inputDinheiroC').val($("#spanRestante").text());
        }   
        $("#modalCredito").modal('show');
        //Resetar Modal
        if(localStorage.length === 0)
        {
            $('#modalCredito').on('shown.bs.modal', function (e) {
                $(this)
                  .find("input,textarea,select")
                     .not("#pagamento")
                     .not("#inputDescontoC")
                     .val('')
                     .end()
                  .find("input[type=checkbox], input[type=radio]")
                     .prop("checked", "")
                     .end();
            }); 
        } else if(localStorage.length > 0)
        {
            $('#modalCredito').on('shown.bs.modal', function (e) {
                $(this)
                  .find("input,textarea,select")
                     .not('#inputDinheiroC')
                     .not('#pagamento')
                     .val('')
                     .end()
                  .find("input[type=checkbox], input[type=radio]")
                     .prop("checked", "")
                     .end();
            });             
        }
        $("#selectParcela").on('change',function(){            
            let dinheiro = $('#inputDinheiroC').val();
            dinheiro = dinheiro.replace(/,/g, '.');
            let valorParcelas = dinheiro / (this.value);
            valorParcelas = parseFloat((valorParcelas).toFixed(2));
            $("#inputValorParcelas").val(valorParcelas);
        });
        $("#modalCredito .modal-footer .action").one('click',function(event){
            event.stopImmediatePropagation();
            cadastrarPagamentoTEF(paymentTEF,formaPagamentoTEF);
        });
    }
    function btnAlimentacao ()
    { 
        let formaPagamentoTEF = 'alimentacao';
        //Necessário para o preenchimento do XML 
        let paymentTEF = '10';
        limitarVenda();
        validarInputDesconto();    
        //Botao Visualizar Formas de Pagamento: Retornar a cor preta
        $("#visualizarFormaPagamento").css({'color':'black'});   
        $("#modalAlimentacao").draggable({ handle: ".modal-body" });
        $('#parcela').hide();
        $('#valorParcelas').hide();
        $('#divBandeira').show();
        $('#divCredenciadora').show();
        $('#divintPag').show();
        $('#divAutorizacaoCartao').show();
        $('#pagamento').val('10'); 
        $('#pagamento option[value="01"]').hide();
        $('#pagamento option[value="02"]').hide();
        $('#pagamento option[value="03"]').hide();
        $('#pagamento option[value="04"]').hide();
        $('#pagamento option[value="05"]').hide();
        $('#pagamento option[value="11"]').hide();
        $('#pagamento option[value="12"]').hide();
        $('#pagamento option[value="13"]').hide();
        $('#pagamento option[value="99"]').hide();
        $("#modalAlimentacao .modal-body").append($('#divPagamento').show());
        if($("#spanRestante").text() !== '')
        {
            $('#inputDinheiroC').val($("#spanRestante").text());
        }   
        $("#modalAlimentacao").modal('show');
        //Resetar Modal
        if(localStorage.length === 0)
        {
            $('#modalAlimentacao').on('shown.bs.modal', function (e) {
                $(this)
                  .find("input,textarea,select")
                     .not("#pagamento")
                     .not("#inputDescontoC")
                     .val('')
                     .end()
                  .find("input[type=checkbox], input[type=radio]")
                     .prop("checked", "")
                     .end();
            }); 
        } else if(localStorage.length > 0)
        {
            $('#modalAlimentacao').on('shown.bs.modal', function (e) {
                $(this)
                  .find("input,textarea,select")
                     .not('#inputDinheiroC')
                     .not('#pagamento')
                     .val('')
                     .end()
                  .find("input[type=checkbox], input[type=radio]")
                     .prop("checked", "")
                     .end();
            });             
        }
        $("#modalAlimentacao .modal-footer .action").one('click',function(event){
            event.stopImmediatePropagation();
            cadastrarPagamentoTEF(paymentTEF,formaPagamentoTEF);
        });
    }
    function btnRefeicao ()
    { 
        let formaPagamentoTEF = 'debito';
        //Necessário para o preenchimento do XML 
        let paymentTEF = '11';
        limitarVenda();   
        validarInputDesconto();   
        //Botao Visualizar Formas de Pagamento: Retornar a cor preta
        $("#visualizarFormaPagamento").css({'color':'black'});  
        $("#modalRefeicao").draggable({ handle: ".modal-body" });
        $('#parcela').hide();
        $('#valorParcelas').hide();
        $('#divBandeira').show();
        $('#divCredenciadora').show();
        $('#divintPag').show();
        $('#divAutorizacaoCartao').show();
        $('#pagamento').val('11'); 
        $('#pagamento option[value="01"]').hide();
        $('#pagamento option[value="02"]').hide();
        $('#pagamento option[value="03"]').hide();
        $('#pagamento option[value="04"]').hide();
        $('#pagamento option[value="05"]').hide();
        $('#pagamento option[value="10"]').hide();
        $('#pagamento option[value="12"]').hide();
        $('#pagamento option[value="13"]').hide();
        $('#pagamento option[value="99"]').hide();
        $("#modalRefeicao .modal-body").append($('#divPagamento').show());
        if($("#spanRestante").text() !== '')
        {
            $('#inputDinheiroC').val($("#spanRestante").text());
        }   
        $("#modalRefeicao").modal('show');
        //Resetar Modal
        if(localStorage.length === 0)
        {
            $('#modalRefeicao').on('shown.bs.modal', function (e) {
                $(this)
                  .find("input,textarea,select")
                     .not("#pagamento")
                     .not("#inputDescontoC")
                     .val('')
                     .end()
                  .find("input[type=checkbox], input[type=radio]")
                     .prop("checked", "")
                     .end();
            }); 
        } else if(localStorage.length > 0)
        {
            $('#modalRefeicao').on('shown.bs.modal', function (e) {
                $(this)
                  .find("input,textarea,select")
                     .not('#inputDinheiroC')
                     .not('#pagamento')
                     .val('')
                     .end()
                  .find("input[type=checkbox], input[type=radio]")
                     .prop("checked", "")
                     .end();
            });             
        }
        $("#modalRefeicao .modal-footer .action").one('click',function(event){
            event.stopImmediatePropagation();
            cadastrarPagamentoTEF(paymentTEF,formaPagamentoTEF);
        });
    }
    function calcDesconto()
    {   
        if($( "#checkboxDesconto" ).is( ":checked" ))
        {
            let valorTotal = $("#spanValorTotal").text();
            let desconto = $("#inputDesconto").val() || $("#inputDescontoC").val();
            valorTotal = valorTotal.replace(/,/g, '.');
            desconto = desconto.replace(/,/g, '.');
            let total = valorTotal - desconto;
            total = parseFloat((total).toFixed(2));
            if($("#spanValorTotalDesconto") !== '')
            {                
                $("#spanValorTotalDesconto").text('');
                $('#spanValorTotalDesconto').append((total));
                $('#divValorTotalDesconto').fadeIn(1000).css('font-weight','bold');
            }
            return total;
        }
    }
    /*Essa função faz quatro verificações, se o localstorage é === 0 ou 1 && e se o checkbox de desconto
    foi marcado ou desmarcado
    O Desconto só será aplicado na primeira forma de pagamento, retirar o input desconto quando 
    localstorage === 1
    */
    function calcTroco(dinheiro)
    {
        //localStorage vazio
        if(localStorage.length === 0)
        {
            //Se não for marcado o checkbox de desconto
            if(!$( "#checkboxDesconto" ).is( ":checked" ))
            {
                let valorTotal = $("#spanValorTotal").text();
                dinheiro = dinheiro.replace(/,/g, '.');
                valorTotal = valorTotal.replace(/,/g, '.');
                let troco = dinheiro - valorTotal
                troco = parseFloat((troco).toFixed(2));
                //Se o troco for negativo, o pagamento será feito em mais de uma forma;
                if(troco < 0)
                {
                    $('#divTroco').hide();
                    if($('#spanRestante').text() !== '')
                    {$('#spanRestante').text('');}
                    $('#spanRestante').append(troco * -1);
                    $('#divValorRestante').fadeIn(1000).css('font-weight','bold');
                    alert('Valor pago não completou o valor total da NFC-e!!');
                //Se o troco for maior q zero, mostrar na tela o troco;
                } else if(troco > 0)
                {
                if($('#spanRestante').text() !== '')
                {
                    $('#spanRestante').text('');
                }
                if($('#spanTroco').text() !== '')
                {
                    $('#spanTroco').text('');
                }
                $('#spanTroco').append(troco);
                $('#divTroco').fadeIn(1000).css('font-weight','bold');
                //Se o troco for 0, sem troco & somente 1 forma de pagamento
                } else if(troco === 0) 
                {
                    alert('Valor total da NFC-e paga!');
                    $('#divValorRestante').hide();
                    $('#divTroco').hide();
                    $('#divValorRestante').hide();
                }
            }
            //Se for marcado o checkbox de desconto, mesma lógica anterior, só que sem desconto
            else if($( "#checkboxDesconto" ).is( ":checked" ))
            {
                let valorTotal = $("#spanValorTotalDesconto").text();
                let dinheiro = $("#inputDinheiro").val() || $("#inputDinheiroC").val() ;
                valorTotal = valorTotal.replace(/,/g, '.');
                dinheiro = dinheiro.replace(/,/g, '.');
                let troco = dinheiro - valorTotal;
                troco = parseFloat((troco).toFixed(2));
                if(troco < 0)
                {
                    $('#divTroco').hide();
                    if($('#spanRestante').text() !== '')
                    {$('#spanRestante').text('');}
                    $('#spanRestante').append(troco * -1);
                    $('#divValorRestante').fadeIn(1000).css('font-weight','bold');
                    alert('Valor pago não completou o valor total da NFC-e!!');
                } else if(troco > 0)
                {
                $('#spanTroco').append(troco).show();
                $('#divTroco').fadeIn(1000).css('font-weight','bold');
                } else if(troco === 0) 
                {
                    alert('Valor total da NFC-e paga!');
                    $('#divValorRestante').hide();
                    $('#divTroco').hide();
                    $('#divValorRestante').hide();
                }
            } 
        //localStorage ja passui uma forma de pagamento
        } else if(localStorage.length > 0) 
        {
            if(!$( "#checkboxDesconto" ).is( ":checked" ))
            {
                let dinheiroLS = ls[0].dinheiro; //Valor
                dinheiroLS = dinheiroLS.replace(/,/g, '.');
                let valorTotal = $("#spanValorTotal").text();
                dinheiro = dinheiro.replace(/,/g, '.');
                valorTotal = valorTotal.replace(/,/g, '.');
                let soma = parseFloat(dinheiro) + parseFloat(dinheiroLS);
                let troco = soma - valorTotal;
                troco = parseFloat((troco).toFixed(2));
                if(troco < 0)
                {
                    alert('Valor pago não completou o valor total da NFC-e!!');
                } else if(troco > 0)
                {
                if($('#spanRestante').text() !== '')
                {$('#divValorRestante').hide();}
                $('#spanTroco').append(troco);
                $('#divTroco').fadeIn(1000).css('font-weight','bold');
                } else if(troco === 0) 
                {
                    alert('Valor total da NFC-e paga!');
                    $('#divValorRestante').hide();
                    $('#divTroco').hide();
                    $('#divValorRestante').hide();
                }
            } else if($( "#checkboxDesconto" ).is( ":checked" ))
            {
                let valorRestante = $("#spanRestante").text();
                let dinheiro = $("#inputDinheiroC").val() || $("#inputDinheiro").val();
                dinheiro = dinheiro.replace(/,/g, '.');
                valorRestante = valorRestante.replace(/,/g, '.');
                let troco = dinheiro - valorRestante;
                if(troco === 0)
                {
                    alert('Valor total da NFC-e paga!');
                    $('#divValorRestante').hide();
                    $('#divTroco').hide();
                    $('#divValorRestante').hide();
                }else if (troco < 0) {
                    $('#divTroco').hide();
                    if($('#spanRestante').text() !== '')
                    {$('#spanRestante').text('');}
                    $('#spanRestante').append(troco * -1);
                    $('#divValorRestante').fadeIn(1000).css('font-weight','bold');
                    alert('Valor pago não completou o valor total da NFC-e!!');
                } else if (troco > 0) {
                    troco = parseFloat((troco).toFixed(2));
                    $('#spanTroco').append(troco).show();
                    $('#divTroco').fadeIn(1000).css('font-weight','bold');
                    $('#divValorRestante').hide();
                }
            }
        }//
        
    }
    $(document).on('click','#visualizarFormaPagamento',function(e){
        $("#modalVisualizarPagamentos").draggable({ handle: ".modal-body" });   
        //Botao Visualizar Formas de Pagamento: Retornar a cor preta
        $("#visualizarFormaPagamento").css({'color':'black'});
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
        $(document).one('click','#resetarLS',function(event)
        {  
            event.stopImmediatePropagation();
            $('#spanRestante').text('');
            $('#divValorRestante').hide();
            $('#divTroco').hide('');
            $('#spanTroco').text();
            localStorage.clear();
            alert('Formas de Pagamento Deletadas');            
            $('#inputDinheiro').val('');
            $('#inputDinheiroC').val('');            
            $(".modal").modal('hide'); 
        });
    });
    //Multiplas formas de pagamento
    //Filtrar forma de pagamento
    // Card Dinheiro
    $(document).on('click','#btnDinheiro',function(e){
        var creditoFilter;
        let b;
        if(localStorage.length !== 0)
        {      
            b = JSON.parse(localStorage.getItem('session'));      
            creditoFilter = b.filter(function (el) {
                return el.formaPagamento === 'dinheiro';
            });
            
        }
        if(localStorage.length === 0) {btnDinheiro();}
        else if(localStorage.length === 1 && creditoFilter.length === 1)
        {
            alert('Forma de Pagamento no Dinheiro Já Cadastrada');
            $("#visualizarFormaPagamento").animate({
                color: '#FF0000'
            },1000);
        }
        else if(localStorage.length === 1 && b[0].formaPagamento === 'debito')
        {btnDinheiro();}
        else if(localStorage.length === 1 && b[0].formaPagamento === 'credito')
        {btnDinheiro();}
        else if(localStorage.length === 1 && b[0].formaPagamento === 'refeicao')
        {btnDinheiro();}
        else if(localStorage.length === 1 && b[0].formaPagamento === 'cheque')
        {btnDinheiro();}
        else if(localStorage.length === 1 && b[0].formaPagamento === 'alimentacao')
        {btnDinheiro();}
        });
    $(document).on('click','#btnCheque',function(e){
        var creditoFilter;
        let b;
        if(localStorage.length !== 0)
        {      
            b = JSON.parse(localStorage.getItem('session'));      
            creditoFilter = b.filter(function (el) {
                return el.formaPagamento === 'cheque';
            });
            
        }
        if(localStorage.length === 0) {btnCheque();}
        else if(localStorage.length === 1 && creditoFilter.length === 1)
        {
            alert('Forma de Pagamento no Dinheiro Já Cadastrada');
            $("#visualizarFormaPagamento").animate({
                color: '#FF0000'
            },1000);
        }
        else if(localStorage.length === 1 && b[0].formaPagamento === 'debito')
        {btnCheque();}
        else if(localStorage.length === 1 && b[0].formaPagamento === 'credito')
        {btnCheque();}
        else if(localStorage.length === 1 && b[0].formaPagamento === 'refeicao')
        {btnCheque();}
        else if(localStorage.length === 1 && b[0].formaPagamento === 'dinheiro')
        {btnCheque();}
        else if(localStorage.length === 1 && b[0].formaPagamento === 'alimentacao')
        {btnCheque();}
        });
    // Card Cartão de Crédito
    $(document).on('click','#btnCredito',function(e){
        var creditoFilter;
        let b;
        if(localStorage.length !== 0)
        {      
            b = JSON.parse(localStorage.getItem('session'));      
            creditoFilter = b.filter(function (el) {
                return el.formaPagamento === 'credito';
            });
            
        }
        if(localStorage.length === 0) {btnCredito();}
        else if(localStorage.length === 1 && creditoFilter.length === 1)
        {
            alert('Forma de Pagamento no Cartão de Crédito Já Cadastrada');
            $("#visualizarFormaPagamento").animate({
                color: '#FF0000'
            },1000);
        }
        else if(localStorage.length === 1 && b[0].formaPagamento === 'dinheiro')
        {btnCredito();}
        else if(localStorage.length === 1 && b[0].formaPagamento === 'debito')
        {btnCredito();}
        else if(localStorage.length === 1 && b[0].formaPagamento === 'alimentacao')
        {btnCredito();}
        else if(localStorage.length === 1 && b[0].formaPagamento === 'refeicao')
        {btnCredito();}
        else if(localStorage.length === 1 && b[0].formaPagamento === 'cheque')
        {btnCredito();}
    });
    //Card Debito
    $(document).on('click','#btnDebito',function(e){
        var debitoFilter;
        let b;
        if(localStorage.length !== 0)
        {      
            b = JSON.parse(localStorage.getItem('session'));      
            debitoFilter = b.filter(function (el) {
                return el.formaPagamento === 'debito';
            });
            
        }
        if(localStorage.length === 0) {btnDebito();}
        else if(localStorage.length === 1 && debitoFilter.length === 1)
        {
            alert('Forma de Pagamento no Cartão de Débito Já Cadastrada');
            $("#visualizarFormaPagamento").animate({
                color: '#FF0000'
            },1000);
        }else if(localStorage.length === 1 && b[0].formaPagamento === 'credito')
        {btnDebito();}
        else if(localStorage.length === 1 && b[0].formaPagamento === 'dinheiro')
        {btnDebito();}
        else if(localStorage.length === 1 && b[0].formaPagamento === 'alimentacao')
        {btnDebito();}
        else if(localStorage.length === 1 && b[0].formaPagamento === 'refeicao')
        {btnDebito();}
        else if(localStorage.length === 1 && b[0].formaPagamento === 'cheque')
        {btnDebito();}
    });
    //Card Alimentação
    $(document).on('click','#btnAlimentacao',function(e){
        var creditoFilter;
        let b;
        if(localStorage.length !== 0)
        {      
            b = JSON.parse(localStorage.getItem('session'));      
            creditoFilter = b.filter(function (el) {
                return el.formaPagamento === 'alimentacao';
            });
            
        }
        if(localStorage.length === 0) {btnAlimentacao();}
        else if(localStorage.length === 1 && creditoFilter.length === 1)
        {
            alert('Forma de Pagamento no Vale Alimentação Já Cadastrada');
            $("#visualizarFormaPagamento").animate({
                color: '#FF0000'
            },1000);
        }
        else if(localStorage.length === 1 && b[0].formaPagamento === 'dinheiro')
        {btnAlimentacao();}
        else if(localStorage.length === 1 && b[0].formaPagamento === 'debito')
        {btnAlimentacao();}
        else if(localStorage.length === 1 && b[0].formaPagamento === 'credito')
        {btnAlimentacao();}
        else if(localStorage.length === 1 && b[0].formaPagamento === 'refeicao')
        {btnAlimentacao();}
        else if(localStorage.length === 1 && b[0].formaPagamento === 'cheque')
        {btnAlimentacao();}           
    });  
    //Card Refeição
    $(document).on('click','#btnRefeicao',function(e){
        var creditoFilter;
        let b;
        if(localStorage.length !== 0)
        {      
            b = JSON.parse(localStorage.getItem('session'));      
            creditoFilter = b.filter(function (el) {
                return el.formaPagamento === 'refeicao';
            });
            
        }
        if(localStorage.length === 0) {btnRefeicao();}
        else if(localStorage.length === 1 && creditoFilter.length === 1)
        {
            alert('Forma de Pagamento no Vale Refeição Já Cadastrada');
            $("#visualizarFormaPagamento").animate({
                color: '#FF0000'
            },1000);
        }
        else if(localStorage.length === 1 && b[0].formaPagamento === 'dinheiro')
        {btnRefeicao();}
        else if(localStorage.length === 1 && b[0].formaPagamento === 'debito')
        {btnRefeicao();}
        else if(localStorage.length === 1 && b[0].formaPagamento === 'credito')
        {btnRefeicao();}
        else if(localStorage.length === 1 && b[0].formaPagamento === 'alimentacao')
        {btnRefeicao();}
        else if(localStorage.length === 1 && b[0].formaPagamento === 'cheque')
        {btnRefeicao();}              
    });  
});