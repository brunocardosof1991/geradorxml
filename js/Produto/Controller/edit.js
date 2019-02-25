import { isValidCFOP, validateCFOPField } from './validation.js';
import { isValidcEAN, validatecEANField } from './validation.js';
import { isValidNCM, validateNCMField } from './validation.js';
import { isValidpreco_custo, validatepreco_custoField } from './validation.js';
import { isValidDescricao, validateDescricao } from './validation.js';
import { Produto } from '../Model/Produto.js';

export const editarProduto = $(document).on('click', '#editarProduto',function() { 
    //Coletar as informações da <tr> do respectivo produto 
    var id = $(this).closest('tr').children('td:eq(0)').text();
    var descricaoTable = $(this).closest('tr').children('td:eq(1)').text();
    var NCMTable = $(this).closest('tr').children('td:eq(2)').text();
    var preco_custoTable = $(this).closest('tr').children('td:eq(3)').text();
    var CFOPTable = $(this).closest('tr').children('td:eq(4)').text();
    var cEANTable = $(this).closest('tr').children('td:eq(5)').text();
    //Startar o Modal - Remover componenets padrão do #apiModal
    $("#apiModal .modal-body .chart").remove(); 
    $("#apiModal .modal-body p").remove(); 
    $("h1").remove(); 
    $("#apiModal .modal-title").text('Editar Produto');
    $("#apiModal").modal('show');
    $("#apiModal .modal-body").append($('#formProduto').show());
    $("#apiModal .modal-footer .action").text('Editar').show(); 
    //Preencher os inputs do formProduto com as informações coletadas da tabela dos produtos cadastrados
    $('#inputDescricaoProduto').val(descricaoTable);
    $('#inputNCMProduto').val(NCMTable);
    $('#inputPrecoProduto').val(preco_custoTable);
    $('#inputCFOPProduto').val(CFOPTable);        
    $('#inputcEANProduto').val(cEANTable);        
    $("#apiModal .modal-footer .action").on('click',function(){
        const produto = new Produto();
        produto.descricao = $('#inputDescricaoProduto').val();
        produto.NCM = $('#inputNCMProduto').val();
        produto.preco_custo = $('#inputPrecoProduto').val();
        produto.CFOP = $('#inputCFOPProduto').val();
        produto.cEAN = $('#inputcEANProduto').val();
        $.ajax({
            method:'put',
            url: 'http://localhost/geradorXml/App/public/api/produto/update/'+id,
            dataType: 'json',
            data:{id:id, descricao:produto.descricao, NCM:produto.NCM, preco_custo:produto.preco_custo, 
                CFOP:produto.CFOP,cEAN:produto.cEAN}
        }).done(function(data){
            if(data == '{"success": "Produto Atualizado"}')
            {
                alert('Produto Atualizado');
                location = location;             
            }
        });
    });
});