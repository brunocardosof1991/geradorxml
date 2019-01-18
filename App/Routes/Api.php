<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use App\Model\Xml;
use App\Model\Conexao;
use App\Model\Cliente;
use App\Model\Produto;
use App\Model\NF;
use App\Model\Emissor;
use App\Model\DANFE;

$app = new \Slim\App([
    'settings' => [
        // Only set this if you need access to route within middleware
        'determineRouteBeforeAppMiddleware' => true
    ]
]); 

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
        $app->post('/verifyFiles', function(Request $request, Response $response)
        {             
            //Arquivo passado da rota /autorizarNFCe para /autorizarNFCe/true
            //Arquivo utilizado para encontrar o xml autorizada na pasta /Enviado/Autorizados do UniNFe
            if(glob("chaveDeAcesso.txt"))
            {                
                unlink('chaveDeAcesso.txt');
            }
            //Arquivo com o inicio e fim da numeração inutilizada
            if(glob("inicioFim.json"))
            {                
                unlink('inicioFim.json');
            }
        });
        $app->post('/DANFE', function(Request $request, Response $response)
        {
            $dhEmi = file_get_contents("dhEmi.txt");
            //O que substituir
            $search = ["T","-02:00"];
            //Pelo que substituir
            $replace = ["",""];
            $str_replace = str_replace($search,$replace,$dhEmi);
            //Pegar somente a data da string
            $data = substr($str_replace,0,10);
            //Pegar somente a hora da string
            $hora = substr($str_replace,10,18);
            //Separar a data para poder inverter
            $explode = explode("-", $data);
            //Montar novamente a string com data no formato dia/mes/ano 
            $dhEmi = $explode[2].'-'.$explode[1].'-'.$explode[0].' '.$hora;
            $info = file_get_contents("info.json");
            $infoArray = json_decode($info ,true);
            $produto = file_get_contents("produto.json");
            $produtoArray = json_decode($produto,true);
            $qrcode = file_get_contents("qrcode.txt");
            $nNF = file_get_contents("nNF.txt");
            $protocolo = file_get_contents("protocolo.txt");
            $serie = file_get_contents("serie.txt");
            $array = array
            (
                'info'=>$infoArray,
                'produto'=>$produtoArray,
                'qrcode'=>$qrcode,
                'nNF'=>$nNF,
                'protocolo'=>$protocolo,
                'dhEmi'=>$dhEmi,
                'serie'=>$serie
            );
            echo json_encode($array);
        });
        $app->post('/uninfe/inutilizar', function(Request $request, Response $response)
        { 
            $xml = new Xml();
            $inicio = $request->getParam('inicio');
            $fim = $request->getParam('fim');
            $just = $request->getParam('just');
            $inutilizacao = array
            (
                'inicio' => $inicio,
                'fim' => $fim
            );
            $xml->inutilizarXml($inicio,$fim,$just);
            //Codigo IBGE ESTADO + ANO + CNPJ Emissor + Modelo da NOTA FISCAL + serie + inicio e fim
            $file = $xml->ide['cUF'].date('y').$xml->emit['CNPJ'].$xml->ide['mod'].$xml->ide['serie'].$inicio.$fim;
            file_put_contents('chaveDeAcesso.txt',$file);
            file_put_contents('inicioFim.json',json_encode($inutilizacao));
            echo json_encode('{"success"}');
            echo exec('move c:\xampp\htdocs\geradorXml\App\public\*-ped-inu.xml c:\Unimake\UniNFe\12291758000105\nfce\Envio > nul');
        });
        $app->post('/uninfe/inutilizar/confirmar', function(Request $request, Response $response)
        { 
            $data = new DateTime('now', new DateTimeZone( 'America/Sao_Paulo'));
            $YM = substr_replace($data->format('Y-m'), '', -3, -2);
            //Coletar a chave de acesso salva na rota /autirzarXml 
            $chave = file_get_contents("chaveDeAcesso.txt");
            $chave .= '-procInutNFe.xml';
            $xmlAutorizado = glob("C:/Unimake/UniNFe/12291758000105/nfce/Enviado/Autorizados/$YM/$chave");
            $xmlAutorizado2 = end($xmlAutorizado);
            $xmlAutorizadoToString = print_r($xmlAutorizado2,true);
            $data = array();
            //Se a NFC-e foi cancelada...
            if(!empty($xmlAutorizadoToString)) {
                $xml = new Xml();
                $data = 'success';
            } else {        
                $data = 'error';
            }
            echo json_encode($data);
        });
        $app->post('/uninfe/inutilizar/confirmar/salvar', function(Request $request, Response $response)
        { 
            $data = new DateTime('now', new DateTimeZone( 'America/Sao_Paulo'));
            $YM = substr_replace($data->format('Y-m'), '', -3, -2);
            $chaveInutilizado = file_get_contents("chaveDeAcesso.txt");
            $arrayInicioFimNumeracao = file_get_contents("inicioFim.json");
            $chaveInutilizado =$chaveInutilizado.'-procInutNFe.xml';
            $xmlInutilizado = glob("C:/Unimake/UniNFe/12291758000105/nfce/Enviado/Autorizados/$YM/$chaveInutilizado");   
            $xmlInutilizado2 = end($xmlInutilizado);
            $xmlInutilizadoToString = print_r($xmlInutilizado2,true);
            $data = array();
            //Se a NFC-e foi cancelada...
            if(!empty($xmlInutilizadoToString)) {  
                $xmlInutilizado2 = 'file:///'.$xmlInutilizado2;
                $json = file_get_contents('inicioFim.json');
                $jsonToArray = json_decode($json,true);
                $inicio = $jsonToArray['inicio'];
                $fim = $jsonToArray['fim'];
                $NF = new NF();
                $NF->salvarInutilizacao($xmlInutilizado2,$inicio,$fim);
                echo exec('del /f "chaveDeAcesso.txt"');
                echo exec('del /f "inicioFim.json"');
                $data = 'success';
            } else {        
                $data = 'error';
            }
            echo json_encode($data);
        });  
        // Rota para a criação do XML de cancelamento
        // NF/fetch.js
        $app->post('/uninfe/cancelar', function(Request $request, Response $response)
        {
            $xml = new Xml();
            $protocolo = $request->getParam('protocolo');
            $chave = $request->getParam('chave');
            $xml->cancelarXml($protocolo, $chave);
            echo json_encode('{"success": "XML Cancelado"}');
            file_put_contents('chaveDeAcesso.txt',substr_replace($chave,'', 0, 3));
            echo exec('move c:\xampp\htdocs\geradorXml\App\public\*-ped-eve.xml c:\Unimake\UniNFe\12291758000105\nfce\Envio > nul');
        });
        $app->post('/uninfe/cancelar/confirmar', function(Request $request, Response $response)
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
                $data = 'success';
            } else {        
                $data = 'error';
            }
            echo json_encode($data);
        });
        $app->post('/uninfe/cancelar/confirmar/salvar', function(Request $request, Response $response)
        { 
            $data = new DateTime('now', new DateTimeZone( 'America/Sao_Paulo'));
            $YM = substr_replace($data->format('Y-m'), '', -3, -2);
            $chaveCancelado = file_get_contents("chaveDeAcesso.txt");
            $chaveCancelado = 'NFe'.$chaveCancelado.'-procNFe.xml';
            $xmlCancelado = glob("C:/Unimake/UniNFe/12291758000105/nfce/Enviado/Autorizados/$YM/$chaveCancelado");   
            $xmlCancelado2 = end($xmlCancelado);
            $xmlCanceladoToString = print_r($xmlCancelado2,true);
                                    //\\
            $chaveAutorizado = file_get_contents("chaveDeAcesso.txt");
            $chaveAutorizado .= '_110111_01-procEventoNFe.xml';
            $xmlAutorizado = glob("C:/Unimake/UniNFe/12291758000105/nfce/Enviado/Autorizados/$YM/$chaveAutorizado");
            $xmlAutorizado2 = end($xmlAutorizado);
            $xmlAutorizadoToString = print_r($xmlAutorizado2,true);
            $data = array();
            //Se a NFC-e foi cancelada...
            if(!empty($xmlAutorizadoToString) && !empty($xmlCanceladoToString)) {
                //Colocar toda NFC-e Autorizada em uma variável (Pegar o link do QR-Code)
                $NFCe = file_get_contents($xmlCancelado2);
                //Coletar o qrcode da NFC-e autorizada
                //Começo da coleta
                $from = "<qrCode>";
                //Fim da coleta
                $to = "</qrCode>";
                function getQRCode($NFCe,$from,$to)
                {
                    $sub = substr($NFCe, strpos($NFCe,$from)+strlen($from),strlen($NFCe));
                    return substr($sub,0,strpos($sub,$to));
                } 
                $qrCode = getQRCode($NFCe,$from,$to);
                $NF = new NF();
                $xmlCancelado2 = 'file:///'.$xmlCancelado2;
                $NF->salvarNFCancelada($xmlCancelado2,$qrCode);
                echo exec('del /f "chaveDeAcesso.txt"');
                $data = 'success';
            } else {        
                $data = 'error';
            }
            echo json_encode($data);
        });  
        //Rota para a criação do XML de autorização
        $app->post('/uninfe/autorizar', function(Request $request, Response $response)
        {
            $file1Array = json_decode($request->getParam('json'),true);
            $produto = json_decode($request->getParam('produto'),true);
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
            $xml->enderDest['xMun'] = $file1Array[0]['inputMunicipio'];
            $xml->enderDest['UF'] = $file1Array[0]['inputUF'];
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
                file_put_contents('info.json',json_encode($file1Array,true));
                file_put_contents('produto.json',json_encode($produto,true));
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
        $app->post('/uninfe/autorizar/confirmar', function(Request $request, Response $response)
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
                //Coletar informações da NFC-e autorizada para preenchimento da DANFE
                //Começo da coleta
                $fromS = "<serie>";
                //Fim da coleta
                $toS = "</serie>";
                function getSerie($NFCe,$fromS,$toS)
                {
                    $sub = substr($NFCe, strpos($NFCe,$fromS)+strlen($fromS),strlen($NFCe));
                    return substr($sub,0,strpos($sub,$toS));
                }
                //Começo da coleta
                $fromD = "<dhEmi>";
                //Fim da coleta
                $toD = "</dhEmi>";
                function getdhEmi($NFCe,$fromD,$toD)
                {
                    $sub = substr($NFCe, strpos($NFCe,$fromD)+strlen($fromD),strlen($NFCe));
                    return substr($sub,0,strpos($sub,$toD));
                }
                //Começo da coleta
                $fromN = "<nNF>";
                //Fim da coleta
                $toN = "</nNF>";
                function getnNF($NFCe,$fromN,$toN)
                {
                    $sub = substr($NFCe, strpos($NFCe,$fromN)+strlen($fromN),strlen($NFCe));
                    return substr($sub,0,strpos($sub,$toN));
                }
                //Começo da coleta
                $fromP = "<nProt>";
                //Fim da coleta
                $toP = "</nProt>";
                function getProtocolo($NFCe,$fromP,$toP)
                {
                    $sub = substr($NFCe, strpos($NFCe,$fromP)+strlen($fromP),strlen($NFCe));
                    return substr($sub,0,strpos($sub,$toP));
                }
                $from = "<qrCode>";
                //Fim da coleta
                $to = "</qrCode>";
                function getQRCode($NFCe,$from,$to)
                {
                    $sub = substr($NFCe, strpos($NFCe,$from)+strlen($from),strlen($NFCe));
                    return substr($sub,0,strpos($sub,$to));
                } 
                $qrCode = getQRCode($NFCe,$from,$to);  
                $protocolo = getProtocolo($NFCe,$fromP,$toP);
                $nNF = getnNF($NFCe,$fromN,$toN);
                $dhEmi = getdhEmi($NFCe,$fromD,$toD);
                $serie = getSerie($NFCe,$fromS,$toS);
                file_put_contents('qrcode.txt',$qrCode);
                file_put_contents('protocolo.txt',$protocolo);
                file_put_contents('nNF.txt',$nNF);
                file_put_contents('dhEmi.txt',$dhEmi);
                file_put_contents('serie.txt',$serie);
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
            // Consultar um Produto especifico por ID
            $app->get('/{id}', function(Request $request, Response $response){
                $id = $request->getAttribute('id');
                $produto = new Produto();
                $produto = $produto->get($id);
            });    
            // Consultar um Produto especifico pela Descrição
            $app->get('/descricao/{descricao}', function(Request $request, Response $response){
                $descricao = $request->getAttribute('descricao'); // return NotFound for non existent route
                $produto = new Produto();
                $produto = $produto->getByDescricao($descricao);
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
            // Adicionar Ide
            $app->post('/ide', function(Request $request, Response $response){
                $emissor = new Emissor();
                $emissor = $emissor->addIde($request);
            });    
            // Adicionar Emissor
            $app->post('/add', function(Request $request, Response $response){
                $emissor = new Emissor();
                $emissor = $emissor->add($request);
            });    
            // Atualizar Emissor
            $app->put('/update/{id}', function(Request $request, Response $response){
                $emissor = new Emissor();
                $emissor = $emissor->update($request);
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
            //Consultar NFC-e Cancelada    
            $app->get('/cancelada', function(Request $request, Response $response){
                $NF = new NF();
                $NF = $NF->getAllCanceladas();
            });    
            $app->get('/inutilizado', function(Request $request, Response $response){
                $NF = new NF();
                $NF = $NF->getAllInutilizadas();
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