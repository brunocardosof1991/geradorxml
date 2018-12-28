<?php
use App\Model\Xml;
use App\Model\Cliente;
use App\Model\Conexao;
require_once $_SERVER['DOCUMENT_ROOT'] . '/geradorXML/vendor/autoload.php';
if (isset($_GET['inserirFromCliente'])) {
    $clientObj = new Cliente();
    $clientObj->id = $_POST['clienteId'];
    $clientObj->nome = $_POST['clienteNome'];
    $clientObj->CNPJ = $_POST['clienteCNPJ'];
    $clientObj->endereco = $_POST['clienteEndereco'];
    $clientObj->numero = $_POST['clienteNumero'];
    $clientObj->complemento = $_POST['clienteComplemento'];
    $clientObj->bairro = $_POST['clienteBairro'];
    $clientObj->CEP = $_POST['clienteCEP'];
    $clientObj->celular = $_POST['clienteCelular'];
    $clientObj->inserir();
    echo '<script>';    
    echo 'window.location.href = "../../App/View/ListarCliente.php";';
    echo "alert('Cliente Cadastrado com Sucesso');";
    echo '</script>'; 
}
if (isset($_GET['inserirFromXml'])) {
    $clientObj = new Cliente();
    $conexao = new Conexao();
    $clientObj->id = $_POST['clienteId'];
    $clientObj->nome = $_POST['clienteNome'];
    $clientObj->CNPJ = $_POST['clienteCNPJ'];
    $clientObj->endereco = $_POST['clienteEndereco'];
    $clientObj->numero = $_POST['clienteNumero'];
    $clientObj->complemento = $_POST['clienteComplemento'];
    $clientObj->bairro = $_POST['clienteBairro'];
    $clientObj->CEP = $_POST['clienteCEP'];
    $clientObj->celular = $_POST['clienteCelular'];
    $conexao = new Conexao();
    $query = $conexao->consultar("SELECT count(*) FROM cliente WHERE id =$clientObj->id");
    $data = $query->fetch_array(MYSQLI_ASSOC);

    if ($data["count(*)"] == 0) {
        $clientObj->inserir();
        echo '<script>';
        echo 'window.location.href = "../../App/View/Xml.php";';
        echo "alert('Xml Criado Com Sucesso');";
        echo '</script>';      
    }else {
        echo '<script>';
        echo 'window.location.href = "../../App/View/ListarCliente.php";';
        echo "alert('O cliente Ja Existe, '<strong>'Xml Criado com Sucesso'</strong>'');";
        echo '</script>';
    }   
    //Forma de Pagamento
    $detPagArg = array
    (
        'tPag' => $_POST['pagamento'],  
        'vPag' => $_POST['valorTotal']         
    );
    $cardArg = array
    (
        'tpIntegra' => $_POST['intPagamento'],
        'CNPJ' => $_POST['credCartao'],
        'tBand' =>$_POST['bandeira'],
        'cAut' =>$_POST['autorizaoCartao']
    );
    //Gerar xmlObj
    $acesso = new Xml();
    //Enviar dados para as funções da classe Xml
    $destArg = $acesso->gerarDest($clientObj->id);
    $enderDestArg = $acesso->gerarEnderDest($clientObj->id);
    $acesso->gerarXml($destArg, $enderDestArg,$detPagArg, $cardArg);

    echo '<script>';    
    echo 'window.location.href = "../../App/View/Xml.php";';
    echo "alert('Xml Criado Com Sucesso');";
    echo '</script>';
}
?>