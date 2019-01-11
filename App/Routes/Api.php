<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use App\Model\Xml;
use App\Model\Conexao;
use App\Model\Cliente;
use App\Model\Produto;
use App\Model\NF;
use App\Model\Emissor;

$app = new \Slim\App;
$xml = new Xml();

$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});
    // Rotas:NF E Eventos NF, Cliente, Produto, Emissor
    // Rota para o grupo API
    $app->group('/api', function () use ($app) 
    { 
        $app->post('/cappta', function(Request $request, Response $response)
        { 
            
        });
        $app->post('/inutilizar', function(Request $request, Response $response)
        { 
            $xml = new Xml();
            $inicio = $request->getParam('inicio');
            $fim = $request->getParam('fim');
            $xml->inutilizarXml($inicio,$fim);
            echo json_encode('{"success": "Numeracao Inutilizada"}');
            echo exec('move c:\xampp\htdocs\geradorXml\App\public\*-ped-inu.xml c:\Unimake\UniNFe\12291758000105\nfce\Envio > nul');
        });
        // Rota para a criação do XML de cancelamento
        // NF/fetch.js
        $app->post('/cancelarNFCe', function(Request $request, Response $response)
        {
            $xml = new Xml();
            $protocolo = $request->getParam('protocolo');
            $chave = $request->getParam('chave');
            $xml->cancelarXml($protocolo, $chave);
            echo json_encode('{"success": "XML Cancelado"}');
            file_put_contents('chaveDeAcesso.txt',substr_replace($chave,'', 0, 3));
            echo exec('move c:\xampp\htdocs\geradorXml\App\public\*-ped-eve.xml c:\Unimake\UniNFe\12291758000105\nfce\Envio > nul');
        });
        //Rota para verificar <cStat>135</cStat><xMotivo>Evento registrado e vinculado a NF-e</xMotivo>
        $app->post('/cancelarNFCe/true', function(Request $request, Response $response)
        { 
            $data = new DateTime('now', new DateTimeZone( 'America/Sao_Paulo'));
            $YM = substr_replace($data->format('Y-m'), '', -3, -2);
            //Coletar a chave de acesso salva na rota /autirzarXml 
            $chave = file_get_contents("chaveDeAcesso.txt");
            $chave .= '_110111_01-procEventoNFe.xml';
            $xmlAutorizado = glob("C:/Unimake/UniNFe/12291758000105/nfce/Enviado/Autorizados/$YM/$chave");
            $xmlAutorizado2 = end($xmlAutorizado);
            $xmlAutorizadoToString = print_r($xmlAutorizado2,true);
            $data = array();
            //Se a NFC-e foi cancelada...
            if(!empty($xmlAutorizadoToString)) {
                $xml = new Xml();
                //$xml->salvarNFCancelada($protocolo);
                echo exec('del /f "chaveDeAcesso.txt"');
                $data = 'success';
            } else {        
                $data = 'error';
            }
            echo json_encode($data);
        });  
        //Rota para a criação do XML de autorização
        $app->post('/autorizarNFCe', function(Request $request, Response $response)
        {
            $file1Array = json_decode($request->getParam('json'),true);
            $produto = json_decode($request->getParam('produto'),true);
            $xml = new Xml();
            //Destinatário
            $xml->dest['ID'] = $file1Array[0]['clientID'];
            $xml->dest['xNome'] = $file1Array[0]['inputName'];
            $xml->dest['CNPJ'] = $file1Array[0]['inputRegistro'];
            $xml->enderDest['xLgr'] = $file1Array[0]['inputEndereco'];
            $xml->enderDest['nro'] = $file1Array[0]['inputNumero'];
            $xml->enderDest['xCpl'] = $file1Array[0]['inputComplemento'];
            $xml->enderDest['xBairro'] = $file1Array[0]['inputBairro'];
            $xml->enderDest['CEP'] = $file1Array[0]['inputCEP'];
            $xml->enderDest['fone'] = $file1Array[0]['inputFone'];
            //Forma de Pagamento
            if($file1Array[1]['payment'] == 01 || $file1Array[1]['payment']== 02)
            {
                $xml->detPag['tPag'] = $file1Array[1]['payment'];
                $xml->detPag['vPag'] = $valorTotal = $file1Array[3];//Valor total a ser pago
            } else 
            {
                $xml->detPag['tPag'] = $file1Array[1]['payment'];
                $xml->detPag['vPag'] = $valorTotal = $file1Array[3]; //Valor total a ser pago
                $xml->card['tpIntegra'] = $file1Array[1]['intPagamento'];
                $xml->card['CNPJ'] = $file1Array[1]['credCartao'];
                $xml->card['tBand'] = $file1Array[1]['bandeira'];
                $xml->card['cAut'] = $file1Array[0]['codigoSeguranca'];        
            }
            //Informações Adicionais NFC-e - Text Area
            $informacoesAdicionais = $file1Array[2];
            try {
                file_put_contents('chaveDeAcesso.txt',$xml->gerarChaveDeAcesso());
                $xml->autorizarXML($informacoesAdicionais,$produto);
                //$xml->saidaProduto($produto);
                echo json_encode('{"success": "XML Autorizado"}');                
                echo exec('move c:\xampp\htdocs\geradorXml\App\public\*-nfe.xml c:\Unimake\UniNFe\12291758000105\nfce\Envio > nul');
            } catch (\Throwable $e) {
                echo '{"error": '.$e->getMessage().'}';
            }   
        });//END /autorizarNFCe
        //Rota para verificar se o xml foi autorizado && salvar NF no banco de dados c/ protocolo de autorização
        // As informações salva no banco de dados serão úteis para o cancelamento da NFC-e
        $app->post('/autorizarNFCe/true', function(Request $request, Response $response)
        { 
            $data = new DateTime('now', new DateTimeZone( 'America/Sao_Paulo'));
            $YM = substr_replace($data->format('Y-m'), '', -3, -2);
            //Coletar a chave de acesso salva na rota /autirzarXml 
            $chave = file_get_contents("chaveDeAcesso.txt");
            $chave .= '-procNFe.xml';
            $xmlAutorizado = glob("C:/Unimake/UniNFe/12291758000105/nfce/Enviado/Autorizados/$YM/$chave");
            $xmlAutorizado2 = end($xmlAutorizado);
            $xmlAutorizadoToString = print_r($xmlAutorizado2,true);
            $data = array();
            //Se a NFC-e foi autorizada...
            if(!empty($xmlAutorizadoToString)) {
                //Colocar toda NFC-e em uma variável
                $NFCe = file_get_contents($xmlAutorizado2);
                //Coletar o protocolo da NFC-e autorizada
                //Começo da coleta
                $fromP = "<nProt>";
                //Fim da coleta
                $toP = "</nProt>";
                function getProtocolo($NFCe,$fromP,$toP)
                {
                    $sub = substr($NFCe, strpos($NFCe,$fromP)+strlen($fromP),strlen($NFCe));
                    return substr($sub,0,strpos($sub,$toP));
                }  
                $protocolo = getProtocolo($NFCe,$fromP,$toP);
                $xml = new Xml();
                $xml->salvarNF($protocolo);
                echo exec('del /f "chaveDeAcesso.txt"');
                $data = 'success';
            } else {        
                $data = 'error';
            }
            echo json_encode($data);
        });//END /autorizarNFCe/true
        // Rota para o grupo Cliente
        $app->group('/cliente', function () use ($app) 
        {        
            $app->get('/', function(Request $request, Response $response)
            {
                $cliente = new Cliente();
                $cliente = $cliente->getAll();
            });                
            // Consultar um cliente especifico
            $app->get('/{id}', function(Request $request, Response $response){
                $id = $request->getAttribute('id');   
                $cliente = new Cliente();
                $cliente = $cliente->get($id); 
            });    
            // Adicionar Cliente
            $app->post('/add', function(Request $request, Response $response){            
                $cliente = new Cliente();
                $cliente = $cliente->add($request); 
            });
            // Atualizar Cliente
            $app->put('/update/{id}', function(Request $request, Response $response){
                $cliente = new Cliente();
                $cliente = $cliente->update($request);
            });
            // Deletar Cliente
            $app->delete('/delete/{id}', function(Request $request, Response $response){
                $id = $request->getAttribute('id');
                $cliente = new Cliente();
                $cliente = $cliente->delete($id);
            });
        });// END Group /Cliente
        //**************************************************************************************************/    
        // Rota para o grupo Produto
        $app->group('/produto', function () use ($app) 
        {  
            //Consultar todos produtos cadastrados     
            $app->get('/', function(Request $request, Response $response){
                $produto = new Produto();
                $produto = $produto->getAll();
            });             
            // Consultar um Produto especifico
            $app->get('/{id}', function(Request $request, Response $response){
                $id = $request->getAttribute('id');
                $produto = new Produto();
                $produto = $produto->get($id);
            });    
            // Adicionar Produto            
            $app->post('/add', function(Request $request, Response $response){            
                $produto = new Produto();
                $produto = $produto->add($request); 
            });   
            // Atualizar Produto
            $app->put('/update/{id}', function(Request $request, Response $response){
                $produto = new Produto();
                $produto = $produto->update($request);
            });    
            // Deletar Produto
            $app->delete('/delete/{id}', function(Request $request, Response $response){
                $id = $request->getAttribute('id');
                $produto = new Produto();
                $produto = $produto->delete($id);
            });
        });//END grupo Produto        
        //**************************************************************************************************/
        // Rota para o grupo Emissor
        $app->group('/emissor', function () use ($app) 
        {        
            //Consultar Emissor Cadastrado
            //É permitido somente 1   
            $app->get('/', function(Request $request, Response $response)
            {
                $emissor = new Emissor();
                $emissor = $emissor->get();
            });   
            // Adicionar Emissor
            $app->post('/add', function(Request $request, Response $response){
                $emissor = new Emissor();
                $emissor = $emissor->add();
            });    
            // Atualizar Emissor
            $app->put('/update/{id}', function(Request $request, Response $response){
                $emissor = new Emissor();
                $emissor = $emissor->update();
            });    
            // Deletar Emissor
            $app->delete('/delete/{id}', function(Request $request, Response $response){
                $id = $request->getAttribute('id');
                $emissor = new Emissor();
                $emissor = $emissor->delete($id);  
            });
        }); //END grupo emissor
        //**************************************************************************************************/
        // Rota para o grupo NF
        $app->group('/nf', function () use ($app) 
        {        
            $app->get('/', function(Request $request, Response $response){
                $NF = new NF();
                $NF = $NF->getAll();
            });    
            // Consultar uma NF especifica
            $app->get('/{id}', function(Request $request, Response $response){
                $id = $request->getAttribute('id');
                $NF = new NF();
                $NF = $NF->get($id);                
            });    
            // Adicionar NF
            $app->post('/add', function(Request $request, Response $response){
                $NF = new NF();
                $NF = $NF->add($request);
            });    
            // Atualizar NF
            $app->put('/update/{id}', function(Request $request, Response $response){
                $NF = new NF();
                $NF = $NF->update();
            });    
            // Deletar NF
            $app->delete('/delete/{id}', function(Request $request, Response $response){
                $id = $request->getAttribute('id');
                $NF = new NF();
                $NF = $NF->delete($id);
            });
        });// END Group /nf   
    }); // END Group /api