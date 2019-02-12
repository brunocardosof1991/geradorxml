<?php
namespace App\Model;
use App\Model\Conexao;
use PDO;

class Venda
{
    private $connection = '';   
    function __construct()
    {
        $this->connection = new Conexao();
    }

    public function getAll()
    {     
        $sql = "SELECT * FROM vendas";    
        try{
            $connection = $this->connection->PDOConnect();    
            $stmt = $connection->query($sql);
            $venda = $stmt->fetchAll(PDO::FETCH_OBJ);
            echo json_encode($venda);            
            $connection = null;
        }catch(PDOException $e){
            echo json_encode('{"error": '.$e->getMessage().'}');
        }
    }
    public function add($array)
    {   
        //Variaveis para serem usadas na inserção da venda no banco de dados 
        session_start();
        $vendedor = ($_SESSION['usuario']); 
        $produtos = '';
        $quantidades = '';
        $valorTotal = $array['info'][3];
        $formaPagamento = '';
        $NFCe = $array['qrcode'];
        //Coletar o nome do vendedor
        //Remover informações do destinatário
        if(!empty($array['info'][0]['inputName']))
        {unset($array['info'][0]);} 
        //Remover informações do emissor        
        unset($array['info'][4]); 
        //Coletar somente a descrição do(s) produto(s)
        for($i = 0; $i <count($array['produto']); $i++ )
        {
            $produtos .= $array['produto'][$i]['Descricao'].',';
        }
        //Coletar somente a quantidade do(s) produto(s)
        for($i = 0; $i <count($array['produto']); $i++ )
        {
            $quantidades .= $array['produto'][$i]['Qtd'].',';
        }
        //Se existir 2 formas de pagamento
        if(count($array['info'][1]) > 1)
        {
            //Coletar somente as formas de pagamento do(s) produto(s)
            for($i = 0; $i <count($array['info'][1]); $i++ )
            {
                $formaPagamento .= $array['info'][1][$i]['formaPagamento'].',';
            }
        }
        //Se for somente uma forma de pagamento 
        else{
            $formaPagamento .= $array['info'][1][0]['formaPagamento'];
        }
        $produtos = substr($produtos,0,-1);
        $quantidades = substr($quantidades,0,-1);
        if(count($array['info'][1]) > 1)
        {$formaPagamento = substr($formaPagamento,0,-1);}
        $sql = "INSERT INTO vendas (vendedor,produtos,quantidades,valorTotal,formaPagamento,NFCe) VALUES
        (:vendedor,:produtos,:quantidades,:valorTotal,:formaPagamento,:NFCe)";
        try{
            $connection = $this->connection->PDOConnect();  
            $stmt = $connection->prepare($sql);
            $stmt->bindParam(':vendedor',  $vendedor);
            $stmt->bindParam(':produtos',      $produtos);
            $stmt->bindParam(':quantidades',    $quantidades);
            $stmt->bindParam(':valorTotal',       $valorTotal);
            $stmt->bindParam(':formaPagamento',       $formaPagamento);
            $stmt->bindParam(':NFCe',       $NFCe);
            $stmt->execute();
            echo json_encode('{"success": "Venda Adicionado"}');
        } catch(PDOException $e){
            echo json_encode('{"error": '.$e->getMessage().'}');
        }
        
    }public function delete($id)
    {    
        $sql = "DELETE FROM vendas WHERE id = {$id}";    
        try{
            $connection = $this->connection->PDOConnect();    
            $stmt = $connection->prepare($sql);
            $stmt->execute();
            $connection = null;
            echo '{"success": "Venda Deletada"}';
        } catch(PDOException $e){
            echo '{"error": '.$e->getMessage().'}';
        }
    }
}