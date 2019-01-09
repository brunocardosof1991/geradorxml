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
    // Rotas:Cliente, Produto, Emissor e NF
    // Rota para o grupo API
    $app->group('/api', function () use ($app) 
    {
        // Rota para o autorizar XML
        $app->post('/autorizarXml', function(Request $request, Response $response)
        {          
            $file1Array = json_decode($request->getParam('json'),true);
            $produto = json_decode($request->getParam('produto'),true);
            $xml = new Xml();
            $xml->dest['ID'] = $file1Array[0]['clientID'];
            $xml->dest['xNome'] = $file1Array[0]['inputName'];
            $xml->dest['CNPJ'] = $file1Array[0]['inputRegistro'];
            $xml->enderDest['xLgr'] = $file1Array[0]['inputEndereco'];
            $xml->enderDest['nro'] = $file1Array[0]['inputNumero'];
            $xml->enderDest['xCpl'] = $file1Array[0]['inputComplemento'];
            $xml->enderDest['xBairro'] = $file1Array[0]['inputBairro'];
            $xml->enderDest['CEP'] = $file1Array[0]['inputCEP'];
            $xml->enderDest['fone'] = $file1Array[0]['inputFone'];
    
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
            $informacoesAdicionais = $file1Array[2];
            try {
                file_put_contents('chaveDeAcesso.txt',$xml->gerarChaveDeAcesso());
                $xml->autorizarXML($informacoesAdicionais,$produto);
                $xml->saidaProduto($produto);
                echo json_encode('XML Criado Com Sucesso');                
                echo exec('move c:\xampp\htdocs\geradorXml\App\public\*-nfe.xml c:\Unimake\UniNFe\12291758000105\nfce\Envio > nul');
            } catch (\Throwable $e) {
                echo '{"Erro": {"text": '.$e->getMessage().'}';
            }   
        });
        //Rota para verificar se o xml foi autorizado && salvar NF no banco de dados c/ protocolo de autorização, nome e CNPJ do destinatário
        // As informações salva no banco de dados serão úteis para o cancelamento da NFC-e
        $app->post('/autorizarXml/true', function(Request $request, Response $response)
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
                //Coletar o Nome e CNPJ do destinatário da NFC-e autorizada
                // PQ os dois juntos? Pois existe 2 <xNome> e <CNPJ>, do emissor e do destinatario
                // Essa função n consegue ir direto no destinatário, que vem depois do emissor,então peguei os dois juntos
                // TALVEZ usando algo equivalente ao next da função de array, solucione o problema                
                //Começo da coleta
                $from = "<dest>";
                //Fim da coleta
                $to = "<enderDest>";
                function getNomeCNPJ($NFCe,$from,$to)
                {
                    $sub = substr($NFCe, strpos($NFCe,$from)+strlen($from),strlen($NFCe));
                    return substr($sub,0,strpos($sub,$to));
                }
                //Coletar o nome do destinatario da função getNomeCNPJ
                $fromN = "<xNome>";
                $toN = "</xNome>";
                $stringN = getNomeCNPJ($NFCe,$from,$to);
                function getNome($stringN,$fromN,$toN)
                {
                    $sub = substr($stringN, strpos($stringN,$fromN)+strlen($fromN),strlen($stringN));
                    return substr($sub,0,strpos($sub,$toN));
                }
                //Coletar o CNPJ do destinatario da função getNomeCNPJ
                $fromC = "<CNPJ>";
                $toC = "</CNPJ>";
                $stringC = getNomeCNPJ($NFCe,$from,$to);
                function getCNPJ($stringC,$fromC,$toC)
                {
                    $sub = substr($stringC, strpos($stringC,$fromC)+strlen($fromC),strlen($stringC));
                    return substr($sub,0,strpos($sub,$toC));
                }
                $protocolo = getProtocolo($NFCe,$fromP,$toP);
                $nome = getNome($stringN,$fromN,$toN);
                $CNPJ = getCNPJ($stringC,$fromC,$toC);
                $xml = new Xml();
                $xml->salvarNF($protocolo,$nome,$CNPJ);
                echo exec('del /f "chaveDeAcesso.txt"');
                $data = 'success';
                //OBS:
                //Porque a criação das 4 funções anonimas para coletar o protocolo de autorização, CNPJ e nome do destinatário?
                //Poderia simplismente usar OOP na classe XML o colocar as respectivas informações, menos o protocolo que é criado na autorização.
                //Na rota /autorizarXml os arrays do destinatários estão sendo preenchidos com os inputs vindo do frontend,
                //mas por algum motivo a rota /autorizarXml/true não esta conseguindo acessar o espaço de memória que estão guardadas essas informações
            } else {        
                $data = 'error';
            }
            echo json_encode($data);
        });
        // Rota para o grupo Cliente
        $app->group('/cliente', function () use ($app) 
        {        
            $app->get('/', function(Request $request, Response $response)
            {
                $output = '';
                $cliente = new Cliente();
                $cliente = $cliente->getAllClients();
                if(count($cliente) > 0)
                {
                    foreach($cliente as $row)
                    {
                        $output .= '
                            <tr>
                                <td data-title="ID:">'.$row->id.'</td>
                                <td data-title="Nome:">'.$row->nome.'</td>
                                <td data-title="CPF/CNPJ:">'.$row->CNPJ.'</td>
                                <td data-title="Endereço:">'.$row->endereco.'</td>
                                <td data-title="Número:">'.$row->numero.'</td>
                                <td data-title="Complemento:">'.$row->complemento.'</td>
                                <td data-title="Bairro:">'.$row->bairro.'</td>
                                <td data-title="CEP:">'.$row->CEP.'</td>
                                <td data-title="Telefone:">'.$row->fone.'</td>
                                <td data-title="Excluir:">
                                    <i class="fas fa-trash fa-2x" id="excluirCliente" title="Excluir" style="cursor:pointer;color:red"></i>
                                </td>
                                <td data-title="Editar:">
                                    <i class="fas fa-user-edit fa-2x" id="editarCliente" title="Editar" style="cursor:pointer;color:orange"></i>
                                </td>
                            </tr>
                            ';
                        }
                    }
                    else
                    {
                    $output .= '
                    <tr>
                        <td colspan="11" text-align="center">Nenhum Cliente Cadastrado</td>
                    </tr>
                    ';
                    }
                    echo ($output);
            });                
            // Consultar um cliente especifico
            $app->get('/{id}', function(Request $request, Response $response){
                $id = $request->getAttribute('id');   
                $cliente = new Cliente();
                $cliente = $cliente->getClient($id); 
            });    
            // Adicionar Cliente
            $app->post('/add', function(Request $request, Response $response){            
                $cliente = new Cliente();
                $cliente = $cliente->addClient($request); 
            });
            // Atualizar Cliente
            $app->put('/update/{id}', function(Request $request, Response $response){
                $cliente = new Cliente();
                $cliente = $cliente->updateClient($request);
            });
            // Deletar Cliente
            $app->delete('/delete/{id}', function(Request $request, Response $response){
                $id = $request->getAttribute('id');
                $cliente = new Cliente();
                $cliente = $cliente->deleteClient($id);
            });
        });// END Group /Cliente
        //**************************************************************************************************/    
        // Rota para o grupo Produto
        $app->group('/produto', function () use ($app) 
        {  
            //Consultar todos produtos cadastrados     
            $app->get('/', function(Request $request, Response $response){
                $output = '';
                $produto = new Produto();
                $produto = $produto->getAllProdutos();
                //RETORNAR TABLE HTML
                if(count($produto) > 0)
                {
                    foreach($produto as $row)
                    {
                        $output .= '
                        <tr>
                            <td data-title="ID:">'.$row->id.'</td>
                            <td data-title="Produto:">'.$row->descricao.'</td>
                            <td data-title="NCM:">'.$row->ncm.'</td>
                            <td data-title="Preço:">'.$row->preco_custo.'</td>
                            <td data-title="CFOP:">'.$row->CFOP.'</td>
                            <td data-title="Excluir:">
                                <i class="fas fa-trash fa-2x" id="excluirProduto" title="Excluir" style="cursor:pointer;color:red"></i>
                            </td>
                            <td data-title="Editar:">
                                <i class="fas fa-user-edit fa-2x" id="editarProduto" title="Editar" style="cursor:pointer;color:orange"></i>
                            </td>
                        </tr>
                        ';
                    }
                }else
                {
                    $output .= '
                    <tr>
                        <td colspan="7" text-align="center">Nenhum Produto Cadastrado</td>
                    </tr>
                    ';
                }
                echo ($output);
            });             
            // Consultar um Produto especifico
            $app->get('/{id}', function(Request $request, Response $response){
                $id = $request->getAttribute('id');
                $produto = new Produto();
                $produto = $produto->getProduto($id);
            });    
            // Adicionar Produto            
            $app->post('/add', function(Request $request, Response $response){            
                $produto = new Produto();
                $produto = $produto->addProduto($request); 
            });   
            // Atualizar Produto
            $app->put('/update/{id}', function(Request $request, Response $response){
                $produto = new Produto();
                $produto = $produto->updateProduto($request);
            });    
            // Deletar Produto
            $app->delete('/delete/{id}', function(Request $request, Response $response){
                $id = $request->getAttribute('id');
                $produto = new Produto();
                $produto = $produto->deleteProduto($id);
            });
        });//END grupo Produto        
        //**************************************************************************************************/
        // Rota para o grupo Emissor
        $app->group('/emissor', function () use ($app) 
        {        
            $app->get('/', function(Request $request, Response $response)
            {
                $output = '';
                $emissor = new Emissor();
                $emissor = $emissor->getEmissor();
                echo json_encode($emissor);
            });   
            // Adicionar Emissor
            $app->post('/add', function(Request $request, Response $response){
                $id = $request->getParam('id');
                $CNPJ = $request->getParam('CNPJ');
                $xNome = $request->getParam('xNome');
                $xLgr = $request->getParam('xLgr');
                $xFant = $request->getParam('xFant');
                $nro = $request->getParam('nro');
                $xBairro = $request->getParam('xBairro');    
                $cMun = $request->getParam('cMun');    
                $xMun = $request->getParam('xMun');    
                $UF = $request->getParam('UF');    
                $CEP = $request->getParam('CEP');    
                $cPais = $request->getParam('cPais');    
                $xPais = $request->getParam('xPais');    
                $fone = $request->getParam('fone');    
                $IE = $request->getParam('IE');    
                $IM = $request->getParam('IM');    
                $crt = $request->getParam('CRT');    
                $cnae = $request->getParam('CNAE');    
                $sql = "INSERT INTO emissor (id,CNPJ,xNome,xLgr,xFant,nro,xBairro,cMun,xMun,UF,CEP,cPais,xPais,fone,IE,IM,crt,cnae) VALUES
                (:id,:CNPJ,:xNome,:xLgr,:xFant,:nro,:xBairro,:cMun,:xMun,:UF,:CEP,:cPais,:xPais,:fone,:IE,:IM,:CRT,:CNAE)";    
                try{
                    // Get DB Object
                    $db = new Conexao();
                    // Connect
                    $db = $db->PDOConnect();    
                    $stmt = $db->prepare($sql);    
                    $stmt->bindParam(':id', $id);
                    $stmt->bindParam(':CNPJ',  $CNPJ);
                    $stmt->bindParam(':xNome',      $xNome);
                    $stmt->bindParam(':xLgr',      $xLgr);
                    $stmt->bindParam(':xFant',    $xFant);
                    $stmt->bindParam(':nro',       $nro);
                    $stmt->bindParam(':xBairro',      $xBairro);    
                    $stmt->bindParam(':cMun',      $cMun);    
                    $stmt->bindParam(':xMun',      $xMun);    
                    $stmt->bindParam(':UF',      $UF);    
                    $stmt->bindParam(':CEP',      $CEP);    
                    $stmt->bindParam(':cPais',      $cPais);    
                    $stmt->bindParam(':xPais',      $xPais);    
                    $stmt->bindParam(':fone',      $fone);    
                    $stmt->bindParam(':IE',      $IE);    
                    $stmt->bindParam(':IM',      $IM);    
                    $stmt->bindParam(':CRT',      $CRT);    
                    $stmt->bindParam(':CNAE',      $CNAE);    
                    $stmt->execute();    
                    echo json_encode('{"Aviso": {"text": "Emissor Adicionado"}');    
                } catch(PDOException $e){
                    echo '{"Erro": {"text": '.$e->getMessage().'}';
                }
            });    
            // Atualizar Emissor
            $app->put('/update/{id}', function(Request $request, Response $response){
                $id = $request->getParam('id');
                $CNPJ = $request->getParam('CNPJ');
                $xNome = $request->getParam('xNome');
                $xLgr = $request->getParam('xLgr');
                $xFant = $request->getParam('xFant');
                $nro = $request->getParam('nro');
                $xBairro = $request->getParam('xBairro');    
                $cMun = $request->getParam('cMun');    
                $xMun = $request->getParam('xMun');    
                $UF = $request->getParam('UF');    
                $CEP = $request->getParam('CEP');    
                $cPais = $request->getParam('cPais');    
                $xPais = $request->getParam('xPais');    
                $fone = $request->getParam('fone');    
                $IE = $request->getParam('IE');    
                $IM = $request->getParam('IM');    
                $CRT = $request->getParam('CRT');    
                $CNAE = $request->getParam('CNAE');     
                $sql = "UPDATE emissor SET
                id=:id,
                CNPJ=:CNPJ,
                xNome=:xNome,
                xLgr=:xLgr,
                xFant=:xFant,
                nro=:nro,
                xBairro=:xBairro,
                cMun=:cMun,
                xMun=:xMun,
                UF=:UF,
                CEP=:CEP,
                cPais=:cPais,
                xPais=:xPais,
                fone=:fone,
                IE=:IE,
                IM=:IM,
                CRT=:CRT,
                CNAE=:CNAE
                        WHERE id = $id";    
                try{
                    // Get DB Object
                    $db = new Conexao();
                    // Connect
                    $db = $db->PDOConnect();    
                    $stmt = $db->prepare($sql);   
                    $stmt->bindParam(':id', $id);
                    $stmt->bindParam(':CNPJ',  $CNPJ);
                    $stmt->bindParam(':xNome',      $xNome);
                    $stmt->bindParam(':xLgr',      $xLgr);
                    $stmt->bindParam(':xFant',    $xFant);
                    $stmt->bindParam(':nro',       $nro);
                    $stmt->bindParam(':xBairro',      $xBairro);    
                    $stmt->bindParam(':cMun',      $cMun);    
                    $stmt->bindParam(':xMun',      $xMun);    
                    $stmt->bindParam(':UF',      $UF);    
                    $stmt->bindParam(':CEP',      $CEP);    
                    $stmt->bindParam(':cPais',      $cPais);    
                    $stmt->bindParam(':xPais',      $xPais);    
                    $stmt->bindParam(':fone',      $fone);    
                    $stmt->bindParam(':IE',      $IE);    
                    $stmt->bindParam(':IM',      $IM);    
                    $stmt->bindParam(':CRT',      $CRT);    
                    $stmt->bindParam(':CNAE',      $CNAE);    
                    $stmt->execute();   
                    echo json_encode('{"Aviso": {"text": "Emissor Atualizado"}');    
                } catch(PDOException $e){
                    echo '{"Erro": {"text": '.$e->getMessage().'}';
                }
            });    
            // Deletar Emissor
            $app->delete('/delete/{id}', function(Request $request, Response $response){
                $id = $request->getAttribute('id');    
                $sql = "DELETE FROM emissor WHERE id = $id";    
                try{
                    // Get DB Object
                    $db = new Conexao();
                    // Connect
                    $db = $db->PDOConnect();    
                    $stmt = $db->prepare($sql);
                    $stmt->execute();
                    $db = null;
                    echo '{"Aviso": {"text": "Emissor Deletado"}';
                } catch(PDOException $e){
                    echo '{"Erro": {"text": '.$e->getMessage().'}';
                }
            });
        }); //END grupo emissor
        //**************************************************************************************************/
        // Rota para o grupo NFC-e
        $app->group('/nf', function () use ($app) 
        {        
            $app->get('/', function(Request $request, Response $response){
                $output = '';
                $NF = new NF();
                $NF = $NF->getAllNFCe();
                //RETORNAR TABLE HTML
                if(count($NF) > 0)
                {
                    foreach($NF as $row)
                    {
                        $output .= '
                        <tr>
                            <td style="display:none;">'.$row->id.'</td>
                            <td data-title="Chave De Acesso:">'.$row->chave.'</td>
                            <td data-title="Data de Emissão:">'.$row->dhEmi.'</td>
                            <td data-title="CPF/CNPJ Destinatário:">'.$row->CNPJDestinatario.'</td>
                            <td data-title="Protocolo:">'.$row->protocolo.'</td>
                            <td data-title="Excluir:">
                                <i class="fas fa-trash fa-2x excluir" id="'.$row->id.'" title="Excluir" style="cursor:pointer; color:red"></i>
                            </td>
                            <td data-title="Cancelar:">
                                <i class="fas fa-ban fa-2x cancelar" id="'.$row->id.'" title="Cancelar" style="cursor:pointer; color:red"></i>
                            </td>
                        </tr>
                        ';
                    }
                }else
                {
                    $output .= '
                    <tr>
                        <td colspan="4" align="center">No Data Found</td>
                    </tr>
                    ';
                }
                echo ($output);
            });    
            // Consultar uma NF especifica
            $app->get('/{id}', function(Request $request, Response $response){
                $id = $request->getAttribute('id');
                $NF = new NF();
                $NF = $NF->getNFCe($id);                
            });    
            // Adicionar NF
            $app->post('/add', function(Request $request, Response $response){
                $NF = new NF();
                $NF = $NF->addNFCe($request);
            });    
            // Atualizar NF
            $app->put('/update/{id}', function(Request $request, Response $response){
                $NF = new NF();
                $NF = $NF->updateNFCe();
            });    
            // Deletar NF
            $app->delete('/delete/{id}', function(Request $request, Response $response){
                $id = $request->getAttribute('id');
                $NF = new NF();
                $NF = $NF->deleteNFCe($id);
            });
        });// END Group /nf   
    }); // END Group /api