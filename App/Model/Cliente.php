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
    public function getAll()
    {            
        $sql = "SELECT * FROM cliente";    
        try{
            $connection = $this->connection->PDOConnect();
            $stmt = $connection->query($sql);
            $cliente = $stmt->fetchAll(PDO::FETCH_OBJ);
            echo json_encode($cliente);
            $connection = null;
        } catch(PDOException $e){
            echo json_encode('{"Erro": {"text": '.$e->getMessage().'}');
        }
    }    
    public function get($id)
    {            
        $sql = "SELECT * FROM cliente WHERE id= {$id}";    
        try{
            $connection = $this->connection->PDOConnect();
            $stmt = $connection->query($sql);
            $cliente = $stmt->fetchAll(PDO::FETCH_OBJ);
            echo  json_encode($cliente);
            $connection = null;
        } catch(PDOException $e){
            echo json_encode('{"Erro": {"text": '.$e->getMessage().'}');
        }
    }
    public function add($request)
    {        
        $nome = $request->getParam('nome');
        $CNPJ = $request->getParam('CNPJ');
        $endereco = $request->getParam('endereco');
        $numero = $request->getParam('numero');
        $complemento = $request->getParam('complemento');
        $bairro = $request->getParam('bairro');
        $municipio = $request->getParam('municipio');
        $UF = $request->getParam('UF');
        $CEP = $request->getParam('CEP');
        $fone = $request->getParam('fone');
        $sql = "INSERT INTO cliente (nome,CNPJ,endereco,numero,complemento,bairro,municipio,UF,CEP,fone) VALUES
        (:nome,:CNPJ,:endereco,:numero,:complemento,:bairro,:municipio,:UF,:CEP,:fone)";
        try{
            $connection = $this->connection->PDOConnect();
            $stmt = $connection->prepare($sql);
            $stmt->bindParam(':nome',  $nome);
            $stmt->bindParam(':CNPJ',      $CNPJ);
            $stmt->bindParam(':endereco',      $endereco);
            $stmt->bindParam(':numero',    $numero);
            $stmt->bindParam(':complemento',       $complemento);
            $stmt->bindParam(':bairro',      $bairro);
            $stmt->bindParam(':municipio',      $municipio);
            $stmt->bindParam(':UF',      $UF);
            $stmt->bindParam(':CEP',      $CEP);
            $stmt->bindParam(':fone',      $fone);
            $stmt->execute();
            $connection = null;
            echo json_encode('{"success": "Cliente Adicionado"}');
        } catch(PDOException $e){
            echo '{"error": '.$e->getMessage().'}';
        }
    }
    public function update($request)
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
            $connection = null;
            echo json_encode('{"success": "Cliente Atualizado"}');
        } catch(PDOException $e){
            echo '{"error": '.$e->getMessage().'}';
        }
    }
    public function delete($id)
    {
        $sql = "DELETE FROM cliente WHERE id = {$id}";
        try{
            $connection = $this->connection->PDOConnect();
            $stmt = $connection->prepare($sql);
            $stmt->execute();
            $connection = null;
            echo json_encode('{"success": "Cliente Deletado"}');
        } catch(PDOException $e){
            echo '{"error": '.$e->getMessage().'}';
        }        
    }
}

?>

