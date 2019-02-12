<?php
use App\Model\Xml;
require_once $_SERVER['DOCUMENT_ROOT'] . '/geradorxml/vendor/autoload.php';
if(isset($_POST['json']) && ($_POST['produto']))
{
    $file1Array = json_decode($_POST['json'],true);
    $produto = json_decode($_POST['produto'],true);
    foreach ( $produto as $k=>$v )
    {
      $produto[$k] ['Descricao'] = $produto[$k] ['descricao'];
      $produto[$k] ['Codigo'] = $produto[$k] ['id'];
      $produto[$k] ['Qtd'] = $produto[$k] ['quantidade'];
      $produto[$k] ['Vl Unit'] = $produto[$k] ['preco'];
      $produto[$k] ['Vl Total'] = $produto[$k] ['total'];
      unset($produto[$k]['descricao']);
      unset($produto[$k]['id']);
      unset($produto[$k]['quantidade']);
      unset($produto[$k]['preco']);
      unset($produto[$k]['total']);
    }
    //Somar as quantidades de itens(produtos)
    //Não foi colocado a qtd total dos itens no array dos produtos pq está dando erro na tabela dos produtos na geração da DANFE
    //Então coloquei no array das informações restante(cliente, emissor, ...)$file1Array
    $addTotalItens = 0;
    foreach ($produto as $item) {
        $addTotalItens += $item['Qtd'];
    }
    array_push($file1Array,$addTotalItens);
    $xml = new Xml();
    // Se o destinatário não for identificado, será enviado para a função de autorização $dest = false
    $dest = true;
    if(!empty($file1Array[0]['inputName']) && !empty($file1Array[0]['inputRegistro']) && !empty($file1Array[0]['inputEndereco']) && !empty($file1Array[0]['inputNumero']) && !empty($file1Array[0]['inputComplemento']) && !empty($file1Array[0]['inputBairro']) && !empty($file1Array[0]['inputCEP']) && !empty($file1Array[0]['inputFone']) && !empty($file1Array[0]['inputMunicipio']) && !empty($file1Array[0]['inputUF']))
    {
        $xml->dest['xNome'] = $file1Array[0]['inputName'];
        $xml->dest['CNPJ'] = $file1Array[0]['inputRegistro'];
        $xml->enderDest['xLgr'] = $file1Array[0]['inputEndereco'];
        $xml->enderDest['nro'] = $file1Array[0]['inputNumero'];
        $xml->enderDest['xCpl'] = $file1Array[0]['inputComplemento'];
        $xml->enderDest['xBairro'] = $file1Array[0]['inputBairro'];
        $xml->enderDest['CEP'] = $file1Array[0]['inputCEP'];
        $xml->enderDest['fone'] = $file1Array[0]['inputFone'];
        $xml->enderDest['xMun'] = $file1Array[0]['inputMunicipio'];
        $xml->enderDest['UF'] = $file1Array[0]['inputUF'];
    } else{
        $dest = false;
    }
    //Forma de Pagamento
    //Array para multiplas formas de pagamentos
    $pagamentos = array();
    //Somente uma forma de pagamento
    if(count($file1Array[1]) === 1)
    {
        //Pagamento no dinheiro ou cheque
        if($file1Array[1][0]['formaPagamento'] === 'dinheiro' || $file1Array[1][0]['formaPagamento'] === 'cheque' )
        {
            $xml->detPag['tPag'] = $file1Array[1][0]['payment'];
            $xml->detPag['vPag'] = $file1Array[3];//Valor total a ser pago                    
        } else { //Pagamento no Cartão
            $xml->detPag['tPag'] = $file1Array[1][0]['payment'];
            $xml->detPag['vPag'] = $file1Array[3]; //Valor total a ser pago
            $xml->card['tpIntegra'] = $file1Array[1][0]['intPag'];
            $xml->card['CNPJ'] = $file1Array[1][0]['credCartao'];
            $xml->card['tBand'] = $file1Array[1][0]['bandeira'];
            $xml->card['cAut'] = $file1Array[1][0]['codigo']; 
        }
    //Duas Formas de Pagamentos
    }else if((count($file1Array[1]) > 1))
    {
        for($i = 0; $i <count($file1Array[1]); $i++)
        {
            //Pagamento no dinheiro ou cheque
            if($file1Array[1][$i]['formaPagamento'] === 'dinheiro' || $file1Array[1][$i]['formaPagamento'] === 'cheque' )
            {
                $dinheiro['tPag'] = $file1Array[1][$i]['payment'];
                $dinheiro['vPag'] = $file1Array[1][$i]['dinheiro'];//Valor total a ser pago
                array_push($pagamentos,$dinheiro);               
            } 
            else { //Pagamento no Cartão
                $cartao['tPag'] = $file1Array[1][$i]['payment'];
                $cartao['vPag'] = $file1Array[1][$i]['dinheiro']; //Valor total a ser pago
                $cartao['tpIntegra'] = $file1Array[1][$i]['intPag'];
                $cartao['CNPJ'] = $file1Array[1][$i]['credCartao'];
                $cartao['tBand'] = $file1Array[1][$i]['bandeira'];
                $cartao['cAut'] = $file1Array[1][$i]['codigo'];  
                array_push($pagamentos,$cartao);        
            }                    
        }
    }
    //Informações Adicionais NFC-e - Text Area
    $informacoesAdicionais = $file1Array[2];
    try {
        file_put_contents($_SERVER['DOCUMENT_ROOT']  . '/geradorxml/app/public/chaveDeAcesso.txt',$xml->gerarChaveDeAcesso());
        file_put_contents($_SERVER['DOCUMENT_ROOT']  . '/geradorxml/app/public/info.json',json_encode($file1Array,true));
        file_put_contents($_SERVER['DOCUMENT_ROOT']  . '/geradorxml/app/public/produto.json',json_encode($produto,true));
        $xml->autorizarXML($informacoesAdicionais,$produto,$dest,$pagamentos,$file1Array[3]);
        //$xml->saidaProduto($produto);
        echo json_encode($xml->gerarChaveDeAcesso());                
        echo exec('move c:\xampp\htdocs\geradorXml\App\Controller\UniNFe\Autorizar\*-nfe.xml c:\Unimake\UniNFe\12291758000105\nfce\Envio > nul');
    } catch (\Throwable $e) {
        echo '{"error": '.$e->getMessage().'}';
    }       
}