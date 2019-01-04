$(document).ready(function(){
    $("#formProduto").fadeIn(800);
    $("#rowButtons").show();
	$('#formProduto').on('submit', function(e){ 
		e.preventDefault();
        let produto = $('#inputDescricaoProduto').val();
        let NCM = $('#inputNCMProduto').val();
        let preco = $('#inputPrecoProduto').val();
        let CFOP = $('#inputCFOPProduto').val();
        $.ajax({
            method:'post',
            url:'http://localhost/geradorXml/App/public/api/produto/add',
            dataType: 'json',
            data:{produto:produto, NCM:NCM, preco:preco, CFOP:CFOP }
        }).done((data) =>{
            if(data == '{\"Aviso\": {\"text\": \"Produto Adicionado\"}') 
            {
                alert('Produto Adicionado com Sucesso!!');
                window.location.replace("http://localhost/geradorXml/App/View/Produto/fetch.php");                
            }
        });
    });   
});