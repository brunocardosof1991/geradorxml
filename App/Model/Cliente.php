<?php
namespace App\Model;
use App\Model\Conexao;
use PDO;

class Cliente {
    
    private $id;
    private $nome;
    private $CNPJ;
    private $endereco;
    private $numero;
    private $complemento;
    private $bairro;
    private $CEP;
    private $fone;
    private $connection = '';

   function __construct()
   {
       $this->connection = new Conexao();
   }
    public function getAllClients()
    {            
        $sql = "SELECT * FROM cliente";    
        try{
            $connection = $this->connection->PDOConnect();
            $stmt = $connection->query($sql);
            $cliente = $stmt->fetchAll(PDO::FETCH_OBJ);
            echo json_encode($cliente);
            $connection = null;
        } catch(PDOException $e){
            return '{"Erro": {"text": '.$e->getMessage().'}';
        }
    }    
    public function getClient($id)
    {            
        $sql = "SELECT * FROM cliente WHERE id= {$id}";    
        try{
            $connection = $this->connection->PDOConnect();
            $stmt = $connection->query($sql);
            $cliente = $stmt->fetchAll(PDO::FETCH_OBJ);
            return ($cliente);
            $connection = null;
        } catch(PDOException $e){
            return '{"Erro": {"text": '.$e->getMessage().'}';
        }
    }
    public function addClient($request)
    {        
        $nome = $request->getParam('nome');
        $CNPJ = $request->getParam('CNPJ');
        $endereco = $request->getParam('endereco');
        $numero = $request->getParam('numero');
        $complemento = $request->getParam('complemento');
        $bairro = $request->getParam('bairro');
        $CEP = $request->getParam('CEP');
        $fone = $request->getParam('fone');
        $sql = "INSERT INTO cliente (nome,CNPJ,endereco,numero,complemento,bairro,CEP,fone) VALUES
        (:nome,:CNPJ,:endereco,:numero,:complemento,:bairro,:CEP,:fone)";
        try{
            $connection = $this->connection->PDOConnect();
            $stmt = $connection->prepare($sql);
            $stmt->bindParam(':nome',  $nome);
            $stmt->bindParam(':CNPJ',      $CNPJ);
            $stmt->bindParam(':endereco',      $endereco);
            $stmt->bindParam(':numero',    $numero);
            $stmt->bindParam(':complemento',       $complemento);
            $stmt->bindParam(':bairro',      $bairro);
            $stmt->bindParam(':CEP',      $CEP);
            $stmt->bindParam(':fone',      $fone);
            $stmt->execute();
            echo json_encode('{"Aviso": {"text": "Cliente Adicionado"}');
        } catch(PDOException $e){
            echo '{"Erro": {"text": '.$e->getMessage().'}';
        }
    }
    public function updateClient($request)
    {
        $id = $request->getParam('id');
        $nome = $request->getParam('nome');
        $CNPJ = $request->getParam('CNPJ');
        $endereco = $request->getParam('endereco');
        $numero = $request->getParam('numero');
        $complemento = $request->getParam('complemento');
        $bairro = $request->getParam('bairro');
        $CEP = $request->getParam('CEP');
        $fone = $request->getParam('fone');
        $sql = "UPDATE cliente SET
                    id 	 = :id,
                    nome = :nome,
                    CNPJ = :CNPJ,
                    endereco = :endereco,
                    numero 	= :numero,
                    complemento = :complemento,
                    bairro = :bairro,
                    CEP	= :CEP,
                    fone = :fone
                WHERE id = $id";
        try{
            $connection = $this->connection->PDOConnect();
            $stmt = $connection->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':nome',  $nome);
            $stmt->bindParam(':CNPJ',      $CNPJ);
            $stmt->bindParam(':endereco',      $endereco);
            $stmt->bindParam(':numero',    $numero);
            $stmt->bindParam(':complemento',       $complemento);
            $stmt->bindParam(':bairro',      $bairro);
            $stmt->bindParam(':CEP',      $CEP);
            $stmt->bindParam(':fone',      $fone);
            $stmt->execute();
            echo json_encode('{"Aviso": {"text": "Cliente Atualizado"}');
        } catch(PDOException $e){
            echo '{"Erro": {"text": '.$e->getMessage().'}';
        }
    }
    public function deleteClient($id)
    {
        $sql = "DELETE FROM cliente WHERE id = {$id}";
        try{
            $connection = $this->connection->PDOConnect();
            $stmt = $connection->prepare($sql);
            $stmt->execute();
            $connection = null;
            echo '{"Aviso": {"text": "Cliente Deletado"}';
        } catch(PDOException $e){
            echo '{"Erro": {"text": '.$e->getMessage().'}';
        }        
    }
}

?>

