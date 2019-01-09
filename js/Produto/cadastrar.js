$(document).ready(function(){
    $("#formProduto").fadeIn(800);
    $("#rowButtons").show();
	$('#formProduto').on('submit', function(e){ 
		e.preventDefault();
        let produto = $('#inputDescricaoProduto').val();
        let NCM = $('#inputNCMProduto').val();
        let preco = $('#inputPrecoProduto').val();
        let CFOP = $('#inputCFOPProduto').val();
        console.log(CFOP);
        $.ajax({
            method:'post',
            url:'http://localhost/geradorXml/App/public/api/produto/add',
            dataType: 'json',
            data:{descricao:produto, ncm:NCM, preco_custo:preco, CFOP:CFOP }
        }).done(function(data){
            console.log(data);
            if(data == '{\"Aviso\": {\"text\": \"Produto Adicionado\"}') 
            {              
            }
        });
    });   
});