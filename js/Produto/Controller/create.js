import { isValidCFOP, validateCFOPField } from './validation.js';
import { isValidcEAN, validatecEANField } from './validation.js';
import { isValidNCM, validateNCMField } from './validation.js';
import { isValidpreco_custo, validatepreco_custoField } from './validation.js';
import { isValidDescricao, validateDescricao } from './validation.js';
import { Produto } from '../Model/Produto.js';

export const addProduto = $(document).on('click','#addProduto',function(){
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
        const produto = new Produto();
        produto.descricao = $('#inputDescricaoProduto').val();
        produto.NCM = $('#inputNCMProduto').val();
        produto.preco_custo = $('#inputPrecoProduto').val();
        produto.CFOP = $('#inputCFOPProduto').val();
        produto.cEAN = $('#inputcEANProduto').val();
        produto.preco_custo = produto.preco_custo.replace(/,/g, '.');
        validateCFOPField(produto.CFOP, event);
        validatecEANField(produto.cEAN, event);
        validateNCMField(produto.NCM, event);
        validatepreco_custoField(produto.preco_custo, event);
        validateDescricao(produto.descricao, event);
        if(isValidCFOP(produto.CFOP) !== false && isValidcEAN(produto.cEAN) !== false && isValidcEAN(produto.NCM) !== false && 
        isValidpreco_custo(produto.preco_custo) !== false && isValidDescricao(produto.descricao) !== false)
        {
            $.ajax({
                method:'post',
                url: 'http://localhost/geradorXml/App/public/api/produto/add',
                dataType: 'json',
                data:{descricao:produto.descricao, ncm:produto.NCM, preco_custo:produto.preco_custo, 
                    CFOP:produto.CFOP,cEAN:produto.cEAN}
            }).done(function(data){
                console.log(data);
                if(data == '{"success": "Produto Adicionado"}')
                {
                    alert('Produto Adicionado com Sucesso'); 
                    location = location;
                }
            });
        }
        });
    });    