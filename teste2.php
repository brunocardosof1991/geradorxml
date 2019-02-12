
<?php
/* use App\Model\Venda;
require_once $_SERVER['DOCUMENT_ROOT'] . '/geradorxml/vendor/autoload.php';
$jsonUM = '[[],[{"formaPagamento":"dinheiro","dinheiro":"1853.7","payment":"01"}],"Colocar aqui algum text padr\u00e3o, exemplo nome da empresa, endere\u00e7o, etc...",1853.7,{"id":"1","CNPJ":"12291758000105","xNome":"BGC Automatize","xLgr":"RUA","xFant":"SyS SyS","nro":"115","xBairro":"BAIRRO","cMun":"4314902","xMun":"Guaiba","UF":"RS","CEP":"92500000","cPais":"1058","xPais":"Brasil","fone":"51999688986","IE":"0963376802","IM":"14018","CRT":"1","CNAE":"6202300"}]';
$jsonDois = '[[],[{"formaPagamento":"debito","dinheiro":"1000","payment":"04","bandeira":"06","credCartao":"03106213000271","intPag":"1","codigo":"167"},{"formaPagamento":"credito","dinheiro":"853.7","payment":"03","bandeira":"01","credCartao":"03106213000271","intPag":"1","codigo":"164"}],"Colocar aqui algum text padr\u00e3o, exemplo nome da empresa, endere\u00e7o, etc...",1853.7,{"id":"1","CNPJ":"12291758000105","xNome":"BGC Automatize","xLgr":"RUA","xFant":"SyS SyS","nro":"115","xBairro":"BAIRRO","cMun":"4314902","xMun":"Guaiba","UF":"RS","CEP":"92500000","cPais":"1058","xPais":"Brasil","fone":"51999688986","IE":"0963376802","IM":"14018","CRT":"1","CNAE":"6202300"}]';
$json = '[{"tPag":"01","vPag":"1000"},{"tPag":"03","vPag":"853.7","tpIntegra":"1","CNPJ":"03106213000271","tBand":"01","cAut":"167"}]';
$jsonProduto = '{"info":[[],[{"formaPagamento":"credito","dinheiro":"1500","payment":"03","bandeira":"01","credCartao":"03106213000271","intPag":"1","codigo":"175","parcelas":"7","valorParcelas":"214.29"},{"formaPagamento":"dinheiro","dinheiro":"1437.3","payment":"01"}],"\n                Cr\u00e9dito: \n                Numero de Parcelas: 7x \n                Valor das Parcelas: R$214.29\n                ",2937.3,{"id":"1","CNPJ":"12291758000105","xNome":"BGC Automatize","xLgr":"RUA","xFant":"SyS SyS","nro":"115","xBairro":"BAIRRO","cMun":"4314902","xMun":"Guaiba","UF":"RS","CEP":"92500000","cPais":"1058","xPais":"Brasil","fone":"51999688986","IE":"0963376802","IM":"14018","CRT":"1","CNAE":"6202300"},30],"produto":[{"ncm":"84714900","CFOP":"5103","UN":"UN","Descricao":"NOTA FISCAL EMITIDA EM AMBIENTE DE HOMOLOGACAO - SEM VALOR FISCAL","Codigo":"111111112","Qtd":"10","Vl Unit":"185.37","Vl Total":1853.7},{"ncm":"84714900","CFOP":"5103","UN":"UN","Descricao":"NOTA FISCAL EMITIDA EM AMBIENTE DE HOMOLOGACAO - SEM VALOR FISCAL","Codigo":"111111113","Qtd":"5","Vl Unit":"184.38","Vl Total":921.9},{"ncm":"84714900","CFOP":"5103","UN":"UN","Descricao":"NOTA FISCAL EMITIDA EM AMBIENTE DE HOMOLOGACAO - SEM VALOR FISCAL","Codigo":"111111114","Qtd":"15","Vl Unit":"10.78","Vl Total":161.7}],"qrcode":"https:\/\/www.sefaz.rs.gov.br\/NFCE\/NFCE-COM.aspx?p=43190212291758000105650011060001891106001894|2|2|1|F271DD9D963DD737A16B35521720BCB92ED83E60"}';
$vendaA = json_decode($jsonProduto,true);

if(!empty($vendaA['info'][0]['inputName']))
{unset($vendaA['info'][0]);} 

unset($vendaA['info'][4]); 

print_r(($vendaA['info'][1][0]['formaPagamento']));echo '<br>';echo '<br>';

print_r('Valor Total: '.$vendaA['info'][3]);echo '<br>';echo '<br>';

print_r('Quantidade Total: '.$vendaA['info'][5]);echo '<br>';echo '<br>';

print_r($vendaA['info'][1][0]);echo '<br>';echo '<br>';

print_r($vendaA['info'][1][1]);echo '<br>';echo '<br>';

print_r($vendaA['produto']);echo '<br>';echo '<br>';
print_r(count($vendaA['produto']));echo '<br>';echo '<br>';
$produtosArray = '';
for($i = 0; $i <count($vendaA['produto']); $i++ )
{
    $produtosArray .= $vendaA['produto'][$i]['Qtd'].',';
}echo '<br>';echo '<br>';
$produtosArray = explode(',', $produtosArray);
if (end($produtosArray) == "") { 
    array_pop($produtosArray); 
}
var_dump(($produtosArray));echo '<br>';echo '<br>';

print_r($vendaA['qrcode']);echo '<br>';echo '<br>';
print_r($vendaA);
$venda = new Venda();
$venda->add($vendaA); */
var_dump(file_get_contents("file:///C:/Unimake/UniNFe/12291758000105/nfce/Enviado/Autorizados/201901/NFe43190112291758000105650011000000341100000340-procNFe.xml"));
?>

