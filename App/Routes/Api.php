<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use App\Model\Xml;
use App\Model\Conexao;
use App\Model\Cliente;
use App\Model\Usuario;
use App\Model\Venda;
use App\Model\Produto;
use App\Model\NF;
use App\Model\Emissor;

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
    // Rotas: Venda, Cliente, Produto, Emissor e NF
    // Rota para o grupo API
    $app->group('/api', function () use ($app) 
    { 
        //Timestamp
        $app->post('/timestamp', function(Request $request, Response $response)
        {
            $data = new DateTime('now', new DateTimeZone('America/Sao_Paulo'));
            date_default_timezone_set('America/Sao_Paulo');
            $timestamp = $data = date('Y-m-d H:i:s');
            echo json_encode($timestamp);

        });  
        //QRCode
        $app->get('/qrcode/{chave}', function(Request $request, Response $response)
        {  
            $chave = $request->getAttribute('chave');
            $data = new DateTime('now', new DateTimeZone( 'America/Sao_Paulo'));
            $YM = substr_replace($data->format('Y-m'), '', -3, -2);
            $xmlAutorizado = glob("C:/Unimake/UniNFe/12291758000105/nfce/Enviado/Autorizados/$YM/$chave-procNFe.xml");
            $xmlAutorizado2 = end($xmlAutorizado);
            $xmlAutorizadoToString = print_r($xmlAutorizado2,true);
            //Se a NFC-e foi autorizada...
            if(!empty($xmlAutorizadoToString)) 
            {        
                $NFCe = file_get_contents($xmlAutorizado2);
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
                echo json_encode($qrCode);
            } else {echo json_encode('NFC-e Não Existe!');}  
        });  
        $app->group('/venda', function () use ($app) 
        {
            //Pegar Todas as Vendas
            $app->get('/', function(Request $request, Response $response)
            {
                $venda = new Venda();
                $venda = $venda->getAll();
            });
            //Salvar Venda no DB             
            $app->get('/salvar', function(Request $request, Response $response)
            {             
                $info = file_get_contents("info.json");
                $infoArray = json_decode($info ,true);
                $produto = file_get_contents("produto.json");
                $produtoArray = json_decode($produto ,true);
                $qrcode = file_get_contents("qrcode.txt");
                $array = array(
                    'info' => $infoArray,
                    'produto' => $produtoArray,
                    'qrcode' => $qrcode
                );
                $venda = new Venda();
                $venda = $venda->add($array);
            }); 
            // Deletar Venda
            $app->delete('/delete/{id}', function(Request $request, Response $response){
                $id = $request->getAttribute('id');
                $venda = new Venda();
                $venda = $venda->delete($id);
            });
        });;
        $app->group('/usuario', function () use ($app) 
        {    
            // Adicionar Usuario
            $app->post('/add', function(Request $request, Response $response){            
                $usuario = new Usuario();
                $usuario = $usuario->add($request); 
            });
            // Verificar Status
            $app->get('/status', function(Request $request, Response $response){ 
                session_start();           
                echo json_encode($_SESSION['status']); 
            });
        });
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
            // Get Ide
            $app->get('/ide/get', function(Request $request, Response $response){
                $emissor = new Emissor();
                $emissor = $emissor->getIde($request);
            });    
            // Adicionar Ide
            $app->post('/ide/add', function(Request $request, Response $response){
                $emissor = new Emissor();
                $emissor = $emissor->addIde($request);
            });    
            $app->put('/ide/update/{id}', function(Request $request, Response $response){
                $emissor = new Emissor();
                $emissor = $emissor->updateIde($request);
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